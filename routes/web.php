<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\UserController;
use App\Http\Controllers\Panel\RoleController;
use App\Http\Controllers\Panel\AppController as PanelAppController;
use App\Http\Controllers\Panel\InstansiController;
use App\Http\Controllers\Panel\PermissionController;
use App\Http\Controllers\Panel\KategoriAppController;
use App\Http\Controllers\ModalAlertExampleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Minimal web routes - most functionality is in API routes
*/

// Main homepage redirect - always redirect / to /beranda
Route::get('/', function () {
    return redirect('/beranda');
});

// Main homepage - accessible to everyone (guests and authenticated users)
Route::get('/beranda', [ClientController::class, 'index'])->name('client');

Auth::routes();

// debug route untuk api testing doang (remove in production)
Route::get('/debug-api', function () {
    return view('debug-api');
})->name('debug.api');

// quick login (remove in production)
Route::get('/dev-login', function () {
    $user = App\Models\User::first();
    if ($user) {
        Auth::login($user);
        return redirect('/beranda')->with('success', 'Logged in as: ' . $user->name . '. Test API with token authentication.');
    }
    return redirect('/login')->with('error', 'No users found. Please register first.');
})->name('dev.login');

// Tier 1: "Client" - pages that require authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/beranda/aplikasi', [ClientController::class, 'aplikasi'])->name('client.aplikasi');
    Route::get('/beranda/instansi/{id}', [ClientController::class, 'showInstansi'])->name('client.instansi.show');
});

// Tier 2: "Panel" - untuk user non-default permissions (WEB INTERFACE)
// Note: API endpoints di /api/panel/* pake token auth
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

    // Kategori App Management
    Route::resource('kategori', KategoriAppController::class);
});

// Modal Alert Examples (for development/testing)
Route::middleware(['auth'])->prefix('examples')->name('example.')->group(function () {
    Route::get('/modal-alert', [ModalAlertExampleController::class, 'index'])->name('modal-alert');
    Route::get('/modal-alert/success', [ModalAlertExampleController::class, 'success'])->name('success');
    Route::get('/modal-alert/error', [ModalAlertExampleController::class, 'error'])->name('error');
    Route::get('/modal-alert/warning', [ModalAlertExampleController::class, 'warning'])->name('warning');
    Route::get('/modal-alert/info', [ModalAlertExampleController::class, 'info'])->name('info');
    Route::get('/modal-alert/custom', [ModalAlertExampleController::class, 'confirmation'])->name('custom');
    Route::get('/modal-alert/confirmation', [ModalAlertExampleController::class, 'confirmation'])->name('confirmation');
    Route::post('/modal-alert/validate', [ModalAlertExampleController::class, 'submitForm'])->name('validate');
    Route::post('/modal-alert/submit-form', [ModalAlertExampleController::class, 'submitForm'])->name('submit-form');
    Route::post('/modal-alert/bulk-delete', [ModalAlertExampleController::class, 'bulkDelete'])->name('bulk-delete');
    Route::post('/modal-alert/confirm-bulk-delete', [ModalAlertExampleController::class, 'confirmBulkDelete'])->name('confirm-bulk-delete');
});