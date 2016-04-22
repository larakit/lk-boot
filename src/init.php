<?php
use \Larakit\SPA;

if (!function_exists('larakit_alias')) {
    /**
     * @param $alias
     * @param $facade
     * @deprecated
     */
    function larakit_alias($alias, $facade) {
        SPA::register_alias($alias, $facade);
    }
}
if (!function_exists('larakit_provider')) {
    /**
     * @param $provider
     * @deprecated 
     */
    function larakit_provider($provider) {
        SPA::register_provider($provider);
    }
}

/*################################################################################
  middlewares
################################################################################*/
SPA::register_middleware(\Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class);

/*################################################################################
  route middlewares
################################################################################*/
SPA::register_middleware_route('auth', \App\Http\Middleware\Authenticate::class);
SPA::register_middleware_route('auth.basic', \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class);
SPA::register_middleware_route('guest', \App\Http\Middleware\RedirectIfAuthenticated::class);
SPA::register_middleware_route('throttle', \Illuminate\Routing\Middleware\ThrottleRequests::class);

/*################################################################################
  group middlewares
################################################################################*/
SPA::register_middleware_group('api', 'throttle:60,1');
SPA::register_middleware_group('web', [
    \App\Http\Middleware\EncryptCookies::class,
    \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
    \Illuminate\Session\Middleware\StartSession::class,
    \Illuminate\View\Middleware\ShareErrorsFromSession::class,
    \App\Http\Middleware\VerifyCsrfToken::class,
]);