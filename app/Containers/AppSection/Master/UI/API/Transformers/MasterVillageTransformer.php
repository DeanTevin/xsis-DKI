<?php

namespace App\Containers\AppSection\Master\UI\API\Transformers;

use App\Containers\AppSection\Master\Models\Master;
use App\Containers\AppSection\Master\Models\MasterProvinces;
use App\Containers\AppSection\Master\Models\MasterVillages;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class MasterVillageTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(MasterVillages $master): array
    {
        $response = [
            'object' => $master->getResourceKey(),
            'id' => $master->getHashedKey(),
        ];

        return $this->ifAdmin([
            'real_id' => $master->id,
            'created_at' => $master->created_at,
            'updated_at' => $master->updated_at,
            'readable_created_at' => $master->created_at->diffForHumans(),
            'readable_updated_at' => $master->updated_at->diffForHumans(),
            // 'deleted_at' => $master->deleted_at,
        ], $response);
    }
}
