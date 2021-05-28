<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Team;
use App\Models\User;
use App\Models\Member;
use App\Models\Product;
use App\Models\Invitation;
use Tests\Concerns\CreatesRoles;
use Cratespace\Preflight\Models\Role;
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

        $this->assertTrue($this->user->is($team->owner()));
    }

    public function testTeamHasMembers()
    {
        create(Member::class, ['team_id' => $this->user->team->id]);

        $this->assertInstanceOf(Member::class, $this->user->team->customers->first());
    }

    public function testTeamHasInvitations()
    {
        create(Invitation::class, ['team_id' => $this->user->team->id]);

        $this->assertInstanceOf(Invitation::class, $this->user->team->invitations->first());
    }

    public function testTeamCanInviteNewStaffMember()
    {
        $invitation = $this->user->team->inviteStaffMember([
            'email' => $email = $this->faker->unique()->email(),
            'role_id' => Role::whereName('Administrator')->first()->id,
        ]);

        $this->assertInstanceOf(Invitation::class, $invitation);
        $this->assertEquals($email, $invitation->email);
    }

    public function testTeamHasProducts()
    {
        create(Product::class, ['team_id' => $this->user->team->id]);

        $this->assertInstanceOf(Product::class, $this->user->team->products->first());
    }

    public function testAutoSluggification()
    {
        $team = create(Team::class, ['slug' => null]);

        $this->assertNotNull($team->slug);
    }

    public function testDetermineIfUserBelongsToTeam()
    {
        $team = create(Team::class);
        $teamMember = create(User::class, ['team_id' => $team->id]);
        $foreignMember = create(User::class);

        $this->assertTrue($team->belongsToUser($teamMember));
        $this->assertFalse($team->belongsToUser($foreignMember));
    }
}
