<?php
namespace Larakit;

trait TraitKernel {
    public function __traitConstruct() {
        $this->middleware       = Boot::middlewares();
        $this->routeMiddleware  = Boot::middlewares_route();
        $this->middlewareGroups = Boot::middlewares_group();
    }
}
