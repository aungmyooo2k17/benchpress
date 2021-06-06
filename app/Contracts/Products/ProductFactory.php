<?php

namespace App\Contracts\Products;

interface ProductFactory
{
    /**
     * Create a new product.
     *
     * @param array      $data
     * @param array|null $options
     *
     * @return \App\Contracts\Products
     */
    public function make(array $data, ?array $options = null): Product;
}
