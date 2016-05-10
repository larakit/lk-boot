[![Total Downloads](https://poser.pugx.org/larakit/lk-boot/d/total.svg)](https://packagist.org/packages/larakit/lk-boot)
[![Latest Stable Version](https://poser.pugx.org/larakit/lk-boot/v/stable.svg)](https://packagist.org/packages/larakit/lk-boot)
[![Latest Unstable Version](https://poser.pugx.org/larakit/lk-boot/v/unstable.svg)](https://packagist.org/packages/larakit/lk-boot)
[![License](https://poser.pugx.org/larakit/lk-boot/license.svg)](https://packagist.org/packages/larakit/lk-boot)

#larakit Boot
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
Larakit\Boot::register_provider('Larakit\Base\LarakitServiceProvider');
Larakit\Boot::register_alias('View', 'Illuminate\Support\Facades\View');
~~~

##Step 3
Добавляем в ./config/app.php зарегистрированные сервис-провайдеры и алиасы
~~~
<?php

return [
    'providers'       => array_merge([
        ...
    ], \Larakit\Boot::providers()),

    'aliases'         => array_merge([
        ...
    ], \Larakit\Boot::aliases()),

];
~~~

##Step 4
Profit!
