<?php

namespace App\Containers\AppSection\Master\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class MasterDistricts extends ParentModel
{
    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Master Districts';

    protected $table = 'master_districts';

    protected $fillable = [
        'id',
        'regency_id',
        'district',
    ];

    public function regency(){
        return $this->belongsTo(MasterRegencies::class, 'regency_id', 'id');
    }
    
    public function village() {
        return $this->hasMany(MasterVillages::class,'district_id','id');
    }

    
}
