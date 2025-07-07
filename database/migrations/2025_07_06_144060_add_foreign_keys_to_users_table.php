<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->after('is_superadmin')->constrained('role')->onDelete('set null');
            $table->foreignId('instansi_id')->nullable()->after('role_id')->constrained('instansi')->onDelete('set null');
            $table->foreignId('app_id')->nullable()->after('instansi_id')->constrained('master_app')->onDelete('set null'); // for admin users who manage specific app
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['instansi_id']);
            $table->dropForeign(['app_id']);
            $table->dropColumn(['role_id', 'instansi_id', 'app_id']);
        });
    }
};
