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
use App\Http\Controllers\MainController;

Route::get('/', [MainController::class, "index"]);
Route::get('/insert', [MainController::class, 'insert']);
Route::post('/insert/data', [MainController::class, 'insertData']);

Route::get('/read', [MainController::class, 'read']);

Route::get('/edit/{id}', [MainController::class, 'edit']);
Route::post('/edit/data/{id}', [MainController::class, 'editData']);

Route::delete('delete/data/{id}', [MainController::class, 'deleteData']);

Route::get('/report', [MainController::class, 'report']);