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
        Schema::create('master_app', function (Blueprint $table) {
            $table->id();
            $table->string('kode_app')->unique(); // Kode unik aplikasi
            $table->string('nama_app');
            $table->string('deskripsi_app')->nullable();
            $table->string('url_app')->nullable();
            $table->string('logo_app')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('instansi_id')->constrained('instansi')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_app');
    }
};
