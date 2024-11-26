<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\CreateUserTask;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CreateUserAction extends ParentAction
{
    public function __construct(
        private readonly CreateUserTask $createUserTask,
        private readonly FindRoleTask $findRoleTask,
        private CreateAdminAction $CreateAdminAction
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     * @throws \Throwable
     * @throws NotFoundException
     */
    public function run(array $data): User
    {
        return DB::transaction(function () use ($data) {
            if($data['role'] == config('appSection-authorization.admin_role')){
                $user = $this->CreateAdminAction->run(Arr::except($data,['role']));
            }else{
                $user = $this->createUserTask->run(Arr::except($data,['role']));
                $user = $this->UserRoleCreate($user, $data['role'], 'web');
                $user->save();
            }
            return $user;
        });
    }

    //only 
    private function UserRoleCreate(User $user, string $role, $guardName) : User {
        $selectedRole = $this->findRoleTask->run($role, $guardName);
        $user->assignRole($selectedRole);
        return $user;
    }
}
