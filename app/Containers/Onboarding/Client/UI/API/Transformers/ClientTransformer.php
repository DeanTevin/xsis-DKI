<?php

namespace App\Containers\Onboarding\Client\UI\API\Transformers;

use App\Containers\Onboarding\Client\Models\Client;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class ClientTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(Client $client): array
    {
        $response = [
            'object' => $client->getResourceKey(),
            'id' => $client->getHashedKey(),
        ];

        return $this->ifAdmin([
            'real_id' => $client->id,
            'created_at' => $client->created_at,
            'updated_at' => $client->updated_at,
            'readable_created_at' => $client->created_at->diffForHumans(),
            'readable_updated_at' => $client->updated_at->diffForHumans(),
            // 'deleted_at' => $client->deleted_at,
        ], $response);
    }
}
