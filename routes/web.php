<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Student\StudentController;


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

Route::redirect('/' , '/home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::resource('/admin', AdminController::class);
    Route::resource('/student', StudentController::class);
    Route::resource('/chats', ChatController::class);
    Route::get('/page/{page}', [PageController::class, 'index'])->name('page');
});

Route::get('/home', [HomeController::class, 'index']);

