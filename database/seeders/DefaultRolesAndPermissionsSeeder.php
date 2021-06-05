<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Emberfuse\Blaze\Models\Role;
use Emberfuse\Blaze\Models\Permission;

class DefaultRolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(config('defaults.users.roles'))
            ->each(function ($data) {
                $role = Role::create(array_filter($data, function ($key) {
                    return $key !== 'permissions';
                }, \ARRAY_FILTER_USE_KEY));

                collect($data['permissions'])
                    ->each(function ($permission) use ($role) {
                        $role->allowTo(
                            Permission::create(['label' => $permission])
                        );
                    });
            });
    }
}
