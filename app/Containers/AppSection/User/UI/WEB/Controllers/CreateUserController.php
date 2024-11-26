<?php

namespace App\Containers\AppSection\User\UI\WEB\Controllers;

use App\Containers\AppSection\User\Actions\CreateUserAction;
use App\Containers\AppSection\User\UI\WEB\Requests\CreateUserRequest;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\View\View;

class CreateUserController extends WebController
{
    public function __invoke(CreateUserRequest $request, CreateUserAction $action)
    {
        $array = $request->sanitizeInput([
            'username',
            'email',
            'password',
            'role'
        ]);   

        $user = $action->run($array);
        if(!empty($user)){
            $response = "BERHASIL Menambah user!";
        }
        
        return back()->withSuccess($response,200);
    }
}
