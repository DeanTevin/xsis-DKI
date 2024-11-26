<?php

namespace App\Containers\Onboarding\Client\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\Onboarding\Client\Data\Repositories\ClientRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class ListClientsTask extends ParentTask
{
    public function __construct(
        protected readonly ClientRepository $repository,
    ) {
    }

    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(): mixed
    {
        return $this->repository->addRequestCriteria()->paginate();
    }
}
