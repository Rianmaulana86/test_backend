<?php

namespace App\Exceptions;

use App\Responses\ServerResponse;
use Error;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

use function App\Helpers\error;

class Handler extends ExceptionHandler
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

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
//        if ($request->expectsJson()){
        if ($e instanceof ModelNotFoundException) {
            $modelClass = explode('\\', $e->getModel());
            $message = array_merge(ServerResponse::INTERNAL_SERVER_ERROR, ['stack' => $e->getMessage(),'file'=>$e->getFile(), 'line' => $e->getLine()]);
            Log::error('Model Not Found : ' . json_encode(end($modelClass) . ' not found', JSON_PRETTY_PRINT));
            return error($message, 404);
        }
        if ($e instanceof NotFoundHttpException) {
            Log::error('Not Found : ' . json_encode($e->getMessage(), JSON_PRETTY_PRINT));
            return error(ServerResponse::NOT_FOUND_EX, 404);
        }
        if ($e instanceof AuthenticationException) {
            Log::error('Unauthenticated : ' . json_encode($e->getMessage(), JSON_PRETTY_PRINT));
            return error(ServerResponse::UNAUTHORIZED, 401);
        }
        if ($e instanceof AuthorizationException) {
            Log::error('Forbidden : ' . json_encode($e->getMessage(), JSON_PRETTY_PRINT));
            return error(ServerResponse::FORBIDDEN, 403);
        }
        if ($e instanceof ValidationException) {
            Log::error('Validation Error : ' . json_encode($e->errors(), JSON_PRETTY_PRINT));
            return error(ServerResponse::VALIDATION, 400, ['errors' => $e->errors()]);
        }
        if ($e instanceof QueryException) {
            $message = Str::between($e->getMessage(), '[7] ', ' (0x');
            Log::error('Query Error : ' . json_encode($message, JSON_PRETTY_PRINT));
            $newMessage = array_merge( ServerResponse::INTERNAL_SERVER_ERROR,['stack' =>$message,'file'=>$e->getFile() ,'line' =>$e->getLine()]);
            return error($newMessage, 500);
        }
        if ($e instanceof MethodNotAllowedHttpException) {
            $message = array_merge(ServerResponse::METHOD_NOT_ALLOWED, ['stack' => $e->getMessage(),'file'=>$e->getFile(), 'line' => $e->getLine()]);
            Log::error('Method not allowed : ' . json_encode($e->getMessage(), JSON_PRETTY_PRINT));
            return error($message, 405);
        }
        if ($e instanceof HttpException) {
            $message = array_merge(ServerResponse::INTERNAL_SERVER_ERROR, ['stack' => $e->getMessage(),'file'=>$e->getFile(), 'line' => $e->getLine()]);
            Log::error('Http error : ' . json_encode($e->getMessage(), JSON_PRETTY_PRINT));
            return error($message, 500);
        }
        if ($e instanceof Error) {
            $modelClass = explode('\\', $e->getMessage());
            $message = array_merge(ServerResponse::INTERNAL_SERVER_ERROR, ['stack' => $e->getMessage(),'file'=>$e->getFile(), 'line' => $e->getLine()]);
            Log::error('Error : ' . json_encode(end($modelClass), JSON_PRETTY_PRINT));
            return error(array_merge($message, $modelClass), 500);
        }
        
        if ($e instanceof TokenInvalidException) {
            
            return error(['error' => 'Invalid token'], 401);
        }

        if ($e instanceof JWTException) { 
            return error(['error' => 'Token is absent'], 401);
        }

        return parent::render($request, $e);
    }
}
