<?php
use App\Http\Controllers\HomeController;
use App\Http\Middleware\SimpleMiddleware;
use Iliuminates\Router\Route;
 

//Route::get('/', HomeController::class, 'index');
Route::get('/', function() {
    return 'index page';
});

Route::get('/about', HomeController::class, 'about');

//Route::get('article/{id}', HomeController::class, 'article');
Route::get('article/{id}/{name}', function($id,$name){
    return $id.$name;
});
