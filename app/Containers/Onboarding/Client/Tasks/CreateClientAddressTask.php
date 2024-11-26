<?php

namespace App\Containers\Onboarding\Client\Tasks;

use App\Containers\Onboarding\Client\Data\Repositories\ClientAddressRepository;
use App\Containers\Onboarding\Client\Models\Client;
use App\Containers\Onboarding\Client\Models\ClientAddress;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;

class CreateClientAddressTask extends ParentTask
{
    public function __construct(
        protected readonly ClientAddressRepository $repository,
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(array $data): ClientAddress
    {
        try {
            return $this->repository->create($data);
        } catch (\Exception $e) {
            throw new CreateResourceFailedException(previous: $e);
        }
    }
}
