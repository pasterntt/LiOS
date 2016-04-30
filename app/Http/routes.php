<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('landing.index');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::controllers([
        'auth' => 'Auth\AuthController',
        'password' => 'Auth\PasswordController',
        'dashboard' => 'DashboardController',
        'ajax' => 'AjaxController',
        'shop' => 'ShopController',
        'cart' => 'CartController',
        'checkout' => 'CheckoutController',
        'virtual' => 'VirtualController',

    ]);
    Route::get('fremdlogin', function () {
        Auth::login(App\User::findOrFail(3));
    });
    Route::get('getstatus/{id}', 'VirtualController@getVPSStatus');
    Route::get('/', function () {
        return view('landing.index');
    });
    Route::get('/logout', function () {
        Auth::logout();

    });
});
