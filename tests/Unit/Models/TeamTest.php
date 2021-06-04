<?php

namespace Tests\Unit\Models;

use stdClass;
use Tests\TestCase;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamTest extends TestCase
{
    use RefreshDatabase;

    public function testHasMembers()
    {
        $team = create(Team::class);

        $this->assertInstanceOf(Collection::class, $team->members);
    }

    public function testGetOwner()
    {
        $team = create(Team::class);
        $user = create(User::class, [
            'team_id' => $team->id,
            'owner' => true,
        ]);

        $this->assertTrue($user->isOwner());
        $this->assertTrue($team->owner()->is($user));
    }

    public function testCanIdentifyMember()
    {
        $team = create(Team::class);
        $user = create(User::class, ['team_id' => $team->id]);

        $this->assertTrue($team->hasMember($user));
    }

    public function testCanIdentifyOwner()
    {
        $team = create(Team::class);
        $user = create(User::class, [
            'team_id' => $team->id,
            'owner' => true,
        ]);

        $this->assertTrue($team->ownerIs($user));
    }

    public function testTeamHasAddress()
    {
        $team = create(Team::class);

        $this->assertInstanceOf(stdClass::class, $team->address);
    }
}
