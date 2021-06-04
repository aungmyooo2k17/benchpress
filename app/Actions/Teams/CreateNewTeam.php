<?php

namespace App\Actions\Teams;

use App\Models\Team;
use Emberfuse\Scorch\Support\Traits\Fillable;
use Emberfuse\Scorch\Contracts\Actions\CreatesNewResources;

class CreateNewTeam implements CreatesNewResources
{
    use Fillable;

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
        $team = Team::whereName($data['team'])->first();

        if (is_null($team)) {
            $team = Team::create([
                'name' => $data['team'],
                'email' => $data['email'],
                'phone' => $data['phone'],
            ]);
        }

        return $team;
    }
}
