<?php

namespace App\Containers\AppSection\Master\Tasks;

use App\Containers\AppSection\Master\Data\Repositories\MasterRepository;
use App\Containers\AppSection\Master\Events\MasterFoundByIdEvent;
use App\Containers\AppSection\Master\Models\Master;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;

class FindMasterByIdTask extends ParentTask
{
    public function __construct(
        protected readonly MasterRepository $repository,
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run($id): Master
    {
        try {
            $master = $this->repository->find($id);
            MasterFoundByIdEvent::dispatch($master);

            return $master;
        } catch (\Exception) {
            throw new NotFoundException();
        }
    }
}
