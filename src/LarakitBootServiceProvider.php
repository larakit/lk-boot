<?php

namespace Larakit;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class LarakitBootServiceProvider extends ServiceProvider {

    /**
     * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
     *
     * @return void
     */
    public function boot() {
        //регистрация политик моделей
//        foreach(Boot::policies_model() as $model_class => $policy_class) {
//            $gate->policy($model_class, $policy_class);
//        }
        //регистрация путей шаблонов для пространств имен
        foreach(Boot::view_paths() as  $v) {
            $namespace = Arr::get($v, 'namespace');
            $view_path = Arr::get($v, 'view_path');
            $this->loadViewsFrom($view_path, $namespace);
        }
        //регистрация команд
        $this->commands(Boot::commands());
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        //
    }
}
