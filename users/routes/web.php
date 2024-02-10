<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TrashedUsersController;




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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




    Route::resource('users', UsersController::class);

    Route::get('/showuser', [UsersController::class, 'show']);
    
    Route::get('/editusers', [UsersController::class, 'edit']);
    
    
    Route::resource('/trashedusers', TrashedUsersController::class);
    
    

    Route::get('users/trashed', [UsersController::class, 'trashed'])->name('users.trashed');
    Route::patch('users/{id}/restore', [UsersController::class, 'restore'])->name('users.restore');
    Route::delete('users/{id}/delete', [UsersController::class, 'delete'])->name('users.delete');
