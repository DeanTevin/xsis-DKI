<?php

namespace App\Containers\AppSection\User\UI\WEB\Controllers;

use App\Containers\AppSection\User\Actions\ListBlockedUsersAction;
use App\Containers\AppSection\User\UI\API\Requests\ListUsersRequest;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class BlockedUserPageController extends WebController
{
    public function __invoke(ListUsersRequest $request, ListBlockedUsersAction $action): View
    {
        $data = $action->run();
        return view('appSection@user::user-blocked',['data'=>$data]);
    }
}
