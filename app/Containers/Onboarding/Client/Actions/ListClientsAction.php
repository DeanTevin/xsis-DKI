<?php

namespace App\Containers\Onboarding\Client\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\Onboarding\Client\Tasks\ListClientsTask;
use App\Containers\Onboarding\Client\UI\API\Requests\ListClientsRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class ListClientsAction extends ParentAction
{
    public function __construct(
        private readonly ListClientsTask $listClientsTask,
    ) {
    }

    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(ListClientsRequest $request): mixed
    {
        return $this->listClientsTask->run();
    }
}
