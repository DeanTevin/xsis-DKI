<?php

namespace App\Containers\AppSection\Master\Data\Factories;

use App\Containers\AppSection\Master\Models\Master;
use App\Ship\Parents\Factories\Factory as ParentFactory;

/**
 * @template TModel of MasterFactory
 *
 * @extends ParentFactory<TModel>
 */
class MasterFactory extends ParentFactory
{
    /** @var class-string<TModel> */
    protected $model = Master::class;

    public function definition(): array
    {
        return [
            //
        ];
    }
}
