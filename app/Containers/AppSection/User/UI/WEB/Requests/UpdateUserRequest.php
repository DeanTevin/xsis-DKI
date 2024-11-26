<?php

namespace App\Containers\AppSection\User\UI\WEB\Requests;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Requests\Request as ParentRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends ParentRequest
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
            'username' => ['required',Rule::unique(User::class,'username')->ignore($this->id,'id'), 'max:128'],
            'email' => 'required|email',
            'password' => ['required',Password::min(8)->mixedCase()->numbers()->symbols()],
            'password_confirmation' => 'required|min:5|max:8'
        ];

        return $rules;
    }

    public function authorize(): bool
    {
        return $this->hasAccess();
    }
}
