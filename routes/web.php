<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('login', 'loginpage')->name('login.page');
    Route::post('loginsave', 'loginsave')->name('loginsave');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.view');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('student/register-list', [StudentController::class, 'list'])->name('list');
    Route::get('student/view/{id}', [StudentController::class, 'view'])->name('student.view');
    Route::delete('student/delete/{id}', [StudentController::class, 'delete'])->name('student.delete');
    Route::post('student/save', [StudentController::class, 'createStudent'])->name('student.save');
    Route::post('student/update', [StudentController::class, 'updateStudent'])->name('student.update');
    Route::get('student/create', [StudentController::class, 'saveStudent'])->name('student.create');
    Route::get('student/edit/{id}', [StudentController::class, 'editStudent'])->name('student.edit');



    // Route::prefix('change-password')->controller(ChangePasswordController::class)->group(function () {
    //     Route::get('/', 'index')->name('change.password.get');
    //     Route::post('updatepassword', 'updatepassword')->name('change-password');
    // });
});
