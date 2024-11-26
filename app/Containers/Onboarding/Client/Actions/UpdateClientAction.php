<?php

namespace App\Containers\Onboarding\Client\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\Onboarding\Client\Models\Client;
use App\Containers\Onboarding\Client\Tasks\UpdateClientTask;
use App\Containers\Onboarding\Client\UI\API\Requests\UpdateClientRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateClientAction extends ParentAction
{
    public function __construct(
        private readonly UpdateClientTask $updateClientTask,
    ) {
    }

    /**
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function run(UpdateClientRequest $request): Client
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        return $this->updateClientTask->run($data, $request->id);
    }
}
