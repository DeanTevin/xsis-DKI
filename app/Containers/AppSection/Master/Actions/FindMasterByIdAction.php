<?php

namespace App\Containers\AppSection\Master\Actions;

use App\Containers\AppSection\Master\Models\Master;
use App\Containers\AppSection\Master\Tasks\FindMasterByIdTask;
use App\Containers\AppSection\Master\UI\API\Requests\FindMasterByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindMasterByIdAction extends ParentAction
{
    public function __construct(
        private readonly FindMasterByIdTask $findMasterByIdTask,
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run(FindMasterByIdRequest $request): Master
    {
        return $this->findMasterByIdTask->run($request->id);
    }
}
