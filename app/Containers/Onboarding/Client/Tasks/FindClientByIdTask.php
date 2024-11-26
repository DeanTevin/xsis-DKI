<?php

namespace App\Containers\Onboarding\Client\Tasks;

use App\Containers\Onboarding\Client\Data\Repositories\ClientRepository;
use App\Containers\Onboarding\Client\Models\Client;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;

class FindClientByIdTask extends ParentTask
{
    public function __construct(
        protected readonly ClientRepository $repository,
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run($id): Client
    {
        try {
            return $this->repository->find($id);
        } catch (\Exception) {
            throw new NotFoundException();
        }
    }
}
