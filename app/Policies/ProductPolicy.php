<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Product $product
     *
     * @return mixed
     */
    public function manage(User $user, Product $product)
    {
        if ($user->isAdmin()) {
            return $user->team->is($product->team);
        }

        return false;
    }
}
