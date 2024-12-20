<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('items')->group(function () {
        Route::get('/', [App\Http\Controllers\ItemController::class, 'index'])->name('item.index');
        Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
        Route::post('/add', [App\Http\Controllers\ItemController::class, 'add'])->name('item.add');
        Route::get('/showEdit/{item}', [App\Http\Controllers\ItemController::class, 'edit'])->name('item.edit');
        Route::patch('/edit/{item}', [App\Http\Controllers\ItemController::class, 'update'])->name('item.update');
        Route::delete('/delete/{item}', [App\Http\Controllers\ItemController::class, 'destroy'])->name('item.delete');
    });

    Route::prefix('users')->group(function () {
        Route::get('/index', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
        Route::get('/showEdit/{user}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
        Route::patch('/edit/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
        Route::delete('/delete/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.delete');

    });

});

