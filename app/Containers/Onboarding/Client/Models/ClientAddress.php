<?php

namespace App\Containers\Onboarding\Client\Models;

use App\Containers\AppSection\Master\Models\MasterVillages;
use App\Ship\Parents\Models\Model as ParentModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ClientAddress extends ParentModel
{
    use HasUuids;

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Client Address';

    protected $table = 'client_address';

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'client_id',
        'village_id',
        'address',
    ];

    public function client(){
        return $this->belongsTo(Client::class, 'client_id', 'uuid');
    }

    public function village(){
        return $this->belongsTo(MasterVillages::class, 'village_id', 'id');
    }
     
}
