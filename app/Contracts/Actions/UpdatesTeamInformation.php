<?php

namespace App\Contracts\Actions;

use App\Models\Team;

interface UpdatesTeamInformation
{
    /**
     * Validate and update the given team's profile information.
     *
     * @param \App\Models\Team $team
     * @param array            $data
     * @param array|null       $options
     *
     * @return void
     */
    public function update(Team $team, array $data, ?array $options = null): void;
}
