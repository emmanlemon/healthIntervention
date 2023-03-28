<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SurveyController;
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
    Route::resource('/survey', SurveyController::class);
    Route::get('/survey/result/{survey}', [SurveyController::class, 'viewResult']);
    Route::put('/survey/edit/{id}', [SurveyController::class, 'editQuestion']);
    Route::resource('/answer', AnswerController::class);
    Route::get('/page/{page}', [PageController::class, 'index'])->name('page');
    Route::get('/page/print/answer/{id}', [PrintController::class, 'printAnswer']);
    Route::get('/page/print/survey/{id}', [PrintController::class, 'printSurvey']);
    Route::get('/page/printresult/survey/{survey}', [PrintController::class, 'printSurveyResult']);
    // Route::get('/page/print/survey/answer/{id}', [PrintController::class, 'printSurveyUserAnswer']);
});

Route::get('/home', [HomeController::class, 'index']);

