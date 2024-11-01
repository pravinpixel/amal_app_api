<?php
use App\Http\Controllers\Api\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Welcome Amalorpavam Alumini';
});
Route::get('session', [StudentController::class, 'generateSessionToken'])->name('generateSessionToken');
Route::get('createIdcard/{id}', [StudentController::class, 'createIdcard'])->name('createIdcard');


Route::group([
    'middleware' => 'session',
], function () {
    Route::get('essentials', [StudentController::class, 'getEssentials'])->name('getEssentials');
    Route::get('student', [StudentController::class, 'getStudentDetails'])->name('getStudentDetails');
    Route::post('student', [StudentController::class, 'createStudent'])->name('createStudent');
    Route::post('studentData', [StudentController::class, 'uploadStudentData'])->name('uploadStudentData');
    Route::post('emailverify', [StudentController::class, 'emailverfiy'])->name('emailverfiy');
    Route::post('otpverify', [StudentController::class, 'otpverify'])->name('otpverify');
    Route::post('login', [StudentController::class, 'login'])->name('login');
    Route::post('logout', [StudentController::class, 'studentlogout'])->name('studentlogout');
});

Route::group([
    'middleware' => 'auth:api',
], function () {
    Route::prefix('student')->controller(StudentController::class)->group(function () {
        Route::post('/', 'viewStudent')->name('view');
        Route::post('/academic', 'addAcademicDetails')->name('addAcademicDetails');
        Route::post('/personal', 'addPersonalDetails')->name('addPersonalDetails');
        Route::post('/professional', 'addProfessionalDetails')->name('addProfessionalDetails');
        Route::post('/demographic', 'addDemographicDetails')->name('addDemographicDetails');
        Route::post('/documents', 'addDocuments')->name('addDocuments');
        Route::get('/getme', 'getMe')->name('getMe');

    });

});






