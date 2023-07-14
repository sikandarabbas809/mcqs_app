<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Auth;

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
Route::middleware(['auth'])->group(function () {
    Route::get('/questions',[App\Http\Controllers\QuestionController::class, 'index'])->name('questions');
    Route::post('questions/store',[App\Http\Controllers\QuestionController::class, 'store'])->name('questions.store');
    Route::post('questions/delete/{id}',[App\Http\Controllers\QuestionController::class, 'delete'])->name('questions.delete');
    Route::get('user/result',[App\Http\Controllers\QuestionController::class, 'userResult'])->name('user.result');
    Route::post('save/answer',[App\Http\Controllers\HomeController::class, 'saveAnswer'])->name('save.answer');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});



