<?php

namespace App\Traits;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

trait HandleExceptionResponse
{
    private function handleException(\Exception $exception): JsonResponse
    {
        $code = $exception instanceof HttpException ? $exception->getStatusCode() : 500;
        $message = $exception->getMessage();

        if ($exception instanceof QueryException) {
            $message = $exception->getMessage() ?? 'A query excepetion has ocurred';
        }

        if ($exception instanceof ModelNotFoundException) {
            $message = $exception->getMessage() ?? 'A model was not found on the system';
            $code = 404;
        }

        if ($exception instanceof AuthorizationException) {
            $message = $exception->getMessage() ?? 'Error while trying to authorizate the user credentials';
            $code = 401;
        }

        return response()->json(['errors' => ['message' => $message]], $code);
    }
}
