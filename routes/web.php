<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CopyController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\UserController;
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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth.basic'])->group(function () {
    Route::apiResource('/api/copies', CopyController::class);
    Route::apiResource('/api/books', BookController::class);
    Route::apiResource('/api/users', UserController::class);

    //view
    Route::get('/copy/new', [CopyController::class, 'newView']);
    Route::get('/copy/edit/{id}', [CopyController::class, 'editView']);
    Route::get('/copy/list', [CopyController::class, 'listView']);

});

    Route::middleware( ['admin'])->group(function () {
    Route::apiResource('/users', UserController::class);

});
    Route::apiResource('/api/copies', CopyController::class);
    Route::apiResource('/api/books', BookController::class);
    Route::apiResource('/api/users', UserController::class);
    Route::patch('/api/users/password/{id}', [UserController::class, 'updatePassword']);

    //view- lending
    Route::get('/lending/new', [LendingController::class, 'newView']);
    Route::get('/api/books/{id}', [BookController::class, 'show']);
    Route::get('/api/lendings', [LendingController::class, 'index']);

require __DIR__.'/auth.php';
