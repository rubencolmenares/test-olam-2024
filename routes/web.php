<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WordSearchController;

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
/*/
Route::get('/', function () {
    return view('welcome');
});
Route::get('/', 'MatrizController@index')->name('matriz.index');
Route::post('/find-words', 'MatrizController@findWords')->name('matriz.find');*/
Route::get('/', [WordSearchController::class, 'index']);
Route::post('/search', [WordSearchController::class, 'search']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
