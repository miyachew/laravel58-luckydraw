<?php

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

// Route::get('/', function () {
    Route::get('/', 'WelcomeController@index')->name('welcome');
// });

Route::group(['middleware' => ['guest']], function () {
    Route::post('login', 'Auth\LoginController@login')->name('post-login');
});

Route::prefix('admin')->group(function () {
    Route::middleware(['guest'])->group(function () {
        Route::get('', 'Auth\LoginController@get')->name('login');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::get('overview','OverviewController@getOverview')->name('overview');

        Route::get('lucky-draw-winners','LuckyDrawWinnerController@index')->name('lucky-draw-winner-index');
        Route::get('lucky-draw-winners/create','LuckyDrawWinnerController@create')->name('lucky-draw-winner-create');
        Route::post('lucky-draw-winners/store','LuckyDrawWinnerController@store')->name('lucky-draw-winner-store');

        Route::get('logout', 'Auth\LoginController@logout')->name('logout');
    });
});
