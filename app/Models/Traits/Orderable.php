<?php

namespace App\Models\Traits;

use App\Models\Order;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait Orderable
{
    /**
     * Get the order associated with the product.
     *
     * @return mixed
     */
    public function order(): MorphOne
    {
        return $this->morphOne(Order::class, 'orderable');
    }
}
