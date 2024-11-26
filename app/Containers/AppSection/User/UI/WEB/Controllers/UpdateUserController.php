<?php

namespace App\Containers\AppSection\User\UI\WEB\Controllers;

use App\Containers\AppSection\User\Actions\UpdateUserAction;
use App\Containers\AppSection\User\UI\WEB\Requests\UpdateUserRequest;
use App\Ship\Parents\Controllers\WebController;

class UpdateUserController extends WebController
{
    public function __invoke(UpdateUserRequest $request, UpdateUserAction $action)
    {
        $user = $action->run($request);
        
        if(!empty($user)){
            $response = "BERHASIL Mengubah user!";
        }
        
        return redirect()->to(route('user-page'))->withSuccess($response,200);
    }
}
