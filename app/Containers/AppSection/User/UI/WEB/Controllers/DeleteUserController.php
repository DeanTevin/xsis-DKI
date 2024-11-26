<?php

namespace App\Containers\AppSection\User\UI\WEB\Controllers;

use App\Containers\AppSection\User\Actions\CreateAdminAction;
use App\Containers\AppSection\User\Actions\DeleteUserAction;
use App\Containers\AppSection\User\UI\API\Requests\DeleteUserRequest;
use App\Containers\AppSection\User\UI\WEB\Requests\CreateUserRequest;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\View\View;

class DeleteUserController extends WebController
{
    public function __invoke(DeleteUserRequest $request, DeleteUserAction $action)
    {
        $action->run($request);

        $response = "BERHASIL menghapus user!";
        
        return back()->withSuccess($response,200);
    }
}
