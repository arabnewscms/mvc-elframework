<?php

use Iliuminates\Router\Route;

Route::get('api', function () {
    return 'Welcome To Api Roue';
});



Route::get('api/users', function () {
    return 'Welcome To users api Roue';
});
