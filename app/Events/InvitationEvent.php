<?php

namespace App\Events;

use App\Models\Invitation;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class InvitationEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * The invitation instance.
     *
     * @var \App\Models\Invitation
     */
    protected $invitation;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Invitation $invitation
     *
     * @return void
     */
    public function __construct(Invitation $invitation)
    {
        $this->invitation = $invitation;
    }
}
