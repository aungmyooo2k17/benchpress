<?php

namespace App\Models;

use App\Support\Money;
use App\Models\Casts\PaymentCast;
use App\Contracts\Products\Product;
use Illuminate\Database\Eloquent\Model;
use Emberfuse\Blaze\Models\Traits\Hashable;
use Emberfuse\Blaze\Models\Traits\Filterable;
use App\Contracts\Products\Order as OrderContract;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model implements OrderContract
{
    use HasFactory;
    use Filterable;
    use Hashable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'code',
        'user_id',
        'customer_id',
        'confirmation_number',
        'orderable_id',
        'orderable_type',
        'amount',
        'payment',
        'note',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'payment' => PaymentCast::class,
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'code';
    }

    /**
     * Get the total amount that will be paid.
     *
     * @return string
     */
    public function amount(): string
    {
        return Money::format($this->rawAmount());
    }

    /**
     * Get the raw total amount that will be paid.
     *
     * @return int
     */
    public function rawAmount(): int
    {
        return $this->amount;
    }

    /**
     * Get the business the order was placed at.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Get the customer the order was placed for.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the order belonging to the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function orderable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Find an order with the given confirmation number.
     *
     * @param string $confirmationNumber
     *
     * @return \App\Models\Order
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public static function findByConfirmationNumber(string $confirmationNumber): Order
    {
        return static::where(
            'confirmation_number',
            $confirmationNumber
        )->firstOrFail();
    }

    /**
     * Get the product associated with this order.
     *
     * @return \App\Contracts\Products\Product
     */
    public function product(): Product
    {
        return $this->orderable;
    }

    /**
     * Confirm order for customer.
     *
     * @return void
     */
    public function confirm(): void
    {
    }

    /**
     * Cancel a course of action or a resource.
     *
     * @return void
     */
    public function cancel(): void
    {
    }
}
