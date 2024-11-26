<?php

namespace App\Containers\AppSection\Master\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Master\Models\Master;
use App\Containers\AppSection\Master\Tasks\UpdateMasterTask;
use App\Containers\AppSection\Master\UI\API\Requests\UpdateMasterRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateMasterAction extends ParentAction
{
    public function __construct(
        private readonly UpdateMasterTask $updateMasterTask,
    ) {
    }

    /**
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function run(UpdateMasterRequest $request): Master
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        return $this->updateMasterTask->run($data, $request->id);
    }
}
