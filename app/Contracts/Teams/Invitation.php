<?php

namespace App\Contracts\Teams;

use App\Contracts\Support\Cancellable;

interface invitation extends Cancellable
{
    /**
     * Accept this invitation.
     *
     * @return bool
     */
    public function accept(): bool;
}
