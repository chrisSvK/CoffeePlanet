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


Route::get('/', 'HomeController@index')->name('home');

//Vypis
Route::resource('produktik', 'ProductController');
Route::get('mleta', 'ProductController@mleta');
Route::get('zrnkova', 'ProductController@zrnkova');
Route::get('kapsule', 'ProductController@kapsule');
Route::get('cierny', 'ProductController@cierny');
Route::get('zeleny', 'ProductController@zeleny');
Route::get('ovocny', 'ProductController@ovocny');
Route::get('bylinkovy', 'ProductController@bylinkovy');
Route::get('prislusenstvo', 'ProductController@prislusenstvo');

Route::get('produkt/{produkt}', 'ProductController@produkt');

//Admin Produkt
Route::get('products/list/{page}', 'ProductController@list');
Route::delete('products/{product}', 'ProductController@destroy');
Route::post('products/', 'ProductController@store');
Route::get('products/{product}/edit', 'ProductController@edit');
Route::put('products/{product}', 'ProductController@update');

//Kosik
Route::get('/kosik', 'CartController@index')->name('cart.index');
Route::post('/kosik', 'CartController@store')->name('cart.store')->middleware('auth');;
Route::delete('/kosik/{product}', 'CartController@destroy')->name('cart.destroy');

Route::get('/doprava', function () {
    return view('doprava');
})->middleware('auth');;

Route::post('/platba', 'CartController@doprava')->middleware('auth');;

Route::get('/sumarizacia', 'CartController@platba')->middleware('auth');;
Route::post('/sumarizacia', 'CartController@sumarizacia')->middleware('auth');;



//Prihlasovanie
Route::get('/login', 'ZakaznikController@login')->name('login');
Route::post('/login', 'SessionController@store');
Route::get('/logout', 'SessionController@destroy');

Route::get('/empty', function () {
    Cart::destroy();
});

Route::get('/registration', function () {
    return view('registration');
});

Route::post('/registration', 'ZakaznikController@create');






