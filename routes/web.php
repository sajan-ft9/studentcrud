<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/',[App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->prefix('student')->group(function(){

    Route::get('/list', [StudentController::class, 'list'])->name('student.list');
    Route::get('/profile/{student}', [StudentController::class, 'profile'])->name('student.profile');
    Route::get('/create', [StudentController::class, 'create'])->name('student.create');
    Route::post('/create', [StudentController::class, 'store'])->name('student.create');
    Route::get('/edit/{student}', [StudentController::class, 'edit'])->name('student.edit');
    Route::patch('/edit/{student}', [StudentController::class, 'update'])->name('student.edit');
    Route::delete('/delete/{student}', [StudentController::class, 'destroy'])->name('student.delete');
});