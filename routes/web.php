<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\UserController;
use App\Http\Controllers\Panel\RoleController;
use App\Http\Controllers\Panel\AppController as PanelAppController;
use App\Http\Controllers\Panel\InstansiController;
use App\Http\Controllers\Panel\PermissionController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Redirect old routes to new system
Route::get('/home', function () {
    return redirect()->route('client');
})->name('home');

Route::get('/dashboard', function () {
    return redirect()->route('client');
})->name('dashboard');

Route::get('/beranda', function () {
    return redirect()->route('client');
})->name('beranda');

// NEW 2-TIER VIEW SYSTEM

// Tier 1: "Client" - accessible by all authenticated users (default landing page)
Route::middleware(['auth'])->group(function () {
    Route::get('/client', [ClientController::class, 'index'])->name('client');
    Route::get('/client/instansi/{id}', [ClientController::class, 'showInstansi'])->name('client.instansi.show');
});

// Debug route (remove in production)
Route::get('/debug', function () {
    return view('debug');
})->middleware(['auth', 'has.panel.access']);

// Tier 2: "Panel" - only for users with non-default permissions
Route::middleware(['auth', 'has.panel.access'])->prefix('panel')->name('panel.')->group(function () {
    // Main Panel Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Management
    Route::resource('users', UserController::class);

    // Role Management  
    Route::resource('roles', RoleController::class);
    Route::get('roles/{role}/permissions', [RoleController::class, 'permissions'])->name('roles.permissions');
    Route::put('roles/{role}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.updatePermissions');

    // Permission Management
    Route::resource('permissions', PermissionController::class);

    // App Management
    Route::resource('apps', PanelAppController::class);

    // Instansi Management
    Route::resource('instansi', InstansiController::class);
});