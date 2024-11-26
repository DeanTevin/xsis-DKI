<?php

namespace App\Containers\AppSection\Authentication\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Authentication\Classes\LoginFieldProcessor;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\AppSection\Authentication\Values\IncomingLoginField;
use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class WebLoginAction extends ParentAction
{

    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    /**
     * @throws IncorrectIdException
     */
    public function run(LoginRequest $request): RedirectResponse
    {

        $sanitizedData = $request->sanitizeInput([
            ...array_keys(config('appSection-authentication.login.fields', ['email' => []])),
            'password',
            'remember' => false,
        ]);

        $loginFields = LoginFieldProcessor::extractAll($sanitizedData);
        $credentials = [];

        foreach ($loginFields as $loginField) {
            if (config('appSection-authentication.login.case_sensitive')) {
                $credentials[$loginField->name] =
                    static fn (Builder $query): Builder => $query->orWhere($loginField->name, $loginField->value);
            } else {
                $credentials[$loginField->name] =
                    static fn (Builder $query): Builder => $query->orWhereRaw("lower({$loginField->name}) = lower(?)", [$loginField->value]);
            }
        }

        $credentials['password'] = $sanitizedData['password'];

        $throttleKey = 'login|' . Str::lower($sanitizedData['username']);

        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            $user = $this->userRepository
                ->where('username', $sanitizedData['username'])
                ->whereDoesntHave('roles', function ($query) {
                    $query->where('name', 'admin');
                })
            ->first();

            if(!empty($user)){
                $user->delete();

                return back()->withErrors(['maxAttempts' => "Username has been blocked. Please report to Admin"]);
            }

                return back()->withErrors(['maxAttempts' => "Too many login attempts. Please try again in $seconds seconds."]);
            }

        $loggedIn = Auth::guard('web')->attempt($credentials, $sanitizedData['remember']);

        if ($loggedIn) {
            RateLimiter::clear($throttleKey); // Clear attempts on successful login
            session()->regenerate();

            return redirect()->to(route('home-page'));
        }

        $errorResult = array_reduce(
            $loginFields,
            static fn (array $result, IncomingLoginField $loginField): array => [
                'errors' => array_merge($result['errors'], [$loginField->name => __('auth.failed')]),
                'fields' => array_merge($result['fields'], [$loginField->name]),
            ],
            ['errors' => [], 'fields' => []],
        );

        RateLimiter::hit($throttleKey); // Increment login attempts

        return back()->withErrors(
            $errorResult['errors'],
        )->onlyInput(...$errorResult['fields']);
    }
}
