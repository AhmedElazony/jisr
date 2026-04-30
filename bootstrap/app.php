<?php

use App\Support\Commands\MakeApiController;
use App\Support\Commands\MakeApiRequest;
use App\Support\Commands\MakeApiResource;
use App\Support\Commands\MakeDomainModel;
use App\Support\Commands\MakeDomainPolicy;
use App\Support\Commands\MakeDomainService;
use App\Support\Enums\ResponseMessageEnum;
use App\Support\Http\Middlewares\HandleLocalization;
use App\Support\Http\Responses\ApiResponse;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withCommands([
        MakeApiRequest::class,
        MakeApiController::class,
        MakeApiResource::class,
        MakeDomainModel::class,
        MakeDomainPolicy::class,
        MakeDomainService::class,
    ])
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(HandleLocalization::class);
        $middleware->append(HandleCors::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return ApiResponse::error(
                    __(ResponseMessageEnum::NOT_FOUND->value),
                    Response::HTTP_NOT_FOUND
                );
            }
        });
        $exceptions->render(function (MethodNotAllowedException $e, Request $request) {
            if ($request->is('api/*')) {
                return ApiResponse::error(
                    __(ResponseMessageEnum::METHOD_NOT_ALLOWED->value),
                    Response::HTTP_METHOD_NOT_ALLOWED
                );
            }
        });
        $exceptions->render(function (UnauthorizedException $e, Request $request) {
            if ($request->is('api/*')) {
                return ApiResponse::error(
                    __(ResponseMessageEnum::UNAUTHORIZED->value),
                    Response::HTTP_FORBIDDEN
                );
            }
        });
    })->create();
