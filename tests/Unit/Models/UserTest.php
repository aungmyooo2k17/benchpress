<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testUserBelongsToAteam()
    {
        $team = create(Team::class);
        $user = create(User::class, ['team_id' => $team->id]);

        $this->assertInstanceOf(Team::class, $user->team);
        $this->assertTrue($team->is($user->team));
    }
}
