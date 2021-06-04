<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $name = $this->faker->company(),
            'slug' => Str::slug($name),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'description' => $this->faker->paragraph(),
            'address' => [
                'line1' => $this->faker->streetName(),
                'line2' => null,
                'city' => $this->faker->city(),
                'state' => $this->faker->state(),
                'country' => $this->faker->country(),
                'postal_code' => $this->faker->postcode(),
            ],
        ];
    }
}
