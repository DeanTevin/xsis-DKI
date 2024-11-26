<?php

namespace App\Containers\Onboarding\Client\UI\WEB\Requests;

use App\Containers\AppSection\Master\Models\MasterOccupations;
use App\Containers\AppSection\Master\Models\MasterVillages;
use App\Containers\Onboarding\Client\Enums\Gender;
use App\Containers\Onboarding\Client\Policies\Rules\ValidKTPName;
use App\Ship\Parents\Requests\Request as ParentRequest;
use Illuminate\Validation\Rule;

class CreateClientPageRequest extends ParentRequest
{
    protected array $access = [
        'permissions' => '',
        'roles' => 'customer-service',
    ];

    protected array $decode = [
        // 'id',
    ];

    protected array $urlParameters = [
        // 'id',
    ];

    public function rules(): array
    {
        return [
            //
        ];
    }

    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
