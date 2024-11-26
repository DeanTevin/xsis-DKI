<?php

namespace App\Containers\AppSection\Master\Tasks;

use App\Containers\AppSection\Master\Data\Repositories\MasterRepository;
use App\Containers\AppSection\Master\Events\MasterCreatedEvent;
use App\Containers\AppSection\Master\Models\Master;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;

class CreateMasterTask extends ParentTask
{
    public function __construct(
        protected readonly MasterRepository $repository,
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(array $data): Master
    {
        try {
            $master = $this->repository->create($data);
            MasterCreatedEvent::dispatch($master);

            return $master;
        } catch (\Exception) {
            throw new CreateResourceFailedException();
        }
    }
}
