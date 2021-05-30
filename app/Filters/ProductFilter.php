<?php

namespace App\Filters;

use Cratespace\Preflight\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends Filter
{
    /**
     * Attributes to filters from.
     *
     * @var array
     */
    protected $filters = ['subscriptions'];

    /**
     * Filter the query based on subscription type products.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function subscriptions(): Builder
    {
        return $this->builder->wherePaymentType('recurring');
    }
}
