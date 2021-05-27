<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use Tests\Concerns\CreatesRoles;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamTest extends TestCase
{
    use RefreshDatabase;
    use CreatesRoles;

    /**
     * The user instance.
     *
     * @var \App\Models\User
     */
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->createDefaultRoles();

        $this->user = create(User::class, [], 'withTeam');

        $this->user->assignRole('Administrator');
    }

    public function testTeamHasAnAdministrator()
    {
        $team = $this->user->team;

        $this->assertTrue($this->user->is($team->owner));
    }
}
