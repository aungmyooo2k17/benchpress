<?php

namespace Tests\Feature\Members;

use Tests\TestCase;
use App\Models\Team;
use App\Models\User;
use App\Models\Member;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Cratespace\Preflight\Testing\Contracts\Postable;

class MemberSubscriptionTest extends TestCase implements Postable
{
    use RefreshDatabase;

    public function testMembersRegistration()
    {
        $this->withoutExceptionHandling();

        $team = create(Team::class);
        $user = create(User::class, ['team_id' => $team->id]);
        $product = create(Product::class, [
            'team_id' => $team->id,
            'payment_type' => 'recurring',
            'billing_period' => 'Yearly',
        ]);

        $this->signIn($user);

        $response = $this->post("/teams/{$team->slug}/members", $this->validParameters([
            'team_id' => $team->id,
            'payment_method' => Str::random(24),
            'product' => $product->id,
        ]));

        $response->assertStatus(303);
        $this->assertCount(1, Member::all());
        $this->assertCount(1, Subscription::all());
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
            'email' => 'test@example.com',
            'phone' => '0712345678',
            'line1' => '4431 Birch Street',
            'city' => 'Greenwood',
            'state' => 'Indiana',
            'country' => 'United States',
            'postal_code' => '46142',
        ], $overrides);
    }
}
