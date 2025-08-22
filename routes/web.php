<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login']);
Route::get('/sidebar', function () {
    return view('layouts.navbar.navigation');
});
Route::get('/dashboard', function () {
    return view('mainpage.dashboard');
});
Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');
Route::put('/employee/{employeeid}', [EmployeeController::class, 'update'])->name('employee.update');
Route::delete('/employee/{employeeid}', [EmployeeController::class, 'destroy'])->name('employee.destroy');

Route::get('/role', [RoleController::class, 'index'])->name('role.index');
Route::post('/role', [RoleController::class, 'store'])->name('role.store');
Route::delete('/role/{roleid}', [RoleController::class, 'destroy'])->name('role.destroy');
Route::put('/role/{roleid}', [RoleController::class, 'update'])->name('role.update');

Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::delete('/user/{userid}', [UserController::class, 'destroy'])->name('user.destroy');
Route::put('/user/{userid}', [UserController::class, 'update'])->name('user.update');

Route::get('/student', [\App\Http\Controllers\StudentController::class, 'index'])->name('student.index');
Route::post('/student', [\App\Http\Controllers\StudentController::class, 'store'])->name('student.store');
Route::put('/student/{studentid}', [\App\Http\Controllers\StudentController::class, 'update'])->name('student.update');
Route::delete('/student/{studentid}', [\App\Http\Controllers\StudentController::class, 'destroy'])->name('student.destroy');
