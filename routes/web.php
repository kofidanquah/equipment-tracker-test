<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\MaintenanceLogsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});

Route::controller(AuthController::class)->group(function (){
    Route::get('login', 'index')->name('login');
    Route::post('login', 'login');
    Route::post('logout', 'logout');
    // for test
    Route::get('passwordChange', 'passwordChange')->name('password.change');
    Route::post('passwordChange', 'confirmChange');
});

Route::middleware('auth')->group(function (){
    Route::get('adminDashboard', [AuthController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('workerDashboard', [AuthController::class, 'workerDashboard'])->name('worker.dashboard');

    Route::controller(RoleController::class)->group(function (){
        Route::get('allRoles', 'pagination');
    });
    Route::controller(WorkerController::class)->group(function (){
        Route::get('allWorkers', 'pagination');
    });
    Route::controller(DepartmentController::class)->group(function (){
        Route::get('allDepartments', 'pagination');
    });
    Route::controller(EquipmentController::class)->group(function (){
        Route::get('allEquipments', 'pagination');
        Route::get('equipment/changeStatus/{equipment}', 'changeStatus');
    });
    Route::controller(MaintenanceLogsController::class)->group(function (){
        Route::get('allMaintenance', 'pagination');
        Route::get('myMaintenance', 'myMaintenance');
        Route::get('maintenance/{id}/data',  'getData')->name('maintenance.getData');
        Route::post('maintenance/record', 'storeRecord')->name('maintenance.storeRecord');
    });

    Route::resource('role', RoleController::class);
    Route::resource('worker', WorkerController::class);
    Route::resource('department', DepartmentController::class);
    Route::resource('equipment', EquipmentController::class);
    Route::resource('maintenance', MaintenanceLogsController::class);
});
