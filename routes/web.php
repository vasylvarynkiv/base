<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes([
    'register' => false,
    //    'reset' => false,
    //    'confirm' => false,
    //    'verify' => false,
]);

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth', 'namespace' => 'Admin'], function (Router $router) {
    $router->group(['prefix' => 'admin'], function (Router $router) {
        $router->get('/', 'DashboardController@index')->name('admin');

        $router->resource('users', 'UserController');
//        $router->get('users', 'UserController@index')->name('user.index');
    });
});
