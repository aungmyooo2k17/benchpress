<?php

namespace Tests\Feature\Teams;

use Tests\TestCase;
use App\Models\User;
use App\Models\Invitation;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CancelInvitationTest extends TestCase
{
    use RefreshDatabase;

    public function testTeamOwnerCanCancelInvitation()
    {
        $invitation = create(Invitation::class);
        $user = create(User::class, [
            'team_id' => $invitation->team->id,
            'owner' => true,
        ]);

        $this->signIn($user);

        $response = $this->delete("/teams/{$invitation->team->slug}/invitations/{$invitation->id}");

        $response->assertStatus(303);

        $this->assertNull($invitation->fresh());
    }
}
