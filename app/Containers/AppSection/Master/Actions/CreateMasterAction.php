<?php

namespace App\Containers\AppSection\Master\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Master\Models\Master;
use App\Containers\AppSection\Master\Tasks\CreateMasterTask;
use App\Containers\AppSection\Master\UI\API\Requests\CreateMasterRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class CreateMasterAction extends ParentAction
{
    public function __construct(
        private readonly CreateMasterTask $createMasterTask,
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(CreateMasterRequest $request): Master
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        return $this->createMasterTask->run($data);
    }
}
