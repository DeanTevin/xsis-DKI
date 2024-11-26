<?php

namespace App\Containers\Onboarding\Client\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\Onboarding\Client\Actions\CreateClientAction;
use App\Containers\Onboarding\Client\Actions\DeleteClientAction;
use App\Containers\Onboarding\Client\Actions\FindClientByIdAction;
use App\Containers\Onboarding\Client\Actions\ListClientsAction;
use App\Containers\Onboarding\Client\Actions\UpdateClientAction;
use App\Containers\Onboarding\Client\UI\API\Requests\CreateClientRequest;
use App\Containers\Onboarding\Client\UI\API\Requests\DeleteClientRequest;
use App\Containers\Onboarding\Client\UI\API\Requests\FindClientByIdRequest;
use App\Containers\Onboarding\Client\UI\API\Requests\ListClientsRequest;
use App\Containers\Onboarding\Client\UI\API\Requests\UpdateClientRequest;
use App\Containers\Onboarding\Client\UI\API\Transformers\ClientTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Prettus\Repository\Exceptions\RepositoryException;

class Controller extends ApiController
{
    public function __construct(
        private readonly CreateClientAction $createClientAction,
        private readonly UpdateClientAction $updateClientAction,
        private readonly FindClientByIdAction $findClientByIdAction,
        private readonly ListClientsAction $listClientsAction,
        private readonly DeleteClientAction $deleteClientAction,
    ) {
    }

    /**
     * @throws InvalidTransformerException
     * @throws CreateResourceFailedException
     * @throws IncorrectIdException
     */
    public function createClient(CreateClientRequest $request): JsonResponse
    {
        $client = $this->createClientAction->run($request);

        return $this->created($this->transform($client, ClientTransformer::class));
    }

    /**
     * @throws InvalidTransformerException
     * @throws NotFoundException
     */
    public function findClientById(FindClientByIdRequest $request): array
    {
        $client = $this->findClientByIdAction->run($request);

        return $this->transform($client, ClientTransformer::class);
    }

    /**
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function listClients(ListClientsRequest $request): array
    {
        $clients = $this->listClientsAction->run($request);

        return $this->transform($clients, ClientTransformer::class);
    }

    /**
     * @throws IncorrectIdException
     * @throws InvalidTransformerException
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function updateClient(UpdateClientRequest $request): array
    {
        $client = $this->updateClientAction->run($request);

        return $this->transform($client, ClientTransformer::class);
    }

    /**
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function deleteClient(DeleteClientRequest $request): JsonResponse
    {
        $this->deleteClientAction->run($request);

        return $this->noContent();
    }
}
