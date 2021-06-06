<?php

namespace Tests\Unit\Products;

use Tests\TestCase;
use App\Products\ProductFactory;
use App\Contracts\Products\Product;
use App\Models\Product as ProductModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Contracts\Products\ProductFactory as ProductFactoryContract;

class ProductFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function testInstantiation()
    {
        $factory = new ProductFactory();

        $this->assertInstanceOf(ProductFactoryContract::class, $factory);
    }

    public function testCreateNewProduct()
    {
        $factory = new ProductFactory();

        $product = $factory->make(array_merge(
            make(ProductModel::class)->toArray(),
        ));

        $this->assertInstanceOf(Product::class, $product);
    }
}
