<?php

namespace App\Containers\Onboarding\Client\Tasks;

use App\Containers\Onboarding\Client\Data\Repositories\ClientRepository;
use App\Containers\Onboarding\Client\Models\Client;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateClientTask extends ParentTask
{
    public function __construct(
        protected readonly ClientRepository $repository,
    ) {
    }

    /**
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function run(array $data, $id): Client
    {
        try {
            return $this->repository->update($data, $id);
        } catch (ModelNotFoundException) {
            throw new NotFoundException();
        } catch (\Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
