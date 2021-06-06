<?php

namespace App\Actions\Products;

use App\Contracts\Products\ProductFactory;
use Emberfuse\Scorch\Contracts\Actions\CreatesNewResources;

class CreateNewProduct implements CreatesNewResources
{
    /**
     * The product factory.
     *
     * @var \App\Contracts\Products\ProductFactory
     */
    protected $factory;

    /**
     * Create new instance of product creator.
     *
     * @param \App\Contracts\Products\ProductFactory $factory
     *
     * @return void
     */
    public function __construct(ProductFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Create a new resource type.
     *
     * @param array      $data
     * @param array|null $options
     *
     * @return mixed
     */
    public function create(array $data, ?array $options = null)
    {
        return $this->factory->make($data, $options);
    }
}
