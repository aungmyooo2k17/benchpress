<?php

namespace App\Contracts\Actions;

use App\Models\Team;

interface InvitesMember
{
    /**
     * Invite a new member to the team.
     *
     * @param \App\Models\Team $team
     * @param array            $data
     *
     * @return mixed
     */
    public function invite(Team $team, array $data);
}
