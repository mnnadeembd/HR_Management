<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LeavetypeController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PayrollitemController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalaryController;
use App\Mail\UserNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/', function () {
//     return view('layout.erp.app');
// });


Route::middleware('auth')->group(function () {

    Route::prefix('payrollitem')->controller(PayrollitemController::class)->name('payrollitem.')->group(function () {
        Route::get("/", "index")->name('index');
        Route::get("/create", "create")->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get("/edit/{id}", "edit")->name('edit');
        Route::put("/update/{id}", "update")->name('update');
        Route::delete("/destroy/{id}", "destroy")->name('destroy');
    });

    Route::prefix('payroll')
    ->controller(PayrollController::class)
    ->name('payroll.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/destroy/{id}', 'destroy')->name('destroy');
    });

    Route::prefix('attendance')->controller(AttendanceController::class)->name('attendance.')->group(function () {
        Route::get("/", "index")->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('view/{id}', 'show')->name('show');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::put('update/{id}', 'update')->name('update');
        // AJAX
        Route::get('employees/{department_id}', 'getEmployeesByDepartment')->name('employees.by.department');
    });



      Route::prefix('leave')->controller(LeaveController::class)->name('leave.')->group(function () {

      Route::get('/', 'index')->name('index');
        // Employee leave apply form
        Route::get('form', 'form')->name('form');
        Route::post('submit', 'submit')->name('submit');

        // Admin: pending leave list
        Route::get('pending', 'pending')->name('pending');
        Route::post('approve/{id}', 'approve')->name('approve');
        Route::post('reject/{id}', 'reject')->name('reject');

        // AJAX for employee dropdown
        Route::get('employees/{department_id}', 'getEmployeesByDepartment')->name('employees.by.department');
    });



    Route::prefix("salary")->controller(SalaryController::class)->group(function () {
        Route::get("/", "index");
    });

    Route::get('/', function () {
        return view('pages.erp.dashboard.index');
    });


    Route::prefix('employee')->controller(EmployeeController::class)->name('employee.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('view/{id}', 'show')->name('show');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::put('update/{id}', 'update')->name('update');
    });




    Route::prefix("designation")->controller(DesignationController::class)->group(function () {
        Route::get("/", "index");
        Route::get("create", "create");
        Route::get("edit/{id}", "edit");
    });

    Route::prefix('department')->controller(DepartmentController::class)->group(function () {
        Route::get('/', 'index')->name('department.index');
        Route::get('create', 'create')->name('department.create');
        Route::get('edit/{id}', 'edit')->name('department.edit');
        Route::post('store', 'store')->name('department.store');
        Route::put('update/{id}', 'update')->name('department.update');
        Route::delete('delete/{id}', 'delete')->name('department.delete');
    });


    Route::prefix('leave_type')->controller(LeavetypeController::class)->group(function () {
        Route::get('/', 'index')->name('leavetype.index');
        Route::get('create', 'create')->name('leavetype.create');
        Route::post('store', 'store')->name('leavetype.store');
        Route::get('edit/{id}', 'edit')->name('leavetype.edit');
        Route::post('update/{id}', 'update')->name('leavetype.update');
        Route::delete('destroy/{id}', 'destroy');
    });

    Route::prefix('role')->controller(RoleController::class)->group(function () {
        Route::get('/', 'index')->name('role.index');
        Route::get('create', 'create')->name('role.create');
        Route::post('/store', 'store')->name('role.store');
        Route::get('edit/{id}', 'edit')->name('role.edit');
        Route::post('updata/{id}', 'update')->name('role.update');
    });
});

Auth::routes();

Route::match(['get', 'post'], '/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get("sendmail", function () {
    Mail::to("mkarimjui@gmail.com")->send(new UserNotification());
    return "Mail has been sent successfully";
});
