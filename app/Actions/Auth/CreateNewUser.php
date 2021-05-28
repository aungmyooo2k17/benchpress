<?php

namespace App\Actions\Auth;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Actions\Team\CreateNewTeam;
use Illuminate\Support\Facades\Hash;
use Cratespace\Sentinel\Support\Util;
use Cratespace\Sentinel\Support\Traits\Fillable;
use Cratespace\Sentinel\Contracts\Actions\CreatesNewUsers;
use Cratespace\Sentinel\Support\Concerns\InteractsWithContainer;

class CreateNewUser implements CreatesNewUsers
{
    use Fillable;
    use InteractsWithContainer;

    /**
     * Create a newly registered user.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data, ?array $options = null)
    {
        return DB::transaction(function () use ($data, $options) {
            return $this->createUserForTeam(
                $this->resolve(CreateNewTeam::class)->create($data, $options),
                $this->filterFillable($data, User::class)
            );
        });
    }

    /**
     * Create new user profile.
     *
     * @param \App\Models\Team $team
     * @param array            $data
     *
     * @return \App\Models\User
     */
    protected function createUserForTeam(Team $team, array $data): User
    {
        return $team->staff()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'username' => Util::makeUsername($data['name']),
            'password' => Hash::make($data['password']),
            'settings' => $this->defaultSettings(),
            'address' => [],
        ]);
    }

    /**
     * Get default user settings array.
     *
     * @return array
     */
    protected function defaultSettings(): array
    {
        return config('defaults.users.settings', []);
    }
}
