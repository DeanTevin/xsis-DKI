<?php

namespace App\Containers\AppSection\Master\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Master\Models\MasterRegencies;
use App\Containers\AppSection\Master\Tasks\ListMastersTask;
use App\Containers\AppSection\Master\UI\API\Requests\ListMastersRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Http\Request;
use Prettus\Repository\Exceptions\RepositoryException;

class ListMasterRegencyAction extends ParentAction
{
    public function __construct(
        // private readonly ListMastersTask $listMastersTask,
        private readonly MasterRegencies $masterRegencies,
    ) {
    }

    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(Request $request): mixed
    {
        return $this->masterRegencies->paginate(10);
    }
}
