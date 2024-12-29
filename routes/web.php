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
        Route::get('/index', [App\Http\Controllers\ItemController::class, 'index'])->name('item.index');
        Route::get('/show/{item}', [App\Http\Controllers\ItemController::class, 'show'])->name('item.show');
        Route::group(['middleware' => 'can:admin'], function() {
            Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
            Route::post('/add', [App\Http\Controllers\ItemController::class, 'add'])->name('item.add');
            Route::get('/edit/{item}', [App\Http\Controllers\ItemController::class, 'update'])->name('item.edit');
            Route::patch('/edit/{item}', [App\Http\Controllers\ItemController::class, 'update'])->name('item.update');
            Route::delete('/delete/{item}', [App\Http\Controllers\ItemController::class, 'destroy'])->name('item.delete');
        });
    });
    Route::group(['middleware' => 'can:admin'], function() {
        Route::prefix('users')->group(function () {
            Route::get('/index', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
            Route::get('/showEdit/{user}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
            Route::patch('/edit/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
            Route::delete('/delete/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.delete');
        });
    });

    Route::prefix('locations')->group(function () {
        Route::get('/index', [App\Http\Controllers\LocationController::class, 'index'])->name('location.index');
        Route::get('/show/{location}', [App\Http\Controllers\LocationController::class, 'show'])->name('location.show');
        Route::group(['middleware' => 'can:admin'], function() {
            Route::get('/add', [App\Http\Controllers\LocationController::class, 'add'])->name('location.add');
            Route::post('/add', [App\Http\Controllers\LocationController::class, 'add']);
            Route::get('/edit/{location}', [App\Http\Controllers\LocationController::class, 'edit'])->name('location.edit');
            Route::patch('/edit/{location}', [App\Http\Controllers\LocationController::class, 'edit'])->name('location.update');
            Route::delete('/delete/{location}', [App\Http\Controllers\LocationController::class, 'destroy'])->name('location.delete');
        });
    });

    Route::prefix('profile')->group(function () {
        Route::get('/edit/{auth}', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/update/{auth}', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
        Route::get('/settings/{auth}', [App\Http\Controllers\ProfileController::class, 'passwordEdit'])->name('password.edit');
        Route::patch('/password/update/{auth}', [App\Http\Controllers\ProfileController::class, 'passwordUpdate'])->name('password.update');
    });

    Route::prefix('choice')->group(function () {
        Route::get('/index', [App\Http\Controllers\ChoiceController::class, 'index'])->name('choice.index');
        Route::get('/add', [App\Http\Controllers\ChoiceController::class, 'add'])->name('choice.add');
        Route::post('/add', [App\Http\Controllers\ChoiceController::class, 'add']);

    });

    Route::prefix('menu')->group(function () {
        Route::get('/index',[App\Http\Controllers\MenuController::class, 'index'])->name('menu.index');
        Route::get('/add',[App\Http\Controllers\MenuController::class, 'create']);
        Route::post('/add',[App\Http\Controllers\MenuController::class, 'store'])->name('menu.store');
        Route::get('/edit/{menu}',[App\Http\Controllers\MenuController::class, 'edit'])->name('menu.edit');
        Route::patch('/add/{menu}',[App\Http\Controllers\MenuController::class, 'edit'])->name('menu.update');
        Route::delete('/delete/{menu}',[App\Http\Controllers\MenuController::class, 'destroy'])->name('menu.delete');
    });
});

