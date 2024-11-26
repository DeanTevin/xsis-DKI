<?php

namespace App\Containers\AppSection\User\UI\WEB\Controllers;

use App\Containers\AppSection\Authorization\Data\Repositories\RoleRepository;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\View\View;

class CreateUserPageController extends WebController
{
    public function __invoke(RoleRepository $repository): View
    {
        $roles = $repository->whereGuardName("web")->get();
        return view('appSection@user::create', ['data'=>$roles]);
    }
}
