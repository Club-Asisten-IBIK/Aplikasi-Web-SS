<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EducationalHistoriesController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\LeavingRecordsController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\PhysicalRecordController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ComponentSalaryController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login']);
Route::get('/sidebar', function () {
    return view('layouts.navbar.navigation');
});
Route::get('/dashboard', function () {
    return view('mainpage.dashboard');
});

// Employee routes
Route::resource('employee', EmployeeController::class);

// Role routes
Route::resource('role', RoleController::class);

// User routes
Route::resource('user', UserController::class);

// Student routes
Route::resource('student', StudentController::class);

// Class & Subject routes using resource controllers
Route::resource('class', ClassController::class);
Route::resource('subject', SubjectController::class);

// Parent & Physical records routes using resource controllers
Route::resource('parent', ParentController::class);
Route::resource('physical-record', PhysicalRecordController::class);

// Educational Histories routes
Route::resource('educational', EducationalHistoriesController::class);

// Leaving Records routes
Route::resource('leaving-records', LeavingRecordsController::class);

// Component Salary routes
Route::resource('component-salary', ComponentSalaryController::class);

// School Year routes
Route::resource('school-year', SchoolYearController::class);

// User Role routes
Route::resource('userrole', UserRoleController::class);

// Grade routes
Route::resource('grade', GradeController::class);
