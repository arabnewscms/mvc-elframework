<?php
use App\Http\Controllers\HomeController;
use Iliuminates\Router\Route;
 

Route::get('/', HomeController::class, 'index');
Route::get('data', HomeController::class, 'data');
Route::post('send/data', HomeController::class, 'data_post');
// Route::get('/', function () {
//     return  view('index');
// });

Route::group(['prefix'=>'site'], function () {

    Route::get('/about', HomeController::class, 'about');
    
    //Route::get('article/{id}', HomeController::class, 'article');
    Route::get('/article/{id}/{name}', function ($id, $name) {
        return $id.$name;
    });
});
