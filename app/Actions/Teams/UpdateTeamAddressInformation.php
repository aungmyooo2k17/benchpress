<?php

namespace App\Actions\Teams;

use App\Models\Team;
use App\Contracts\Actions\UpdatesTeamInformation;

class UpdateTeamAddressInformation implements UpdatesTeamInformation
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
        $team->update([
            'address' => [
                'line1' => $data['line1'],
                'line2' => $data['line2'] ?? null,
                'city' => $data['city'],
                'state' => $data['state'],
                'country' => $data['country'],
                'postal_code' => $data['postal_code'],
            ],
        ]);
    }
}
