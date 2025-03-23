<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (Exception $e) {
            $response = match (get_class($e)) {
                NotFoundHttpException::class => response()->json(['error' => 'Не найдено',], 404),

                MethodNotAllowedHttpException::class => response()->json(['error' => 'Метод недоступен. Доступны методы: ' . $e->getHeaders()['Allow'],], 405),

                AccessDeniedHttpException::class => response()->json(['error' => 'Действие запрещено.'.$e->getMessage()], 403),

                ValidationException::class => response()->json(['error' => $e->getMessage(),], 400),

                QueryException::class => response()->json(['error' => "Ошибка выполнения запроса. " . $e->getMessage(),], 400),

                AuthenticationException::class => response()->json(['message' => 'Unauthenticated.',], 401),

                default => response()->json([
                    'error' => $e->getMessage(),
                ], 500)
            };

            return $response;
        });
    })->create();
