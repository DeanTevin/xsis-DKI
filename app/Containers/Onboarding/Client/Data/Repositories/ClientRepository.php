<?php

namespace App\Containers\Onboarding\Client\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class ClientRepository extends ParentRepository
{
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
