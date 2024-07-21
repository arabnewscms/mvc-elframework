<?php
use App\Http\Controllers\HomeController;
use Iliuminates\Router\Route;



Route::get( '/', HomeController::class, 'index');
Route::get( '/about', HomeController::class, 'about');

Route::get('article/{id}', HomeController::class, 'article');