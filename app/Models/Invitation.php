<?php

namespace App\Models;

use Carbon\Carbon;
use Cratespace\Preflight\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cratespace\Contracts\Business\Invitation as BusinessInvitation;

class Invitation extends Model implements BusinessInvitation
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'role_id',
        'team_id',
        'accepted_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'accepted_at' => 'datetime',
    ];

    /**
     * Get the user the invitation belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the role assigned to the initee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the team the invitation belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Accept this invitation.
     *
     * @return bool
     */
    public function accept(): bool
    {
        if (! is_null($this->rejected_at)) {
            return false;
        }

        return $this->forceFill([
            'accepted_at' => Carbon::now(),
        ])->saveQuietly();
    }

    /**
     * Reject this invitation.
     *
     * @return bool
     */
    public function reject(): bool
    {
        $this->cancel();

        return true;
    }

    /**
     * Cancel a course of action or a resource.
     *
     * @return void
     */
    public function cancel(): void
    {
        if (! is_null($this->accepted_at)) {
            return;
        }

        $this->delete();
    }
}
