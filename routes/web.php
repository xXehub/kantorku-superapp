<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\MasterDashboardController;
use App\Http\Controllers\Master\RoleController;
use App\Http\Controllers\Master\UserController;
use App\Http\Controllers\Master\MasterAppController;
use App\Http\Controllers\Master\InstansiController;
use App\Http\Controllers\Master\PermissionController;
use App\Http\Controllers\App\AppDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function () {
    return redirect()->route('dashboard');
})->name('home');

// Global Dashboard - accessible by all authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Master Panel - only for superadmin
Route::middleware(['auth'])->prefix('master')->name('master.')->group(function () {
    Route::get('/dashboard', [MasterDashboardController::class, 'index'])->name('dashboard');

    // Role management
    Route::resource('roles', RoleController::class);
    Route::get('roles/{role}/permissions', [RoleController::class, 'permissions'])->name('roles.permissions');
    Route::put('roles/{role}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.updatePermissions');

    // Permission management
    Route::resource('permissions', PermissionController::class);

    // User management  
    Route::resource('users', UserController::class);
    Route::get('users/{user}/assignments', [UserController::class, 'assignments'])->name('users.assignments');
    Route::post('users/{user}/assignments', [UserController::class, 'addAssignment'])->name('users.addAssignment');
    Route::delete('users/{user}/assignments/{userApp}', [UserController::class, 'removeAssignment'])->name('users.removeAssignment');

    // Master App management
    Route::resource('master-app', MasterAppController::class);

    // Instansi management
    Route::resource('instansi', InstansiController::class);
});

// Dynamic Instansi App Routes - {instansi}/{app}/admin/*
Route::middleware(['auth'])->group(function () {
    Route::get('/{instansi}/{app}/admin/dashboard', [AppDashboardController::class, 'index'])->name('app.dashboard');
    Route::get('/{instansi}/{app}/admin', function ($instansi, $app) {
        return redirect()->route('app.dashboard', [$instansi, $app]);
    });
});