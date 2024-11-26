<?php

namespace App\Containers\AppSection\Authorization\Data\Seeders;

use App\Containers\AppSection\Authorization\Tasks\CreateRoleTask;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;

class AuthorizationRolesSeeder_2 extends ParentSeeder
{
    /**
     * @throws CreateResourceFailedException
     */
    public function run(CreateRoleTask $task): void
    {
        // Default Roles for every Guard ----------------------------------------------------------------
        foreach (array_keys(config('auth.guards')) as $guardName) {
            $task->run(config('appSection-authorization.admin_role'), 'Administrator', 'Administrator Role', $guardName);
            // Customer Service
            $task->run(config('appSection-authorization.customer_service_role.name'), 
            config('appSection-authorization.customer_service_role.description'), 
            config('appSection-authorization.customer_service_role.displayName'), $guardName);
            // Supervisor
            $task->run(config('appSection-authorization.supervisor_role.name'), 
            config('appSection-authorization.supervisor_role.description'), 
            config('appSection-authorization.supervisor_role.displayName'), $guardName);
        }
    }
}
