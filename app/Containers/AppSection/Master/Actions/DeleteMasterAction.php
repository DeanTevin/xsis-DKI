<?php

namespace App\Containers\AppSection\Master\Actions;

use App\Containers\AppSection\Master\Tasks\DeleteMasterTask;
use App\Containers\AppSection\Master\UI\API\Requests\DeleteMasterRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteMasterAction extends ParentAction
{
    public function __construct(
        private readonly DeleteMasterTask $deleteMasterTask,
    ) {
    }

    /**
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run(DeleteMasterRequest $request): int
    {
        return $this->deleteMasterTask->run($request->id);
    }
}
