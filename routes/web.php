<?php

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

Auth::routes();

Route::prefix('admin')->namespace('Admin')->middleware('auth')->name('admin.')
    ->group(function(){
        // Home Admin
        Route::get('/', 'HomeController@index')->name('home');
        // Resource Posts
        Route::resource('/posts', 'PostController');
    });

// Front Office 
Route::get('{any?}', function () {
    return view('guest.home');
})->where('any', '.*');