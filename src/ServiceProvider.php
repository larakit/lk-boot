<?php
namespace Larakit;

use Larakit\Page\PageTheme;

abstract class ServiceProvider1 extends \Illuminate\Support\ServiceProvider {

    /**
     * Инициализация пакета
     *
     * @param $package_base_dir
     */
//    static function initPackage($package_base_dir) {
//        if(is_dir($package_base_dir)) {
//            $inits = rglob('*.php', 0, $package_base_dir);
//            foreach($inits as $init) {
//                include_once $init;
//            }
//        }
//    }

    function larapackage1($package, $alias = null) {
        if(!$alias) {
            $alias = $package;
        }
        //если назначена кастомная тема оформления
//        if($theme = PageTheme::getCurrent()) {
            /// если переопределены шаблоны вьюх для указанной темы
//            $theme_views_dir = base_path('vendor/' . $package . '/src/views/!/themes/' . $theme);
//            if(file_exists($theme_views_dir)) {
//                $this->loadViewsFrom($theme_views_dir, $alias);
//            }
//        }
        //базовые шаблоны пакета
//        $view_dir = base_path('vendor/' . $package . '/src/views');
//        if(file_exists($view_dir)) {
//            $this->loadViewsFrom($view_dir, $alias);
//        }

        //базовые шаблоны пакета
//        $lang_dir = base_path('vendor/' . $package . '/src/lang');
//        if(file_exists($lang_dir)) {
//            $this->loadTranslationsFrom($lang_dir, $alias);
//            $this->publishes([
//                $lang_dir => resource_path('lang/vendor/' . $alias),
//            ]);
//        }

        //регистрируем миграции
//        if(is_dir(base_path('vendor/' . $package . '/src/migrations'))) {
//            $this->publishes([
//                base_path('vendor/' . $package . '/src/migrations') => base_path('database/migrations'),
//            ], 'migrations');
//        }
//        $this->bootPackage($package);
    }

//    function bootPackage($package) {
//        $booters = rglob('*.php', 0, base_path('vendor/' . $package . '/src/boot'));
//        foreach($booters as $booter) {
//            include_once $booter;
//        }
//    }

}
