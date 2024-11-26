<?php

namespace App\Containers\AppSection\Master\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class MasterVillages extends ParentModel
{
    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Master Villages';

    protected $table = 'master_villages';

    protected $fillable = [
        'id',
        'district_id',
        'village',
    ];

    public function district(){
        return $this->belongsTo(MasterDistricts::class, 'district_id', 'id');
    }
}
