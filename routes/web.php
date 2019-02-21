<?php

use App\Notifications\InvoicePaid;
use App\User;
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
//     return view('welcome');
// });


Route::get('/','WalletController@index');
Route::get('add', 'WalletController@add');
Auth::routes();

// Route::get('/test', function ()
// {
//     $user = User::first()->notify(new InvoicePaid);
//     return view('welcome');
// });

Route::get('/test','WalletController@transaction');

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('ewallet', 'EWallet');
