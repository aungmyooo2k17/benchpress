<?php

namespace Tests\Feature\Teams;

use Tests\TestCase;
use App\Models\User;
use Tests\Concerns\CreatesRoles;
use App\Events\InvitingStaffMember;
use Cratespace\Preflight\Models\Role;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamInvitationTest extends TestCase
{
    use RefreshDatabase;
    use CreatesRoles;

    protected function setUp(): void
    {
        parent::setUp();

        $this->createDefaultRoles();
    }

    public function testStaffMemberCanBeSentTeamInvitation()
    {
        $this->withoutEvents();

        $user = create(User::class, [], 'withTeam');
        $user->assignRole('Administrator');

        $this->signIn($user);

        $response = $this->post("/teams/{$user->team->slug}/invitations", [
            'email' => $this->faker->unique()->email,
            'role_id' => Role::whereName('Staff')->first()->id,
        ]);

        $response->assertStatus(303);
    }

    public function testInvitingMemberEventIsDispatched()
    {
        Event::fake();

        $user = create(User::class, [], 'withTeam');
        $user->assignRole('Administrator');

        $this->signIn($user);

        $response = $this->post("/teams/{$user->team->slug}/invitations", [
            'email' => $this->faker->unique()->email,
            'role_id' => Role::whereName('Staff')->first()->id,
        ]);

        Event::assertDispatched(InvitingStaffMember::class);

        $response->assertStatus(303);
    }
}
