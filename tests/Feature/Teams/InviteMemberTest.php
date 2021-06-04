<?php

namespace Tests\Feature\Teams;

use Tests\TestCase;
use App\Models\Team;
use App\Models\User;
use App\Models\Invitation;
use Emberfuse\Blaze\Models\Role;
use Illuminate\Support\Facades\Mail;
use Emberfuse\Blaze\Testing\Contracts\Postable;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InviteMemberTest extends TestCase implements Postable
{
    use RefreshDatabase;

    public function testOwnerCanInviteAnotherMember()
    {
        Mail::fake();
        $this->withoutEvents();

        $role = Role::create(['name' => 'Staff', 'slug' => 'staff']);
        $team = create(Team::class);
        $user = create(User::class, [
            'team_id' => $team->id,
            'owner' => true,
        ]);

        $this->signIn($user);

        $response = $this->post("/teams/{$team->slug}/invitations", $this->validParameters());

        $invitation = Invitation::first();

        $this->assertInstanceOf(Role::class, $invitation->role);
        $this->assertTrue($invitation->role->is($role));

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
            'email' => $this->faker->safeEmail(),
            'role_id' => 1,
        ]);
    }
}
