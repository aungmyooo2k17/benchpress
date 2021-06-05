<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        create(Team::class)
            ->members()
            ->create(config('defaults.users.credentials'))
            ->assignRole('Administrator');
    }
}
