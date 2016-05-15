<?php

namespace Larakit;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\ServiceProvider;

class LarakitBootServiceProvider extends ServiceProvider {

    /**
     * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
     *
     * @return void
     */
    public function boot(GateContract $gate) {
        //регистрация политик моделей
        foreach(Boot::policies_model() as $model_class => $policy_class) {
            $gate->policy($model_class, $policy_class);
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
