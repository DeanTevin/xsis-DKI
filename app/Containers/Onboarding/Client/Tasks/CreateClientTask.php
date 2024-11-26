<?php

namespace App\Containers\Onboarding\Client\Tasks;

use App\Containers\Onboarding\Client\Data\Repositories\ClientRepository;
use App\Containers\Onboarding\Client\Models\Client;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;

class CreateClientTask extends ParentTask
{
    public function __construct(
        protected readonly ClientRepository $repository,
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(array $data): Client
    {
        try {
            return $this->repository->create($data);
        } catch (\Exception $e) {
            throw new CreateResourceFailedException(previous: $e);
        }
    }
}
