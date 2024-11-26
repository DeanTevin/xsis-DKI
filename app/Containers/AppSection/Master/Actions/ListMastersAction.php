<?php

namespace App\Containers\AppSection\Master\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Master\Tasks\ListMastersTask;
use App\Containers\AppSection\Master\UI\API\Requests\ListMastersRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class ListMastersAction extends ParentAction
{
    public function __construct(
        private readonly ListMastersTask $listMastersTask,
    ) {
    }

    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(ListMastersRequest $request): mixed
    {
        return $this->listMastersTask->run();
    }
}
