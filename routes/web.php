<?php

use App\Http\Controllers\SocialiteController;
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

Route::get('/', function () {
    return view('home');
})->name('root');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::controller(SocialiteController::class)->group(function () {
    Route::get('/auth/{provider}/redirect', 'redirect')->name('auth.redirect');
    Route::get('/auth/{provider}/callback', 'callback')->name('auth.callback');

    Route::group(['middleware' => ['auth']], function() {
        Route::get('/auth/logout', 'logout')->name('auth.logout');
    });
});
