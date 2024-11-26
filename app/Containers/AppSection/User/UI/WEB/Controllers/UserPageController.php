<?php

namespace App\Containers\AppSection\User\UI\WEB\Controllers;

use App\Containers\AppSection\User\Actions\ListUsersAction;
use App\Containers\AppSection\User\Actions\ListUsersActionNoPaginate;
use App\Containers\AppSection\User\UI\API\Requests\ListUsersRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class UserPageController extends WebController
{
    public function __invoke(ListUsersRequest $request, ListUsersAction $action): View
    {
        $data = $action->run();
        return view('appSection@user::user',['data'=>$data]);
    }
}
