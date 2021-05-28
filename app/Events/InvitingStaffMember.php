<?php

namespace App\Events;

use App\Models\Team;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class InvitingStaffMember
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * The team instance.
     *
     * @var \App\Models\Team
     */
    public $team;

    /**
     * The email address of the invitee.
     *
     * @var string
     */
    public $email;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\Team $team
     * @param string           $email
     *
     * @return void
     */
    public function __construct(Team $team, string $email)
    {
        $this->team = $team;
        $this->email = $email;
    }
}
