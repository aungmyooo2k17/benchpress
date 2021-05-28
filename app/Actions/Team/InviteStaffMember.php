<?php

namespace App\Actions\Team;

use App\Models\Team;
use App\Models\Invitation;
use App\Mail\TeamInvitation;
use App\Events\InvitingStaffMember;
use Illuminate\Support\Facades\Mail;

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

        InvitingStaffMember::dispatch($team, $data['email']);

        Mail::to($data['email'])->send(new TeamInvitation($invitation));

        return $invitation;
    }
}
