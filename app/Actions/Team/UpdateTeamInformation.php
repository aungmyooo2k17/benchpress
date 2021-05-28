<?php

namespace App\Actions\Team;

use App\Models\Team;
use Cratespace\Sentinel\Support\Traits\Fillable;

class UpdateTeamInformation
{
    use Fillable;

    /**
     * Validate and update the given team profile information.
     *
     * @param \App\Models\Team $team
     * @param array            $data
     * @param array|null       $options
     *
     * @return void
     */
    public function update(Team $team, array $data, ?array $options = null): void
    {
        $team->update(
            $this->filterFillable(array_merge($data, $options ?? []), $team)
        );
    }
}
