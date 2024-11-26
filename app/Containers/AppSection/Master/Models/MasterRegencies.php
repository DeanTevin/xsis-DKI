<?php

namespace App\Containers\AppSection\Master\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class MasterRegencies extends ParentModel
{
    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Master Regencies';

    protected $table = 'master_regencies';
    
    protected $fillable = [
        'id',
        'province_id',
        'regency',
    ];

    public function province(){
        return $this->belongsTo(MasterProvinces::class, 'province_id', 'id');
    }

    public function district() {
        return $this->hasMany(MasterDistricts::class,'regency_id','id');
    }
}
