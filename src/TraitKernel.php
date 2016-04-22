<?php
namespace Larakit;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Routing\Router;

trait TraitKernel{
    public function __construct(Application $app, Router $router) {
        $this->app              = $app;
        $this->router           = $router;
        $this->middleware       = SPA::middlewares();
        $this->routeMiddleware  = SPA::middlewares_route();
        $this->middlewareGroups = SPA::middlewares_group();
        parent::__construct($app, $router);
    }
}
