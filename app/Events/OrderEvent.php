<?php

namespace App\Events;

use App\Contracts\Products\Order;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

abstract class OrderEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Contracts\Products\Order
     */
    protected $order;

    /**
     * Create a new event instance.
     *
     * @param \App\Contracts\Products\Order $order
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
}
