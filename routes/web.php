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
use App\Http\Controllers\UserController;
use Laravel\Jetstream\Rules\Role;

Route::get('/', [MainController::class, "index"]);
Route::get('/dashboard', [MainController::class, "dashboard"])->middleware('auth');
Route::get('/insert', [MainController::class, 'insert'])->middleware('auth');
Route::post('/insert/data', [MainController::class, 'insertData'])->middleware('auth');

Route::get('/read', [MainController::class, 'read'])->middleware('auth');

Route::get('/edit/{id}', [MainController::class, 'edit'])->middleware('auth');
Route::post('/edit/data/{id}', [MainController::class, 'editData'])->middleware('auth');

Route::delete('delete/data/{id}', [MainController::class, 'deleteData'])->middleware('auth');

Route::get('/report', [MainController::class, 'report'])->middleware('auth');

Route::get('account', [UserController::class, 'account'])->middleware('auth');
Route::post('account/edit/{id}', [UserController::class, 'editProfile'])->middleware('auth');
Route::post('account/photo/{id}', [UserController::class, 'editProfilePicture'])->middleware('auth');

Route::get('/users', [UserController::class, 'users'])->middleware('auth');
Route::post('/users/edit/{id}', [UserController::class, 'editUser'])->middleware('auth');
Route::delete('/users/delete/{id}', [UserController::class, 'deleteUser'])->middleware('auth');