<?php
use App\Http\Controllers\HomeController;
use Iliuminates\FrameworkSettings;
use Iliuminates\Locales\Lang;
use Iliuminates\Router\Route;
use Iliuminates\Sessions\Session;

//Route::get('/', HomeController::class, 'index');
Route::get('/', function () {
    FrameworkSettings::setLocale('en');
    return trans('main.edit'); 
    //return  view('index');
});

Route::group(['prefix'=>'site'], function () {

    Route::get('/about', HomeController::class, 'about');
    
    //Route::get('article/{id}', HomeController::class, 'article');
    Route::get('/article/{id}/{name}', function ($id, $name) {
        return $id.$name;
    });
});
