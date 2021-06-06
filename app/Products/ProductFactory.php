<?php

namespace App\Products;

use App\Models\Team;
use Illuminate\Support\Facades\DB;
use App\Contracts\Products\Product;
use App\Models\Product as ProductModel;
use App\Contracts\Teams\Team as TeamContract;
use Emberfuse\Scorch\Support\Traits\Fillable;
use App\Contracts\Products\ProductFactory as FactoryContract;
use Emberfuse\Scorch\Support\Concerns\InteractsWithContainer;

class ProductFactory implements FactoryContract
{
    use Fillable;
    use InteractsWithContainer;

    /**
     * Create a new product.
     *
     * @param array      $data
     * @param array|null $options
     *
     * @return \App\Contracts\Products\Product
     */
    public function make(array $data, ?array $options = null): Product
    {
        $this->setMetadata($options ?? []);

        return DB::transaction(function () use ($data, $options) {
            return with($this->findTeam(
                $data['team_id'] ?: $options['team_id']
            ), function (Team $team) use ($data, $options): Product {
                $data = array_merge($this->parseData($data), $options ?: []);

                return $team->products()->create(
                    $this->filterFillable($data, ProductModel::class)
                );
            });
        });
    }

    /**
     * Find the currently authenticated team.
     *
     * @param int $id
     *
     * @return \App\Contracts\Teams\Team
     */
    protected function findTeam(int $id): TeamContract
    {
        return tap(Team::find($id))->fresh();
    }

    /**
     * Parse the data to be used when creating the product.
     *
     * @param array $data
     *
     * @return array
     */
    protected function parseData(array $data): array
    {
        return array_merge([
            'name' => $data['name'],
            'price' => $data['price'],
            'payment_type' => $data['payment_type'],
            'billing_period' => $data['billing_period'],
            'description' => $data['description'],
            'dimensions' => [
                'height' => $data['height'] ?? null,
                'width' => $data['width'] ?? null,
                'length' => $data['length'] ?? null,
            ],
        ], $this->defaultOptions());
    }

    /**
     * Set of default options to sabed as metadata for the product.
     *
     * @return array
     */
    protected function defaultOptions(): array
    {
        return $this->metadata;
    }

    /**
     * Set default options.
     *
     * @param array $options
     *
     * @return void
     */
    public function setMetadata(array $options = []): void
    {
        $this->metadata = array_merge([
            'created_by' => $this->resolve('request')->ip(),
        ], $options);
    }
}
