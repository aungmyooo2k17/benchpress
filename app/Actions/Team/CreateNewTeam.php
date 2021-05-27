<?php

namespace App\Actions\Team;

use App\Models\Team;
use Cratespace\Sentinel\Contracts\Actions\CreatesNewResources;

class CreateNewTeam implements CreatesNewResources
{
    /**
     * Create a new resource type.
     *
     * @param array      $data
     * @param array|null $options
     *
     * @return mixed
     */
    public function create(array $data, ?array $options = null)
    {
        return Team::firstOrCreate([
            'name' => $data['team'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ]);
    }
}
