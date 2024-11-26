<?php

namespace App\Containers\AppSection\User\UI\WEB\Controllers;

use App\Containers\AppSection\User\Actions\FindUserByIdAction;
use App\Containers\AppSection\User\UI\API\Requests\FindUserByIdRequest;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\View\View;

class UpdateUserPageController extends WebController
{
    public function __invoke(FindUserByIdRequest $request, FindUserByIdAction $action): View
    {
        $data = $action->run($request);
        return view('appSection@user::update',['data'=>$data]);
    }
}
