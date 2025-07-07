<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\AppController;

Route::get('/debug-app-edit/{app}', function(\App\Models\MasterApp $app) {
    $user = auth()->user();
    
    echo "<h3>Debug App Edit Access</h3>";
    echo "<p><strong>User ID:</strong> " . $user->id . "</p>";
    echo "<p><strong>is_superadmin (raw):</strong> " . ($user->is_superadmin ? 'true' : 'false') . "</p>";
    echo "<p><strong>isSuperAdmin() method:</strong> " . ($user->isSuperAdmin() ? 'true' : 'false') . "</p>";
    echo "<p><strong>isAdmin() method:</strong> " . ($user->isAdmin() ? 'true' : 'false') . "</p>";
    
    echo "<h4>App Details:</h4>";
    echo "<p><strong>App ID:</strong> " . $app->id . "</p>";
    echo "<p><strong>App Name:</strong> " . $app->nama_app . "</p>";
    echo "<p><strong>App Instansi ID:</strong> " . $app->instansi_id . "</p>";
    
    echo "<h4>Permission Checks:</h4>";
    
    // Test 1: Basic superadmin/admin check
    $check1 = !$user->isSuperAdmin() && !$user->isAdmin();
    echo "<p><strong>Check 1 (!isSuperAdmin() && !isAdmin()):</strong> " . ($check1 ? 'FAIL - Would abort' : 'PASS') . "</p>";
    
    // Test 2: Admin instansi check
    $check2 = $user->isAdmin() && $app->instansi_id !== $user->instansi_id;
    echo "<p><strong>Check 2 (isAdmin() && app.instansi_id !== user.instansi_id):</strong> " . ($check2 ? 'FAIL - Would abort' : 'PASS') . "</p>";
    
    if ($check1 || $check2) {
        echo "<p style='color: red;'><strong>ACCESS WOULD BE DENIED!</strong></p>";
    } else {
        echo "<p style='color: green;'><strong>ACCESS SHOULD BE ALLOWED!</strong></p>";
    }
    
    // Try to access the actual controller method
    try {
        $controller = new AppController();
        echo "<h4>Trying actual controller method...</h4>";
        echo "<p>This would normally redirect to the edit view.</p>";
    } catch (Exception $e) {
        echo "<p style='color: red;'><strong>Controller Error:</strong> " . $e->getMessage() . "</p>";
    }
    
})->middleware(['auth', 'has.panel.access']);
