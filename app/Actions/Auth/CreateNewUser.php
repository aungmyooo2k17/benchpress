<?php

namespace App\Actions\Auth;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Cratespace\Preflight\Models\Role;
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
        return DB::transaction(function () use ($data) {
            return with(Team::create([
                'name' => $data['team'],
                'email' => $data['email'],
                'phone' => $data['phone'],
            ]), function (Team $team) use ($data) {
                $user = $this->createUserForTeam($team, $data);

                $user->assignRole(Role::firstOrCreate(
                    $this->getDefaultConfig('admin_role')
                ));

                return $user;
            });
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
        return $this->getDefaultConfig('settings', []);
    }

    /**
     * Get default user configurations.
     *
     * @param string|null $key
     * @param mixed|null  $default
     *
     * @return mixed
     */
    public function getDefaultConfig(?string $key = null, $default = null)
    {
        if (! is_null($key)) {
            return config('defaults.users.' . $key, $default);
        }

        return config('defaults.users', $default);
    }
}
