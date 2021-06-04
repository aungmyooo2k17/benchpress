<?php

namespace App\Actions\Teams;

use App\Models\Team;
use App\Contracts\Actions\UpdatesTeamInformation;

class UpdateTeamInformation implements UpdatesTeamInformation
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
    public function update(Team $team, array $data, ?array $options = null): void
    {
        $team->update(array_merge($data, $options ?? []));
    }
}
