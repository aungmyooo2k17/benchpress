<?php

namespace App\Exceptions;

use Exception;
use App\Models\User;

class InvitationException extends Exception
{
    /**
     * Indicate that the given user has already been invited.
     *
     * @param \App\Models\User|string $user
     *
     * @return \App\Exceptions\InvitationException
     */
    public static function userAlreadyInvited($user): InvitationException
    {
        if (is_string($user)) {
            $user = User::whereEmail($user)->first();
        }

        return new static("User {$user->name} has already been invited.");
    }
}
