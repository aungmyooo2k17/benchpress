<?php

namespace App\Actions\Team;

use App\Models\Team;
use App\Models\Invitation;

class InviteStaffMember
{
    /**
     * Invite a staff member to the team.
     *
     * @param \App\Models\Team $team
     * @param array            $data
     *
     * @return \App\Models\Invitation
     */
    public function invite(Team $team, array $data): Invitation
    {
        $invitation = $team->inviteStaffMember($data);

        return $invitation;
    }
}
