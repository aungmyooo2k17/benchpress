<?php

namespace App\Actions\Teams;

use App\Models\Team;
use App\Mail\TeamInvitation;
use App\Events\InvitationSent;
use Illuminate\Support\Facades\Mail;
use App\Exceptions\InvitationException;
use App\Contracts\Actions\InvitesMember;

class InviteMember implements InvitesMember
{
    /**
     * Invite a new member to the team.
     *
     * @param \App\Models\Team $team
     * @param array            $data
     *
     * @return mixed
     */
    public function invite(Team $team, array $data)
    {
        if ($team->hasMember($data['email'])) {
            throw InvitationException::userAlreadyInvited($data['email']);
        }

        $invitation = $team->invitations()->create($data);

        Mail::to($data['email'])->send(new TeamInvitation($invitation));

        InvitationSent::dispatch($invitation);

        return $invitation;
    }
}
