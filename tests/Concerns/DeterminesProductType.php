<?php

namespace Tests\Concerns;

use Illuminate\Foundation\Testing\WithFaker;

trait DeterminesProductType
{
    use WithFaker;

    /**
     * Dynamically determine product type.
     *
     * @return array
     */
    protected function getProductType(): array
    {
        $paymentType = $this->faker->randomElement(['onetime', 'recurring']);
        $billingPeriod = null;

        if ($paymentType === 'recurring') {
            $billingPeriod = $this->faker->randomElement(['Daily', 'Weekly', 'Monthly', 'Yearly']);
        }

        return [$paymentType, $billingPeriod];
    }
}
