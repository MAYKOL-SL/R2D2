<?php

namespace Reserva\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Reserva\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Reserva\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Reserva\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \Reserva\Http\Middleware\RedirectIfAuthenticated::class,

        'admin' => \Reserva\Http\Middleware\Administrador::class,
        'docente' => \Reserva\Http\Middleware\Docente::class,
        'secret' => \Reserva\Http\Middleware\Secretaria::class,
        'auxi' => \Reserva\Http\Middleware\Auxiliar::class,
    ];
}
