<?php

namespace App\Containers\AppSection\User\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Pagination\LengthAwarePaginator;
use Prettus\Repository\Exceptions\RepositoryException;

class ListBlockedUsersAction extends ParentAction
{
    public function __construct(
        private readonly UserRepository $repository,
    ) {
    }

    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(): LengthAwarePaginator
    {
        return User::onlyTrashed()->paginate();
    }
}
