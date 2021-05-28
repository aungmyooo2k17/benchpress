<?php

namespace App\Actions\Member;

use Carbon\Carbon;
use App\Models\Member;
use App\Models\Product;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Cratespace\Sentinel\Support\Util;
use Cratespace\Sentinel\Support\Traits\Fillable;
use Cratespace\Sentinel\Contracts\Actions\CreatesNewResources;

class CreateNewMember implements CreatesNewResources
{
    use Fillable;

    /**
     * Create a new resource type.
     *
     * @param array      $data
     * @param array|null $options
     *
     * @return mixed
     */
    public function create(array $data, ?array $options = null)
    {
        DB::transaction(function () use ($data) {
            return with($this->createMember(
                array_merge($data, $options ?? [])
            ), function (Member $member) use ($data) {
                $product = Product::find($data['product']);

                if ($product->isOnetime()) {
                    throw new InvalidArgumentException('Product does not have recurring payments');
                }

                $member->subscription()->create([
                    'product_id' => $product->id,
                    'started_at' => Carbon::now(),
                ]);

                return $member;
            });
        });
    }

    /**
     * Create a new member profile.
     *
     * @param array $data
     *
     * @return \App\Models\Member
     */
    protected function createMember(array $data): Member
    {
        return Member::create([
            'team_id' => $data['team_id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'username' => Util::makeUsername($data['name']),
            'address' => [
                'line1' => $data['line1'],
                'line2' => $data['line2'] ?? null,
                'city' => $data['city'],
                'state' => $data['state'],
                'country' => $data['country'],
                'postal_code' => $data['postal_code'],
            ],
        ]);
    }
}
