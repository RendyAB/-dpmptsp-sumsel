<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('validasi_log', function (Blueprint $table) {
            $table->id();

            $table->foreignId('validasi_id')->constrained('validasi')->onDelete('cascade');
            $table->foreignId('admin_id')->constrained('admin_verifikator')->onDelete('cascade');

            $table->enum('role', ['madya_1', 'madya_2', 'madya_3', 'kabid']);
            $table->enum('status', ['menunggu', 'disetujui', 'dikembalikan', 'ditolak']);
            $table->text('catatan')->nullable();

            $table->timestamp('validated_at')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validasi_log');
    }
};
