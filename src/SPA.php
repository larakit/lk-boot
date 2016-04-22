<?php
namespace Larakit;

class SPA {

    static public $aliases           = [];
    static public $middlewares       = [];
    static public $middlewares_route = [];
    static public $middlewares_group = [];
    static public $service_providers = [];

    /**
     * Поставить в очередь регистрацию алиаса
     *
     * @param $alias
     * @param $facade
     */
    static function register_alias($alias, $facade) {
        self::$aliases[$alias] = $facade;
    }

    /**
     * Поставить в очередь регистрацию сервис-провайдера
     *
     * @param $provider
     */
    static function register_provider($provider) {
        self::$service_providers[$provider] = $provider;
    }

    static function register_middleware($middleware) {
        self::$middlewares[$middleware] = $middleware;
    }

    static function register_middleware_group($group, $middleware) {
        $middlewares = (array)$middleware;
        foreach($middlewares as $m) {
            self::$middlewares_group[$group][$m] = $m;
        }
    }

    static function register_middleware_route($name, $class) {
        self::$middlewares_route[$name] = $class;
    }

    /**
     * Вызвать в config/app.php
     * <?php
     *
     * return [
     * @return array
     */
    static function aliases() {
        return self::$aliases;
    }

    static function middlewares() {
        return self::$middlewares;
    }

    static function middlewares_route() {
        return self::$middlewares_route;
    }

    static function middlewares_group() {
        return self::$middlewares_group;
    }

    static function providers() {
        return array_values(self::$service_providers);
    }
}