<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'username' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'email_verified_at' => Carbon::now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'settings' => [],
            'address' => [
                'line1' => $this->faker->streetName(),
                'line2' => null,
                'city' => $this->faker->city(),
                'state' => $this->faker->state(),
                'country' => $this->faker->country(),
                'postal_code' => $this->faker->postcode(),
            ],
            'locked' => false,
            'profile_photo_path' => null,
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'team_id' => create(Team::class)->id,
        ];
    }

    /**
     * Indicate that the user should have a personal team.
     *
     * @return $this
     */
    public function withTeam()
    {
        return $this->forTeam([
            'name' => $name = $this->faker->company(),
            'email' => $this->faker->unique()->email(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'slug' => Str::slug($name . uniqid()),
            'description' => 'User\'s Team.',
        ]);
    }
}
