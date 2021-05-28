<?php

namespace App\Mail;

use App\Models\Team;
use App\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\URL;
use Illuminate\Queue\SerializesModels;

class TeamInvitation extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * The team invitation instance.
     *
     * @var \App\Models\Invitation
     */
    public $invitation;

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

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.teams.invitation', [
            'acceptUrl' => URL::signedRoute('invitations.update', [
                'team' => $this->invitation->team,
                'invitation' => $this->invitation,
                'status' => 'accept',
            ]),
            'rejectUrl' => URL::signedRoute('invitations.update', [
                'team' => $this->invitation->team,
                'invitation' => $this->invitation,
                'status' => 'reject',
            ]),
        ])
        ->subject(__($this->buildSubjectLine(
            $this->invitation->team
        )))
        ->from(
            $this->invitation->team->owner()->email,
            $this->invitation->team->owner()->name
        );
    }

    /**
     * Build the string that will be the subject line of the email.
     *
     * @param \App\Models\Team $team
     *
     * @return string
     */
    public function buildSubjectLine(Team $team): string
    {
        return "{$team->name} Team Invitation";
    }
}
