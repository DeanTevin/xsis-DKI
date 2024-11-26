<?php

namespace App\Containers\AppSection\Master\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Master\Data\Repositories\MasterRepository;
use App\Containers\AppSection\Master\Events\MastersListedEvent;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class ListMastersTask extends ParentTask
{
    public function __construct(
        protected readonly MasterRepository $repository,
    ) {
    }

    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(): mixed
    {
        $result = $this->repository->addRequestCriteria()->paginate();
        MastersListedEvent::dispatch($result);

        return $result;
    }
}
