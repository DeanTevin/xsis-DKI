<?php

namespace App\Containers\AppSection\Authorization\Data\Seeders;

use App\Containers\AppSection\User\Actions\CreateAdminAction;
use App\Containers\AppSection\User\Actions\CreateUserAction;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;
use Illuminate\Support\Arr;

class AuthorizationDefaultUsersSeeder_4 extends ParentSeeder
{
    /**
     * @throws CreateResourceFailedException
     * @throws \Throwable
     */
    public function run(CreateAdminAction $CreateAdminAction, CreateUserAction $createUserAction): void
    {
        // Default Users (with their roles) ---------------------------------------------
        $adminUserData = [
            config('appSection-authorization.admin_account'),
        ];

        $userData = [
            Arr::add(
                config('appSection-authorization.customer_service_role.default_account'),
                'role',config('appSection-authorization.customer_service_role.name')
            ),
            Arr::add(
                config('appSection-authorization.supervisor_role.default_account'),
                'role', config('appSection-authorization.supervisor_role.name')
            ),
        ];

        foreach($adminUserData as $adminAccount){
            $CreateAdminAction->run($adminAccount);
        };

        foreach($userData as $account) {
            $createUserAction->run($account);
        }
        
    }
}
