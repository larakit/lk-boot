<?php
namespace Larakit;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Routing\Router;

trait TraitKernel{
    public function __construct(Application $app, Router $router) {
        $this->app              = $app;
        $this->router           = $router;
        $this->middleware       = Boot::middlewares();
        $this->routeMiddleware  = Boot::middlewares_route();
        $this->middlewareGroups = Boot::middlewares_group();
        parent::__construct($app, $router);
    }
}
