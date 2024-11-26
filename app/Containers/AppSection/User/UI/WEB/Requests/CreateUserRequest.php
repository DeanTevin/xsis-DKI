<?php

namespace App\Containers\AppSection\User\UI\WEB\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;
use Illuminate\Validation\Rules\Password;

class CreateUserRequest extends ParentRequest
{
    protected array $access = [
        'permissions' => null,
        'roles' => null,
    ];

    protected array $decode = [];

    protected array $urlParameters = [];

    public function rules(): array
    {
        $rules = [
            'username' => 'required|max:128',
            'email' => 'required|email',
            'password' => ['required',Password::min(8)->mixedCase()->numbers()->symbols()],
            'role' => 'required|string'
        ];

        return $rules;
    }

    public function authorize(): bool
    {
        return $this->hasAccess();
    }
}
