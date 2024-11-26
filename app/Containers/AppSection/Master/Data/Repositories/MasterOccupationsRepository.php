<?php

namespace App\Containers\AppSection\Master\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class MasterOccupationsRepository extends ParentRepository
{
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
