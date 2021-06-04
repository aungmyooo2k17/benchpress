<?php

namespace App\Actions\Auth;

use App\Models\Team;
use App\Models\User;
use Emberfuse\Scorch\Support\Util;
use Illuminate\Support\Facades\DB;
use App\Actions\Teams\CreateNewTeam;
use Illuminate\Support\Facades\Hash;
use Emberfuse\Scorch\Support\Traits\Fillable;
use Emberfuse\Scorch\Contracts\Actions\CreatesNewUsers;
use Emberfuse\Scorch\Support\Concerns\InteractsWithContainer;

class CreateNewUser implements CreatesNewUsers
{
    use Fillable;
    use InteractsWithContainer;

    protected $team;

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
            return $this->createUserWithTeam(
                $this->createOrFindTeam($data, $options),
                $this->filterFillable($data, User::class)
            );
        });
    }

    /**
     * Create a new team or find one if it exists.
     *
     * @param array      $data
     * @param array|null $options
     *
     * @return \App\Models\Team
     */
    public function createOrFindTeam(array $data, ?array $options = null): Team
    {
        return $this->resolve(CreateNewTeam::class)->create($data, $options);
    }

    /**
     * Create new user profile.
     *
     * @param \App\Models\Team $team
     * @param array            $data
     *
     * @return \App\Models\User
     */
    protected function createUserWithTeam(Team $team, array $data): User
    {
        $owner = $team->wasRecentlyCreated ?: false;

        return $team->members()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'username' => Util::makeUsername($data['name']),
            'password' => Hash::make($data['password']),
            'settings' => $this->setDefaultSettings(),
            'owner' => $owner,
        ]);
    }

    /**
     * Get default user settings array.
     *
     * @return array
     */
    protected function setDefaultSettings(): array
    {
        return config('defaults.users.settings', []);
    }
}
