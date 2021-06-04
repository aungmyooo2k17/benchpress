<?php

namespace App\Models;

use Carbon\Carbon;
use Emberfuse\Blaze\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invitation extends Model
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
     * Accept the invitations.
     *
     * @return bool
     */
    public function accept(): bool
    {
        return $this->forceFill(['accepted_at' => Carbon::now()])->save();
    }

    /**
     * Cancel the invitation.
     *
     * @return void
     */
    public function cancel(): void
    {
        $this->delete();
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
     * Get the role the invitation belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
