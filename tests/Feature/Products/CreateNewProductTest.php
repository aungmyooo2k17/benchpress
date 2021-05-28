<?php

namespace Tests\Feature\Products;

use Tests\TestCase;
use App\Models\Team;
use App\Models\User;
use App\Models\Product;
use Tests\Concerns\CreatesRoles;
use Tests\Concerns\DeterminesProductType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Cratespace\Preflight\Testing\Contracts\Postable;

class CreateNewProductTest extends TestCase implements Postable
{
    use RefreshDatabase;
    use CreatesRoles;
    use DeterminesProductType;

    protected function setUp(): void
    {
        parent::setUp();

        $this->createDefaultRoles();
    }

    public function testCreateNewProduct()
    {
        $team = create(Team::class);
        $user = create(User::class, ['team_id' => $team->id]);

        $user->assignRole('Administrator');

        $this->signIn($user);

        $response = $this->post(
            "/teams/{$team->slug}/products",
            $this->validParameters()
        );

        $response->assertStatus(303);
        $this->assertCount(1, Product::all());
    }

    /**
     * Provide only the necessary paramertes for a POST-able type request.
     *
     * @param array $overrides
     *
     * @return array
     */
    public function validParameters(array $overrides = []): array
    {
        [$paymentType, $billingPeriod] = $this->getProductType();

        return array_merge([
            'name' => $this->faker->word(),
            'price' => 1000,
            'description' => $this->faker->paragraph(),
            'height' => rand(1, 9),
            'width' => rand(1, 9),
            'length' => rand(1, 9),
            'payment_type' => $paymentType,
            'billing_period' => $billingPeriod ?? 'Daily',
        ], $overrides);
    }
}
