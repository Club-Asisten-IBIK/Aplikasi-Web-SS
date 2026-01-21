<?php

use App\Http\Controllers\Api\ClassController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\LoginMobileController;
use App\Http\Controllers\Api\SekolahController;
use App\Http\Controllers\Api\KelasController;
use App\Http\Controllers\Api\ParentController;
use App\Http\Controllers\Api\ProfileMobileController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\SchoolYearController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserRoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('roles', RoleController::class);
Route::apiResource('employees', EmployeeController::class);
Route::apiResource('classes', ClassController::class);
Route::apiResource('teachers', TeacherController::class);
Route::apiResource('subjects', SubjectController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('userroles', UserRoleController::class);
Route::apiResource('school-years', SchoolYearController::class);
Route::resource('parents', ParentController::class);
Route::apiResource('students', StudentController::class);
Route::apiResource('sekolah', SekolahController::class);
Route::apiResource('kelas', KelasController::class);
Route::get('profile/{studentId}', [ProfileMobileController::class, 'getProfile']);
Route::post('login', [LoginMobileController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [LoginMobileController::class, 'logout']);
