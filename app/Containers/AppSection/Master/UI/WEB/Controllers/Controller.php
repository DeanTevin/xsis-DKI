<?php

namespace App\Containers\AppSection\Master\UI\WEB\Controllers;

use App\Containers\AppSection\Master\Actions\CreateMasterAction;
use App\Containers\AppSection\Master\Actions\DeleteMasterAction;
use App\Containers\AppSection\Master\Actions\FindMasterByIdAction;
use App\Containers\AppSection\Master\Actions\ListMastersAction;
use App\Containers\AppSection\Master\Actions\UpdateMasterAction;
use App\Containers\AppSection\Master\UI\WEB\Requests\CreateMasterRequest;
use App\Containers\AppSection\Master\UI\WEB\Requests\DeleteMasterRequest;
use App\Containers\AppSection\Master\UI\WEB\Requests\EditMasterRequest;
use App\Containers\AppSection\Master\UI\WEB\Requests\FindMasterByIdRequest;
use App\Containers\AppSection\Master\UI\WEB\Requests\ListMastersRequest;
use App\Containers\AppSection\Master\UI\WEB\Requests\StoreMasterRequest;
use App\Containers\AppSection\Master\UI\WEB\Requests\UpdateMasterRequest;
use App\Ship\Parents\Controllers\WebController;

class Controller extends WebController
{
    public function index(ListMastersRequest $request)
    {
        $masters = app(ListMastersAction::class)->run($request);
        // ...
    }

    public function show(FindMasterByIdRequest $request)
    {
        $master = app(FindMasterByIdAction::class)->run($request);
        // ...
    }

    public function create(CreateMasterRequest $request)
    {
    }

    public function store(StoreMasterRequest $request)
    {
        $master = app(CreateMasterAction::class)->run($request);
        // ...
    }

    public function edit(EditMasterRequest $request)
    {
        $master = app(FindMasterByIdAction::class)->run($request);
        // ...
    }

    public function update(UpdateMasterRequest $request)
    {
        $master = app(UpdateMasterAction::class)->run($request);
        // ...
    }

    public function destroy(DeleteMasterRequest $request)
    {
        $result = app(DeleteMasterAction::class)->run($request);
        // ...
    }
}
