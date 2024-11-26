<?php

namespace App\Containers\Onboarding\Client\UI\WEB\Requests;

use App\Containers\AppSection\Master\Models\MasterOccupations;
use App\Containers\AppSection\Master\Models\MasterVillages;
use App\Containers\Onboarding\Client\Enums\Gender;
use App\Containers\Onboarding\Client\Policies\Rules\ValidKTPName;
use App\Ship\Parents\Requests\Request as ParentRequest;
use Illuminate\Validation\Rule;

class CreateClientRequest extends ParentRequest
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
            // 'id' => 'required',
            'name' => ['required', 'string', new ValidKTPName()],
            'gender' => ['required',Rule::enum(Gender::class)],
            'birthPlace' => 'required|string',
            'birthDate' => 'required|date|date_format:Y-m-d',
            'occupation_id' => ['required','integer',Rule::exists(MasterOccupations::class,'id')],
            'annualDeposit' => 'required|numeric|gte:10000',
            'village' => ['required','integer',Rule::exists(MasterVillages::class,'id')],
            'address' => 'required|string|max:255',
        ];
    }

    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
