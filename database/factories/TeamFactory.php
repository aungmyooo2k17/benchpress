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
            'name' => $name = $this->faker->unique()->company(),
            'slug' => Str::slug($name . uniqid()),
            'email' => $this->faker->unique()->email(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'description' => $this->faker->paragraph(),
        ];
    }
}
