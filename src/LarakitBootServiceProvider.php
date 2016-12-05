<?php

namespace Larakit;

use Illuminate\Support\Arr;

class LarakitBootServiceProvider extends \Illuminate\Support\ServiceProvider {
    
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
        foreach(Boot::view_paths() as $v) {
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
        foreach(Boot::$configs as $path_config => $is_deploy) {
            $path_config = str_replace('\\', '/', $path_config);
            $files       = rglob('*.php', 0, $path_config);
            
            foreach($files as $path) {
                $path = str_replace('\\', '/', $path);
                //                dump($path);
                $file   = str_replace([$path_config], [''], $path);
                $key    = str_replace(['.php', '/',], ['', '.'], $file);
                $config = app('config')->get($key, []);
                //                dd($path, require $path);
                //                dump(require $path, $config, array_merge(require $path, $config));
                app('config')->set($key, array_merge(require $path, $config));
                if($is_deploy) {
                    $this->publishes([$path => config_path($file),], 'config');
                }
            }
        }
        foreach(Boot::$migrations as $path) {
            $this->publishes([
                $path => base_path('database/migrations'),
            ], 'migrations');
        }
    }
}
