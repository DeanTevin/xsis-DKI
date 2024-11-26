<?php

namespace App\Containers\Onboarding\Client\Models;

use App\Containers\AppSection\Master\Models\MasterOccupations;
use App\Containers\Onboarding\Client\Enums\Gender;
use App\Ship\Parents\Models\Model as ParentModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Client extends ParentModel
{
    use HasUuids;

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Client';

    protected $table = 'clients';

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'name',
        'birthPlace',
        'birthDate',
        'gender',
        'occupation_id',
        'annualDeposit',
        'status'
    ];
    
    public function clientAddress() {
        return $this->hasOne(ClientAddress::class,'client_id','uuid');
    }

    public function occupation() {
        return $this->belongsTo(MasterOccupations::class,'occupation_id','id');
    }

    protected function gender(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst(strtolower(Gender::from($value)->name)),
        );
    }
}
