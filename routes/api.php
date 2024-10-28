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
    Route::get('school', [StudentController::class, 'getSchoolDetails'])->name('getSchoolDetails');
    Route::get('student', [StudentController::class, 'getStudentDetails'])->name('getStudentDetails');
    Route::post('student', [StudentController::class, 'createStudent'])->name('createStudent');
    Route::post('studentData', [StudentController::class, 'uploadStudentData'])->name('uploadStudentData');
    Route::post('emailverify', [StudentController::class, 'emailverfiy'])->name('emailverfiy');
    Route::post('otpverify', [StudentController::class, 'otpverify'])->name('otpverify');

    Route::group([
        'middleware' => 'auth:api',
    ], function () {
        Route::prefix('student')->controller(StudentController::class)->group(function () {
            Route::post('/', 'viewStudent')->name('view');
            Route::post('/academic', 'addAcademicDetails')->name('addAcademicDetails');
        });

    });

});






