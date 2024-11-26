<?php

namespace App\Containers\AppSection\Master\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class MasterProvinces extends ParentModel
{
    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Master Provinces';

    protected $table = 'master_provinces';

    protected $fillable = [
        'id',
        'province',
    ];
    
    public function Regencies() {
        return $this->hasMany(MasterRegencies::class,'province_id','id');
    }
}
