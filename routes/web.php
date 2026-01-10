<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LeavetypeController;
use App\Http\Controllers\PayrollController;
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

    Route::prefix('payroll')->controller(PayrollController::class)->group(function () {
        Route::get("/", "index");
    });

    Route::prefix('attendance')->controller(AttendanceController::class)->group(function () {
        Route::get("/", "index");
        Route::get("create", "create");
    });

    Route::prefix("leave")->controller(LeaveController::class)->group(function () {
        Route::get("/", "index");
        Route::get("create", "create");
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
        Route::get('/', 'index');
        Route::get('create', 'create');
        Route::get('edit/{id}', 'edit');
        Route::delete('delete/{id}', 'delete');
    });

    Route::prefix('leave_type')->controller(LeavetypeController::class)->group(function () {

        Route::get('/', 'index')->name('leavetype.index');
        Route::get('create', 'create')->name('leavetype.create');
        Route::post('store', 'store')->name('leavetype.store');

        Route::get('edit/{id}', 'edit')->name('leavetype.edit');
        Route::post('update/{id}', 'update')->name('leavetype.update');

        Route::delete('destroy/{id}', 'destroy');
    });


    Route::get("/role/{id?}", [RoleController::class, 'index']);
    Route::get("/role/create", [RoleController::class, 'create']);
    // Route::get("/role/edit/{id}", [RoleController::class, 'edit']);



});

Auth::routes();

Route::match(['get', 'post'], '/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get("sendmail", function () {
    Mail::to("mkarimjui@gmail.com")->send(new UserNotification());
    return "Mail has been sent successfully";
});
