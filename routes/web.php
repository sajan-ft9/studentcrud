<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    // student route
    Route::prefix('student')->controller(StudentController::class)->group(function () {
        Route::get('/list',  'list')->name('student.list');
        Route::get('/profile/{student}',  'profile')->name('student.profile');
        Route::get('/create',  'create')->name('student.create');
        Route::post('/store',  'store')->name('student.store');
        Route::get('/edit/{student}',  'edit')->name('student.edit');
        Route::patch('/update/{student}',  'update')->name('student.update');
        Route::delete('/delete/{student}',  'destroy')->name('student.delete');
    });

    // admin route
    Route::prefix('admin')->controller(HomeController::class)->group(function () {
        Route::get("/profile", 'profile')->name('admin.profile');
        Route::patch("/update", 'update')->name('admin.update');
        Route::patch("/update_password", 'updatePassword')->name('admin.update_password');
    });
});
