<?php

namespace App\Actions\Products;

use App\Models\Product;

class UpdateProduct
{
    /**
     * Preform certain action using the given data.
     *
     * @param \App\Contracts\Products\Product $product
     * @param array[]                         $data
     * @param array|null                      $options
     *
     * @return void
     */
    public function update(
        Product $product,
        array $data = [],
        ?array $options = null
    ): void {
        $product->update($data);
    }
}
