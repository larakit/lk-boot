<?php
namespace Larakit;

class Boot {

    static public $aliases           = [];
    static public $middlewares       = [];
    static public $middlewares_route = [];
    static public $middlewares_group = [];
    static public $service_providers = [];
    static public $policies_model    = [];
    static public $commands          = [];
    static public $view_paths        = [];

    /**
     * Поставить в очередь регистрацию алиаса
     *
     * @param $alias
     * @param $facade
     */
    static function register_alias($alias, $facade) {
        self::$aliases[$alias] = $facade;
    }

    static function init_package($package){
        $inits = rglob('*.php', 0, base_path('vendor/' . $package . '/src/init'));
        foreach($inits as $init) {
            include_once $init;
        }
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

    static function register_view_path($view_path, $namespace) {
        self::$view_paths[$namespace.$view_path] = compact('namespace', 'view_path');
    }

    static function register_middleware_group($group, $middleware) {
        $middlewares = (array) $middleware;
        foreach($middlewares as $m) {
            self::$middlewares_group[$group][$m] = $m;
        }
    }

    static function register_middleware_route($name, $class) {
        self::$middlewares_route[$name] = $class;
    }

    static function register_policy_model($model_class, $policy_class) {
        self::$policies_model[$model_class] = $policy_class;
    }

    static function register_command($class) {
        self::$commands[$class] = $class;
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

    static function policies_model() {
        return self::$policies_model;
    }

    static function commands() {
        return array_values(self::$commands);
    }

    static function view_paths() {
        return self::$view_paths;
    }
}
