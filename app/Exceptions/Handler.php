<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // public function render($request, Throwable $exception)
    // {
    //     //dd($exception);
    //     //retrive ex message -> $exception->getMessage()
    //     // if (get_class($exception) === "Illuminate\Database\Eloquent\ModelNotFoundException") {
    //     //     return $this->respondNotFound("Resource not found!", ErrorCodes::NOT_FOUND);
    //     // }

    //     // if (get_class($exception) === "Illuminate\Database\QueryException") {
    //     //     return $this->respondInternalError($exception, ErrorCodes::SERVER_ERROR);
    //     // }

    //     // if (get_class($exception) === "Exception") {
    //     //     return $this->respondInternalError("Something went wrong!", ErrorCodes::SERVER_ERROR);
    //     // }

    //     // if (get_class($exception) === "Error") {
    //     //     return $this->respondInternalError("Something went wrong!", ErrorCodes::SERVER_ERROR);
    //     // }

    //     if (get_class($exception) === "Illuminate\Validation\ValidationException") {
    //         dd($exception);
    //     }

    //     // if (get_class($exception) === "Illuminate\Auth\AuthenticationException") {
    //     //     return $this->respondUnAuthorized('Unauthorized', ErrorCodes::INVALID_TOKEN);
    //     // }

    //     return parent::render($request, $exception);
    // }
}
