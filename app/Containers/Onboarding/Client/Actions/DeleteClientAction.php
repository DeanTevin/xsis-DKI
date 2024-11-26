<?php

namespace App\Containers\Onboarding\Client\Actions;

use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Containers\Onboarding\Client\Data\Repositories\ClientAddressRepository;
use App\Containers\Onboarding\Client\Data\Repositories\ClientRepository;
use App\Containers\Onboarding\Client\Notifications\ClientDeletionNotification;
use App\Containers\Onboarding\Client\Tasks\DeleteClientTask;
use App\Containers\Onboarding\Client\UI\API\Requests\DeleteClientRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteClientAction extends ParentAction
{
    public function __construct(
        private ClientRepository $clientRepository,
        private UserRepository $userRepository,
        private readonly DeleteClientTask $deleteClientTask,
        private ClientAddressRepository $clientAddressRepository,
    ) {
    }

    /**
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run($id): int
    {
        $client = $this->clientRepository->find($id);

        $clientData = [
            'uuid' => $client->uuid,
            'name' => $client->name,
            'status' => $client->status
        ];

        //delete clientAddress
        $this->clientAddressRepository->where('client_id', $id)->delete();
        
        $result = $this->deleteClientTask->run($id);

        $users = $this->userRepository->whereHas('roles', function ($query) {
            $query->where('name', 'customer-service')->where('guard_name', 'web');
        })->get();

        foreach ($users as $user){
            $user->notify(new ClientDeletionNotification($clientData));
        }

        return $result;

    }
}
