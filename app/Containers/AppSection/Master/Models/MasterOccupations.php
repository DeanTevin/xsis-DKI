<?php

namespace App\Containers\AppSection\Master\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class MasterOccupations extends ParentModel
{
    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Master Occupations';

    protected $table = 'master_occupations';

    protected $fillable = [
        'id',
        'occupation',
    ];
}
