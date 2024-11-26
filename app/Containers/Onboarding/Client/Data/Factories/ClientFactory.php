<?php

namespace App\Containers\Onboarding\Client\Data\Factories;

use App\Containers\Onboarding\Client\Models\Client;
use App\Ship\Parents\Factories\Factory as ParentFactory;

/**
 * @template TModel of ClientFactory
 *
 * @extends ParentFactory<TModel>
 */
class ClientFactory extends ParentFactory
{
    /** @var class-string<TModel> */
    protected $model = Client::class;

    public function definition(): array
    {
        return [
            //
        ];
    }
}
