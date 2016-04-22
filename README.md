[![Total Downloads](https://poser.pugx.org/larakit/laravel-larakit-spa/d/total.svg)](https://packagist.org/packages/larakit/laravel-larakit-spa)
[![Latest Stable Version](https://poser.pugx.org/larakit/laravel-larakit-spa/v/stable.svg)](https://packagist.org/packages/larakit/laravel-larakit-spa)
[![Latest Unstable Version](https://poser.pugx.org/larakit/laravel-larakit-spa/v/unstable.svg)](https://packagist.org/packages/larakit/laravel-larakit-spa)
[![License](https://poser.pugx.org/larakit/laravel-larakit-spa/license.svg)](https://packagist.org/packages/larakit/laravel-larakit-spa)

#larakit spa
Пакет для отложенной регистрации сервис-провайдеров и алиасов для Laravel 

##Step 1
Создавая модуль указываем в composer.json автоподключаемый файл init.php
~~~
{
    "name": ".../...",
    "description": "...",
    "license": "MIT",
    "require": {
        ...
    },

    "autoload": {
        "files": [
			"src/init.php"
        ]
    }
}
~~~

##Step 2
В файле "src/init.php" регистрируем сервис-провайдеры и алиасы
~~~
<?php
Larakit\SPA::register_provider('Larakit\Base\LarakitServiceProvider');
Larakit\SPA::register_alias('View', 'Illuminate\Support\Facades\View');
~~~

##Step 3
Добавляем в ./config/app.php зарегистрированные сервис-провайдеры и алиасы
~~~
<?php

return [
    'providers'       => array_merge([
        ...
    ], \Larakit\SPA::providers()),

    'aliases'         => array_merge([
        ...
    ], \Larakit\SPA::aliases()),

];
~~~

##Step 4
Profit!