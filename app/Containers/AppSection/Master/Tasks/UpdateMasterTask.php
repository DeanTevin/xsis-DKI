<?php

namespace App\Containers\AppSection\Master\Tasks;

use App\Containers\AppSection\Master\Data\Repositories\MasterRepository;
use App\Containers\AppSection\Master\Events\MasterUpdatedEvent;
use App\Containers\AppSection\Master\Models\Master;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateMasterTask extends ParentTask
{
    public function __construct(
        protected readonly MasterRepository $repository,
    ) {
    }

    /**
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function run(array $data, $id): Master
    {
        try {
            $master = $this->repository->update($data, $id);
            MasterUpdatedEvent::dispatch($master);

            return $master;
        } catch (ModelNotFoundException) {
            throw new NotFoundException();
        } catch (\Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
