<?php

namespace App\Actions\Subscription;

use Cratespace\Sentinel\Contracts\Actions\CreatesNewResources;

class CreateNewSubscription implements CreatesNewResources
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
    }
}
