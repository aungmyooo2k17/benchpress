<?php

namespace App\Actions\Product;

use Cratespace\Sentinel\Contracts\Actions\CreatesNewResources;

class CreateNewProduct implements CreatesNewResources
{
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
        return $options['team']->products()->create([
            'name' => $data['name'],
            'price' => $data['price'],
            'description' => $data['description'] ?? null,
            'dimensions' => [
                'height' => $data['height'] ?? null,
                'width' => $data['width'] ?? null,
                'length' => $data['length'] ?? null,
            ],
            'metadata' => [],
            'payment_type' => $data['payment_type'],
            'billing_period' => $data['billing_period'],
        ]);
    }
}
