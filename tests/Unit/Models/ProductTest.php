<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Team;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function testBelongsToTeam()
    {
        $product = create(Product::class);

        $this->assertInstanceOf(Team::class, $product->team);
    }

    public function testRouteKeyNameIsSlug()
    {
        $product = new Product();

        $this->assertEquals('slug', $product->getRouteKeyName());
    }

    public function testFormatPriceToPresentableValue()
    {
        config()->set(['billing' => [
            'currency' => 'usd',
            'currency_locale' => 'en',
        ]]);

        $product = create(Product::class, ['price' => 1000]);

        $this->assertEquals('$10.00', $product->amount);
    }

    public function testGetName()
    {
        $product = create(Product::class, ['name' => 'Sun Glasses']);

        $this->assertEquals('Sun Glasses', $product->getName());
    }

    public function testGetCode()
    {
        $product = create(Product::class);

        $this->assertNotNull($product->getCode());
    }

    public function testSetCode()
    {
        $product = create(Product::class);

        $product->setCode($code = Str::random(16));
        $this->assertEquals($code, $product->getCode());
    }

    public function testMerchantIsTeamOwner()
    {
        $team = create(Team::class);
        $owner = create(User::class, [
            'team_id' => $team->id,
            'owner' => true,
        ]);
        $product = create(Product::class, ['team_id' => $team->id]);

        $this->assertTrue($owner->is($product->merchant()));
    }

    public function testProductReservation()
    {
        $product = create(Product::class);
        $product->reserve();

        $this->assertNotNull($product->reserved_at);
    }

    public function testProductReleaseFromReservation()
    {
        $product = create(Product::class);
        $product->reserve();

        $this->assertNotNull($product->reserved_at);

        $product->release();

        $this->assertNull($product->fresh()->reserved_at);
    }
}
