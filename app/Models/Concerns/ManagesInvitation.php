<?php

namespace App\Models\Concerns;

use App\Exceptions\InvitationException;
use Cratespace\Contracts\Business\Invitation;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait ManagesInvitation
{
    /**
     * Get the invitation that belongs to the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function invitation(): HasOne
    {
        return $this->hasOne(Invitation::class);
    }

    /**
     * Invite the business user to Cratesapce.
     *
     * @return \Cratespace\Contracts\Business\Invitation
     */
    public function invite(): Invitation
    {
        if ($this->invited()) {
            throw new InvitationException('This user has already been invited.');
        }

        return $this->invitation()->create([
            'team_id' => $this->team->id,
            'email' => $this->email,
        ]);
    }

    /**
     * Determine wether the user has already been invited.
     *
     * @return bool
     */
    public function invited(): bool
    {
        return $this->invitation()->exists() ||
            ! is_null(optional($this->invitation)->accepted_at);
    }
}
