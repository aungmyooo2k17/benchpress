<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\Invitation;
use Emberfuse\Blaze\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvitationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invitation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'role_id' => Role::create(['name' => 'Staff', 'slug' => 'staff'])->id,
            'team_id' => create(Team::class)->id,
            'accepted_at' => null,
        ];
    }
}
