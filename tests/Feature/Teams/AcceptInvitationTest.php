<?php

namespace Tests\Feature\Teams;

use Tests\TestCase;
use App\Models\Team;
use Emberfuse\Blaze\Models\Role;
use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcceptInvitationTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanAcceptInvitation()
    {
        $role = Role::create(['name' => 'Staff', 'slug' => 'staff']);
        $team = create(Team::class);
        $invitation = $team->invitations()->create([
            'email' => $this->faker->safeEmail(),
            'role_id' => $role->id,
        ]);

        $response = $this->put(URL::signedRoute('invitations.update', [
            'team' => $team, 'invitation' => $invitation,
        ]));

        $response->assertStatus(200);

        $this->assertNotNull($invitation->fresh()->accepted_at);
    }
}
