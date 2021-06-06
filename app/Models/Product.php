<?php

namespace App\Models;

use Carbon\Carbon;
use App\Support\Money;
use App\Events\OrderPlaced;
use App\Models\Traits\Orderable;
use App\Contracts\Products\Order;
use App\Contracts\Billing\Payment;
use Illuminate\Database\Eloquent\Model;
use Emberfuse\Blaze\Models\Traits\Hashable;
use Emberfuse\Blaze\Models\Traits\Sluggable;
use Emberfuse\Blaze\Models\Traits\Filterable;
use Emberfuse\Scorch\Models\Traits\HasProfilePhoto;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Contracts\Products\Product as ProductContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model implements ProductContract
{
    use HasFactory;
    use Sluggable;
    use HasProfilePhoto;
    use Hashable;
    use Filterable;
    use Orderable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'price',
        'description',
        'profile_photo_path',
        'slug',
        'dimensions',
        'metadata',
        'reserved_at',
        'payment_type',
        'billing_period',
        'team_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'dimensions' => 'array',
        'metadata' => 'array',
        'reserved_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'amount',
        'path',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the team the product belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Get the subscription the product belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Get all members who purchased this product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class);
    }

    /**
     * Get the product name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * The unique code used to identify the product.
     *
     * @param string $code
     *
     * @return void
     */
    public function setCode(string $code): void
    {
        $this->forceFill(['code' => $code])->save();
    }

    /**
     * The unique code used to identify the product.
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
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
        return $this->price;
    }

    /**
     * Get the presentable value of the price.
     *
     * @return string
     */
    public function getAmountAttribute(): string
    {
        return $this->amount();
    }

    /**
     * Get the owner of the product.
     *
     * @return mixed
     */
    public function merchant()
    {
        return $this->team->owner();
    }

    /**
     * Reserve product for customer.
     *
     * @return void
     */
    public function reserve(): void
    {
        $this->forceFill(['reserved_at' => Carbon::now()])->save();
    }

    /**
     * Release space from order.
     *
     * @return void
     */
    public function release(): void
    {
        $this->forceFill(['reserved_at' => null])->save();
    }

    /**
     * Place an order for the product.
     *
     * @param \App\Contracts\Billing\Payment $payment
     *
     * @return \App\Contracts\Products\Order
     */
    public function placeOrder(Payment $payment): Order
    {
        $this->reserve();

        $order = $this->order()->create([
            'team_id' => $this->team->id,
            'customer_id' => Customer::findByStripeId($payment->customer)->id,
            'amount' => $payment->rawAmount(),
            'payment' => $payment->id,
        ]);

        OrderPlaced::dispatch($order);

        return $order;
    }

    /**
     * Determine if the product is available for purchase.
     *
     * @return bool
     */
    public function available(): bool
    {
        return is_null($this->reserved_at) && ! $this->order()->exists();
    }

    /**
     * Determine if the given code matches the product's unique code.
     *
     * @param string $code
     *
     * @return \Cratespace\Contracts\Products\Product|bool
     */
    public function match(string $code)
    {
        if ($this->code === $code) {
            return $this;
        }

        return false;
    }

    /**
     * Determine if the product payment type is recurring.
     *
     * @return bool
     */
    public function isRecurring(): bool
    {
        return $this->payment_type === 'recurring';
    }

    /**
     * Determine if the product payment type is recurring.
     *
     * @return bool
     */
    public function isOnetime(): bool
    {
        return $this->payment_type === 'onetime';
    }

    /**
     * Get the full url to the product page.
     *
     * @return string
     */
    public function getPathAttribute(): string
    {
        return route('products.show', [
            'team' => $this->team->slug,
            'product' => $this->slug,
        ]);
    }
}
