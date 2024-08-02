<?php
use App\Http\Controllers\HomeController;
use Iliuminates\Router\Route;
use Iliuminates\Sessions\Session;

//Route::get('/', HomeController::class, 'index');
Route::get('/', function() {
    return Session::get('locale');
});

Route::group(['prefix'=>'site'], function () {

    Route::get('/about', HomeController::class, 'about');
    
    //Route::get('article/{id}', HomeController::class, 'article');
    Route::get('/article/{id}/{name}', function ($id, $name) {
        return $id.$name;
    });
});
