<?php

namespace App\Containers\AppSection\Master\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class MasterRepository extends ParentRepository
{
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
