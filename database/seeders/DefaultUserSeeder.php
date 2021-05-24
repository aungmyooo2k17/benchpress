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
        $team = Team::factory()->create();

        $user = $team->users()->create((config('defaults.users.credentials')));

        $user->assignRole('Administrator');
    }
}
