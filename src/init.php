<?php
use \Larakit\Boot;

/*################################################################################
  middlewares
################################################################################*/
Boot::register_middleware(\Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class);

/*################################################################################
  route middlewares
################################################################################*/
Boot::register_middleware_route('auth', \App\Http\Middleware\Authenticate::class);
Boot::register_middleware_route('auth.basic', \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class);
Boot::register_middleware_route('guest', \App\Http\Middleware\RedirectIfAuthenticated::class);
Boot::register_middleware_route('throttle', \Illuminate\Routing\Middleware\ThrottleRequests::class);

/*################################################################################
  group middlewares
################################################################################*/
Boot::register_middleware_group('api', 'throttle:60,1');
Boot::register_middleware_group('web', [
    \App\Http\Middleware\EncryptCookies::class,
    \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
    \Illuminate\Session\Middleware\StartSession::class,
    \Illuminate\View\Middleware\ShareErrorsFromSession::class,
    \App\Http\Middleware\VerifyCsrfToken::class,
]);
