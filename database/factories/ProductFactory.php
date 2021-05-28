<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\Product;
use Illuminate\Support\Str;
use Tests\Concerns\DeterminesProductType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    use DeterminesProductType;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        [$paymentType, $billingPeriod] = $this->getProductType();

        return [
            'name' => $this->faker->word(),
            'code' => Str::random(24),
            'price' => 1000,
            'description' => $this->faker->paragraph(),
            'profile_photo_path' => null,
            'dimensions' => [
                'height' => rand(1, 9),
                'width' => rand(1, 9),
                'length' => rand(1, 9),
            ],
            'metadata' => [
                'note' => $this->faker->paragraph(),
            ],
            'reserved_at' => null,
            'payment_type' => $paymentType,
            'billing_period' => $billingPeriod,
            'team_id' => create(Team::class)->id,
        ];
    }
}
