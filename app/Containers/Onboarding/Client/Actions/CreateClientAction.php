<?php

namespace App\Containers\Onboarding\Client\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\Onboarding\Client\Models\Client;
use App\Containers\Onboarding\Client\Tasks\CreateClientAddressTask;
use App\Containers\Onboarding\Client\Tasks\CreateClientTask;
use App\Containers\Onboarding\Client\UI\API\Requests\CreateClientRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Arr;

class CreateClientAction extends ParentAction
{
    public function __construct(
        private readonly CreateClientTask $createClientTask,
        private readonly CreateClientAddressTask $createClientAddressTask,
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(array $data): Client
    {
        $dataClient = Arr::except($data, ['village','address']);

        $client = $this->createClientTask->run(Arr::add($dataClient,'status','Pending'));

        $dataClientAddress = [
            "client_id" => $client->uuid,
            "village_id" => $data['village'],
            "address" => $data['address']
        ];
        
        $this->createClientAddressTask->run($dataClientAddress);

        return $client;
    }
}
