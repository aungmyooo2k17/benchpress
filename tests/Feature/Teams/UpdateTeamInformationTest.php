<?php

namespace Tests\Feature\Teams;

use Tests\TestCase;
use App\Models\Team;
use App\Models\User;
use Emberfuse\Blaze\Testing\Contracts\Postable;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTeamInformationTest extends TestCase implements Postable
{
    use RefreshDatabase;

    public function testUpdateTeamInformation()
    {
        $team = create(Team::class);
        $user = create(User::class, [
            'team_id' => $team->id,
            'owner' => true,
        ]);

        $this->signIn($user);

        $response = $this->put('/teams/' . $team->slug, $this->validParameters());

        $response->assertStatus(303);
    }

    /**
     * Provide only the necessary paramertes for a POST-able type request.
     *
     * @param array $overrides
     *
     * @return array
     */
    public function validParameters(array $overrides = []): array
    {
        return array_merge([
            'name' => $this->faker->company(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'description' => $this->faker->paragraph(),
        ], $overrides);
    }
}
