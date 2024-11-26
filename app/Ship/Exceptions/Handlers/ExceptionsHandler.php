<?php

namespace App\Ship\Exceptions\Handlers;

use Apiato\Core\Abstracts\Exceptions\Exception as CoreException;
use Apiato\Core\Exceptions\AuthenticationException as CoreAuthenticationException;
use Apiato\Core\Exceptions\Handlers\ExceptionsHandler as CoreExceptionsHandler;
use App\Ship\Exceptions\AccessDeniedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Traits\ErrorResponseHelper;
use Exception;
use Illuminate\Auth\AuthenticationException as LaravelAuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Laravel\Passport\Exceptions\AuthenticationException;
use Laravel\Passport\Exceptions\OAuthServerException;
use League\OAuth2\Server\Exception\OAuthServerException as ExceptionOAuthServerException;
use PDOException;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

/**
 * Class ExceptionsHandler.
 * A.K.A. app/Exceptions/Handler.php.
 */
class ExceptionsHandler extends CoreExceptionsHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    protected $dontReport = [
        OAuthServerException::class,
        NotFoundHttpException::class,
        AccessDeniedHttpException::class,
        LaravelAuthenticationException::class,
        AuthenticationException::class,
        ExceptionOAuthServerException::class,
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(static function (\Throwable $e) {
        });

        $this->renderable(function (CoreException $e, $request) {
            if ($this->shouldReturnJson($request, $e)) {
                return $this->buildJsonResponse($e);
            }

            return $this->renderExceptionResponse($request, $e);
        });

        $this->renderable(function (PDOException $e, $request) {
            if ($this->shouldReturnJson($request, $e)) {
                return $this->buildJsonResponseGeneralException($e);
            }

            return $this->renderExceptionResponse($request, $e);
        });

        $this->renderable(function (NotFoundHttpException|ModelNotFoundException $e, $request) {
            if ($this->shouldReturnJson($request, $e)) {
                return $this->buildJsonResponse(new NotFoundException());
            }

            return $this->renderExceptionResponse($request, $e);
        });

        $this->renderable(function (UnauthorizedException $e, $request) {
            if ($this->shouldReturnJson($request, $e)) {
                return $this->buildJsonResponse(new AccessDeniedException());
            }

            return redirect()->guest(route('unauthorized-page'));
        });

        $this->renderable(function (AccessDeniedHttpException $e, $request) {
            if ($this->shouldReturnJson($request, $e)) {
                return $this->buildJsonResponse(new AccessDeniedException());
            }

            return redirect()->guest(route('unauthorized-page'));
        });

    }

    private function buildJsonResponse(CoreException $e): JsonResponse
    {
        if (!App::isProduction()) {
            $response = [
                'environment' => App::environment(),
                'message' => $e->getMessage(),
                'errors' => $e->getErrors(),
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTrace(),
            ];
        } else {
            $response = [
                'message' => $e->getMessage(),
                'errors' => $e->getErrors(),
            ];
        }

        return response()->json($response, (int) $e->getCode());
    }

    private function buildJsonResponseGeneralException(Exception $e): JsonResponse
    {
        if (!App::isProduction() && config('app.debug')==true) {
            $response = ErrorResponseHelper::ExceptionResponse($e);
        } else {
            $response = [
                'message' => "",
            ];
        }

        return response()->json($response, (int) 500);
    }

    protected function unauthenticated($request, LaravelAuthenticationException $e): JsonResponse|RedirectResponse
    {
        if ($this->shouldReturnJson($request, $e)) {
            return $this->buildJsonResponse(new CoreAuthenticationException());
        }

        return redirect()->guest(route('login-page'));
    }

    public function render($request, Throwable $e)
    {   
        if ($e instanceof OAuthServerException) {
             $transPayload = trans('oauth.error_code.' . $e->getCode(), [
                 'client_id' => $request->client_id,
                 'grant_type' => $request->grant_type,
                 'hint' => \Illuminate\Support\Str::between($e->getPrevious()->getHint(), '`', '`'),
             ]);
 
             return response()->json([
                 'error_type' => $e->getPrevious()->getErrorType(),
                 'code' => $e->getCode(),
                 'message' => $transPayload,
             ],$e->statusCode());
         }
 
         return parent::render($request, $e);
    }
    
}
