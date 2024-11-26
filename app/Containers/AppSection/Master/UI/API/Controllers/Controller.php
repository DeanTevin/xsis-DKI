<?php

namespace App\Containers\AppSection\Master\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Master\Actions\CreateMasterAction;
use App\Containers\AppSection\Master\Actions\DeleteMasterAction;
use App\Containers\AppSection\Master\Actions\FindMasterByIdAction;
use App\Containers\AppSection\Master\Actions\ListMasterDistrictAction;
use App\Containers\AppSection\Master\Actions\ListMasterProvinceAction;
use App\Containers\AppSection\Master\Actions\ListMasterRegencyAction;
use App\Containers\AppSection\Master\Actions\ListMastersAction;
use App\Containers\AppSection\Master\Actions\ListMasterVillageAction;
use App\Containers\AppSection\Master\Actions\UpdateMasterAction;
use App\Containers\AppSection\Master\UI\API\Requests\CreateMasterRequest;
use App\Containers\AppSection\Master\UI\API\Requests\DeleteMasterRequest;
use App\Containers\AppSection\Master\UI\API\Requests\FindMasterByIdRequest;
use App\Containers\AppSection\Master\UI\API\Requests\ListMastersRequest;
use App\Containers\AppSection\Master\UI\API\Requests\UpdateMasterRequest;
use App\Containers\AppSection\Master\UI\API\Transformers\MasterDistrictTransformer;
use App\Containers\AppSection\Master\UI\API\Transformers\MasterProvinceTransformer;
use App\Containers\AppSection\Master\UI\API\Transformers\MasterRegencyTransformer;
use App\Containers\AppSection\Master\UI\API\Transformers\MasterTransformer;
use App\Containers\AppSection\Master\UI\API\Transformers\MasterVillageTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Prettus\Repository\Exceptions\RepositoryException;

class Controller extends ApiController
{
    public function __construct(
        private readonly ListMasterProvinceAction $listMasterProvinceAction,
        private readonly ListMasterRegencyAction $listMasterRegencyAction,
        private readonly ListMasterDistrictAction $listMasterDistrictAction,
        private readonly ListMasterVillageAction $listMasterVillageAction,
    ) {
    }

    /**
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function listProvince(Request $request): JsonResponse
    {
        $masters = $this->listMasterProvinceAction->run($request);

        return response()->json($masters,200);
    }

    /**
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function listRegency(Request $request): JsonResponse
    {
        $masters = $this->listMasterRegencyAction->run($request);

        return response()->json($masters,200);
    }

    /**
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function listDistrict(Request $request): JsonResponse
    {
        $masters = $this->listMasterRegencyAction->run($request);

        return response()->json($masters,200);
    }

    /**
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function listVillage(Request $request): JsonResponse
    {
        $masters = $this->listMasterVillageAction->run($request);

        return response()->json($masters,200);
    }
}
