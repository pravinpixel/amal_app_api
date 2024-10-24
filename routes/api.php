<?php
use App\Http\Controllers\Api\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Welcome Amalorpavam Alumini';
});

Route::group([
    'middleware' => 'api',
], function () {
    Route::get('student', [StudentController::class, 'getStudentDetails'])->name('getStudentDetails');
    Route::post('student', [StudentController::class, 'createStudent'])->name('createStudent');
    Route::post('studentData', [StudentController::class, 'uploadStudentData'])->name('uploadStudentData');

    Route::group([
        'middleware' => 'auth:api',
    ], function () {
        Route::prefix('student')->controller(StudentController::class)->group(function () {
            Route::post('/', 'viewStudent')->name('view');
        });

    });

});






