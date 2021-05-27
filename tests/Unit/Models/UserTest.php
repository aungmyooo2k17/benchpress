<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testUserBelongsToATeam()
    {
        $user = create(User::class, [], 'withTeam');

        $this->assertInstanceOf(Team::class, $user->team);
    }
}
