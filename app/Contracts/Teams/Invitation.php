<?php

namespace App\Contracts\Teams;

interface invitation
{
    /**
     * Accept this invitation.
     *
     * @return bool
     */
    public function accept(): bool;
}
