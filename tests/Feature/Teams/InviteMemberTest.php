<?php

namespace Tests\Feature\Teams;

use Tests\TestCase;
use App\Models\Team;
use App\Models\User;
use App\Models\Invitation;
use Emberfuse\Blaze\Models\Role;
use Illuminate\Support\Facades\Mail;
use Emberfuse\Blaze\Testing\Contracts\Postable;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InviteMemberTest extends TestCase implements Postable
{
    use RefreshDatabase;

    /**
     * The role instance.
     *
     * @var \Emberfuse\Blaze\Models\Role
     */
    protected $role;

    /**
     * The team instance.
     *
     * @var \App\Models\Team
     */
    protected $team;

    /**
     * The user instance.
     *
     * @var \App\Models\User
     */
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->role = Role::create(['name' => 'Staff', 'slug' => 'staff']);

        $this->team = create(Team::class);

        $user = create(User::class, [
            'team_id' => $this->team->id,
            'owner' => true,
        ]);

        $this->signIn($user);
    }

    public function testOwnerCanInviteAnotherMember()
    {
        Mail::fake();
        $this->withoutEvents();

        $response = $this->post(
            "/teams/{$this->team->slug}/invitations",
            $this->validParameters()
        );

        $invitation = Invitation::first();

        $this->assertInstanceOf(Role::class, $invitation->role);
        $this->assertTrue($invitation->role->is($this->role));

        $response->assertStatus(303);
    }

    public function testValidEmailIsRequired()
    {
        $response = $this->post(
            "/teams/{$this->team->slug}/invitations",
            $this->validParameters([
                'email' => '',
            ])
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
    }

    public function testValidRoleIdIsRequired()
    {
        $response = $this->post(
            "/teams/{$this->team->slug}/invitations",
            $this->validParameters([
                'role_id' => 2,
            ])
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrors('role_id');
    }

    public function testCannotInvitePreviouslyInvitedMember()
    {
        $user = create(User::class);
        $this->team->invitations()->create([
            'email' => $user->email,
            'role_id' => 1,
        ]);

        $response = $this->post(
            "/teams/{$this->team->slug}/invitations",
            $this->validParameters([
                'email' => $user->email,
            ])
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
    }

    /**
     * Provide only the necessary paramertes for a POST-able type request.
     *
     * @param array $overrides
     *
     * @return array
     */
    public function validParameters(array $overrides = []): array
    {
        return array_merge([
            'email' => $this->faker->safeEmail(),
            'role_id' => 1,
        ], $overrides);
    }
}
