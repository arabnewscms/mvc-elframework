<?php

use App\Http\Middleware\SimpleMiddleware;
use App\Http\Middleware\UsersMiddleware;
use Iliuminates\Router\Route;

Route::group(['prefix'=>'/api/','middleware'=>[SimpleMiddleware::class]],function(){

    // api
    Route::get('/', function () {
        return 'Welcome To Api Roue';
    });

    // api/users
    Route::get('users', function () {
        return 'Welcome To users api Roue';
    },[UsersMiddleware::class]);

    Route::get('article', function () {
        return 'Welcome To article api Roue';
    });
    
});