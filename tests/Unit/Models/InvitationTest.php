<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Team;
use App\Models\Invitation;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvitationTest extends TestCase
{
    use RefreshDatabase;

    public function testBelongsToTeam()
    {
        $invitation = create(Invitation::class);

        $this->assertInstanceOf(Team::class, $invitation->team);
    }

    public function testCanDetermineIfAcceptedOrNot()
    {
        $invitation = create(Invitation::class);

        $this->assertFalse($invitation->accepted());
    }

    public function testCanAccept()
    {
        $invitation = create(Invitation::class);

        $invitation->accept();

        $this->assertTrue($invitation->accepted());
    }

    public function testCancellation()
    {
        $invitation = create(Invitation::class);

        $invitation->cancel();

        $this->assertNull($invitation->fresh());
    }

    public function testaCannotCancelIfAccepted()
    {
        $invitation = create(Invitation::class);

        $invitation->accept();

        $invitation->cancel();

        $this->assertNotNull($invitation->fresh());
    }
}
