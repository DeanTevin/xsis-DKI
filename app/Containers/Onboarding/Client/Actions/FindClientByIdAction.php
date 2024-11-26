<?php

namespace App\Containers\Onboarding\Client\Actions;

use App\Containers\Onboarding\Client\Models\Client;
use App\Containers\Onboarding\Client\Tasks\FindClientByIdTask;
use App\Containers\Onboarding\Client\UI\API\Requests\FindClientByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindClientByIdAction extends ParentAction
{
    public function __construct(
        private readonly FindClientByIdTask $findClientByIdTask,
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run(FindClientByIdRequest $request): Client
    {
        return $this->findClientByIdTask->run($request->id);
    }
}
