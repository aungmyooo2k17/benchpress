<?php

namespace App\Mail;

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

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->invitation->team->email)
            ->markdown('emails.teams.invitation', [
                'invitation' => $this->invitation,
                'acceptUrl' => URL::signedRoute('invitations.update', [
                    'team' => $this->invitation->team,
                    'invitation' => $this->invitation,
                ]),
            ])
            ->buildSubjectLine();
    }

    /**
     * Build the subject.
     *
     * @return \Illuminate\Mail\Mailable
     */
    protected function buildSubjectLine(): Mailable
    {
        return $this->subject(__(
            "{$this->invitation->team->name} Team Invitation"
        ));
    }
}
