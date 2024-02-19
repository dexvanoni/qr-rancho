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

Route::get('/', function () {
    return view('welcome');
})->name('inicio');

//Auth::routes();

//LOGIN PARA USUÁRIO
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logon', 'Auth\LoginController@attemptLogin')->name('logon');

//LOGIN PARA FISCAL DO RANCHO
Route::get('/login-fiscal', 'LoginFiscalController@create')->name('login-fiscal');
Route::post('/login-fiscal', 'LoginFiscalController@login');
Route::post('/logon-fiscal', 'LoginFiscalController@attemptLogin')->name('logon-fiscal');


//LOGIN PARA ADM DO RANCHO
Route::get('/login-rancho', 'LoginRanchoController@create')->name('login-rancho');
Route::post('/login-rancho', 'LoginRanchoController@login');
Route::post('/logon-rancho', 'LoginRanchoController@attemptLogin')->name('logon-rancho');

Route::post('/logout', 'Auth\LoginController@logout')->name('logout');


//ROTAS RESOURCES DOS CONTROLLERS
Route::resource('administradores', 'AdminsController');
Route::resource('arrac', 'ArracController');


use App\Http\Controllers\QRCodeController;

Route::get('/qr-code', [QRCodeController::class, 'showQRCode'])->name('qr');
Route::post('/qr-code', [QRCodeController::class, 'readQRCode']);


Route::get('/home', 'HomeController@index')->name('home');

Route::post('/process_qr', 'QRCodeController@processarDados');