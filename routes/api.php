<?php

use App\Http\Middleware\SimpleMiddleware;
use App\Http\Middleware\UsersMiddleware;
use Iliuminates\FrameworkSettings;
use Iliuminates\Router\Route;
use Iliuminates\Sessions\Session;

Route::group(['prefix'=>'/api/','middleware'=>[SimpleMiddleware::class]],function(){

    // api
    Route::get('/', function () {
        FrameworkSettings::setLocale('en');
        return FrameworkSettings::getLocale();
    });

    // api/users
    Route::get('users', function () {
        return 'Welcome To users api Route';
    },[UsersMiddleware::class]);

    Route::get('article', function () {
        return 'Welcome To article api Route';
    });
    
});