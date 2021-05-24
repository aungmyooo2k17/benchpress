<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\Team;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Cratespace\Preflight\Testing\Contracts\Postable;

class RegistrationTest extends TestCase implements Postable
{
    use RefreshDatabase;

    public function testRegistrationScreenCanBeRendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function testNewUsersCanRegister()
    {
        $response = $this->post('/register', $this->validParameters());

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);

        $this->assertCount(1, User::all());
        $this->assertCount(1, Team::all());
    }

    public function testNewUsersCanRegisterThrougJsonRequest()
    {
        $response = $this->postJson('/register', $this->validParameters());

        $this->assertAuthenticated();
        $response->assertStatus(201);

        $this->assertCount(1, User::all());
        $this->assertCount(1, Team::all());
    }

    public function testValidNameIsRequired()
    {
        $response = $this->post('/register', $this->validParameters([
            'name' => '',
        ]));

        $this->assertGuest();
        $response->assertStatus(302);
        $response->assertSessionHasErrors('name');
    }

    public function testValidTeamNameIsRequired()
    {
        $response = $this->post('/register', $this->validParameters([
            'team' => '',
        ]));

        $this->assertGuest();
        $response->assertStatus(302);
        $response->assertSessionHasErrors('team');
    }

    public function testValidEmailIsRequired()
    {
        $response = $this->post('/register', $this->validParameters([
            'email' => '',
        ]));

        $this->assertGuest();
        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
    }

    public function testValidPhoneIsRequired()
    {
        $response = $this->post('/register', $this->validParameters([
            'phone' => '',
        ]));

        $this->assertGuest();
        $response->assertStatus(302);
        $response->assertSessionHasErrors('phone');
    }

    public function testValidPasswordIsRequired()
    {
        $response = $this->post('/register', $this->validParameters([
            'password' => '',
        ]));

        $this->assertGuest();
        $response->assertStatus(302);
        $response->assertSessionHasErrors('password');
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
            'name' => 'Test User',
            'team' => 'Exogym',
            'email' => 'test@example.com',
            'phone' => '0712345678',
            'password' => 'password',
            'password_confirmation' => 'password',
        ], $overrides);
    }
}
