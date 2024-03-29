<?php

namespace App\Exceptions;

use Cassandra\Exception\ValidationException;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
        $this->reportable(function (ValidationException $e) {
            return response()->json(
                ["success" => false, "message" => "Dados fornecidos são inválidos.", "errors" => $e->errors()],
                ResponseAlias::HTTP_UNPROCESSABLE_ENTITY
            );
        });

        $this->renderable(function (ModelNotFoundException $e, $request) {
            return response()->json(
                ["success" => false, "message" => "Recurso não encontrado."],
                ResponseAlias::HTTP_NOT_FOUND
            );
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            return response()->json(
                ["success" => false, "message" => "Recurso não encontrado ou rota inexistente."],
                ResponseAlias::HTTP_NOT_FOUND
            );
        });
    }
}
