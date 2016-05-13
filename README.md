[![Total Downloads](https://poser.pugx.org/larakit/lk-boot/d/total.svg)](https://packagist.org/packages/larakit/lk-boot)
[![Latest Stable Version](https://poser.pugx.org/larakit/lk-boot/v/stable.svg)](https://packagist.org/packages/larakit/lk-boot)
[![Latest Unstable Version](https://poser.pugx.org/larakit/lk-boot/v/unstable.svg)](https://packagist.org/packages/larakit/lk-boot)
[![License](https://poser.pugx.org/larakit/lk-boot/license.svg)](https://packagist.org/packages/larakit/lk-boot)

#[Larakit Boot] - пакет для отложенной регистрации сервис-провайдеров, алиасов и middleware

После установки очередного пакета, который требовал внесения правок конфига
~~~
./config/app.php
~~~
в секциях сервис-провайдеры и алиасы я сказал "Доколе!!! Надоело!!!".

Тем более, что в разработке было очень много своих пакетов, которые требовали регистрации:
- сервис-провайдеров
- алиасов
- middleware (общесайтовых, групповых, для роутов)

Так появился на свет модуль larakit/lk-boot.

Принцип отложенной регистрации всего этого хозяйства заключается в использовании секции autoload в composer.

Но, напрямую нельзя записать инструкции, так как в момент подключения
~~~
{
    "autoload": {
        "files": [
	    "src/init.php"
        ]
    }
}
~~~
фреймворк еще не инициализирован.
Поэтому задача состояла из двух пунктов:

1) положить куда то данные о вещах, требующих регистрации, причем чтобы это "что-то" не требовало инициализированного фреймворка

2) в нужное время спросить у этого "чего-то" - есть что для регистрации? и инициализировать



##1. Решение вопроса регистрации

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

В этом файле "src/init.php" регистрируем то, что нужно
~~~php
<?php
/*################################################################################
  регистрация сервис-провайдера
################################################################################*/
Larakit\Boot::register_provider('Larakit\Base\LarakitServiceProvider');

/*################################################################################
  регистрация алиаса
################################################################################*/
Larakit\Boot::register_alias('View', 'Illuminate\Support\Facades\View');

/*################################################################################
  регистрация middlewares
################################################################################*/
Boot::register_middleware(\Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class);

/*################################################################################
  регистрация route middlewares
################################################################################*/
Boot::register_middleware_route('auth', 
	\App\Http\Middleware\Authenticate::class);
Boot::register_middleware_route('auth.basic', 
	\Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class);
Boot::register_middleware_route('guest', 
	\App\Http\Middleware\RedirectIfAuthenticated::class);
Boot::register_middleware_route('throttle', 
	\Illuminate\Routing\Middleware\ThrottleRequests::class);

/*################################################################################
  регистрация group middlewares
################################################################################*/
Boot::register_middleware_group('api', 'throttle:60,1');
Boot::register_middleware_group('web', [
    \App\Http\Middleware\EncryptCookies::class,
    \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
    \Illuminate\Session\Middleware\StartSession::class,
    \Illuminate\View\Middleware\ShareErrorsFromSession::class,
    \App\Http\Middleware\VerifyCsrfToken::class,
]);
~~~

##2. Решение вопроса инициализации сервис-провайдеров и алиасов
###2.1. Сервис-провайдеры и алиасы

Производим изменения в файле
~~~
./config/app.php
~~~
 (требуется произвести всего один раз)
 
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

###2.2. Middleware
Производим изменения в файле
~~~
./app/Http/Kernel.php
~~~
 (требуется произвести всего один раз)

~~~php
<?php

namespace App\Http;
use Illuminate\Contracts\Foundation\Application;
use \Larakit\TraitKernel as TraitKernel;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Routing\Router;

class Kernel extends HttpKernel {
    use TraitKernel;

    function __construct(Application $app, Router $router){
        $this->__traitConstruct();
        parent::__construct($app, $router);
    }

}
~~~

###Profit!
