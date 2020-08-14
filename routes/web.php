<?php

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
    return view('welcome');
})->name('index');

Auth::routes();

Route::get('/transactions', 'TransactionController@index')->name('transactions');
Route::get('/transactions/{sss}', 'TransactionController@index')->name('transactions.s')->where('sss', 'spending|income');
//Route::post('/transactions/add/{transaction}', 'TransactionController@addTransaction')->name('transactions.add')->where('transaction', 'spending|income');
