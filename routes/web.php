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
Route::post('/transactions/add', 'TransactionController@create')->name('transactions.add');
Route::post('/transactions/delete/{id}', 'TransactionController@delete')->name('transactions.delete');
Route::patch('/transactions/edit/{id}', 'TransactionController@edit')->name('transactions.edit');
