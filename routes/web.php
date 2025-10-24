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
Route::get('/role', [RoleController::class, 'index'])->name('role.index');
Route::post('/role', [RoleController::class, 'store'])->name('role.store');
Route::put('/role/{roleid}', [RoleController::class, 'update'])->name('role.update');
Route::delete('/role/{roleid}', [RoleController::class, 'destroy'])->name('role.destroy');

// User routes
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{userid}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{userid}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{userid}', [UserController::class, 'destroy'])->name('user.destroy');

// Student routes
Route::get('/student', [\App\Http\Controllers\StudentController::class, 'index'])->name('student.index');
Route::get('/student/create', [\App\Http\Controllers\StudentController::class, 'create'])->name('student.create'); // Changed from POST to GET
Route::post('/student', [\App\Http\Controllers\StudentController::class, 'store'])->name('student.store');
Route::get('/student/{id}/edit', [\App\Http\Controllers\StudentController::class, 'edit'])->name('student.edit');
Route::put('/student/{id}', [\App\Http\Controllers\StudentController::class, 'update'])->name('student.update');
Route::delete('/student/{id}', [\App\Http\Controllers\StudentController::class, 'destroy'])->name('student.destroy');

// Class & Subject routes using resource controllers
Route::resource('class', ClassController::class);
Route::resource('subject', SubjectController::class);

// Parent & Physical records routes using resource controllers
Route::resource('parent', ParentController::class);
Route::resource('physical', PhysicalRecordController::class);

// Educational Histories routes
Route::resource('educational', EducationalHistoriesController::class);

// Leaving Records routes
Route::resource('leaving-records', LeavingRecordsController::class);

// Component Salary routes
Route::get('/component-salary', [ComponentSalaryController::class, 'index'])->name('component-salary.index');
Route::get('/component-salary/create', [ComponentSalaryController::class, 'create'])->name('component-salary.create');
Route::post('/component-salary', [ComponentSalaryController::class, 'store'])->name('component-salary.store');
Route::get('/component-salary/{id}/edit', [ComponentSalaryController::class, 'edit'])->name('component-salary.edit');
Route::put('/component-salary/{id}', [ComponentSalaryController::class, 'update'])->name('component-salary.update');
Route::delete('/component-salary/{id}', [ComponentSalaryController::class, 'destroy'])->name('component-salary.destroy');

// School Year routes
Route::get('/school-year', [SchoolYearController::class, 'index'])->name('school-year.index');
Route::get('/school-year/create', [SchoolYearController::class, 'create'])->name('school-year.create');
Route::post('/school-year', [SchoolYearController::class, 'store'])->name('school-year.store');
Route::get('/school-year/{id}/edit', [SchoolYearController::class, 'edit'])->name('school-year.edit');
Route::put('/school-year/{id}', [SchoolYearController::class, 'update'])->name('school-year.update');
Route::delete('/school-year/{id}', [SchoolYearController::class, 'destroy'])->name('school-year.destroy');

// Grade routes
Route::post('/grades', [GradeController::class, 'store'])->name('grades.store');
Route::post('/grades/batch', [GradeController::class, 'storeBatch'])->name('grades.batch');
