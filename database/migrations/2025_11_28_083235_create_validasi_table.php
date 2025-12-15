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
        Schema::create('validasi', function (Blueprint $table) {
            $table->id();

            $table->enum('jenis_permohonan', ['permohonan', 'non_permohonan']);
            $table->enum('status', ['menunggu', 'disetujui', 'dikembalikan', 'ditolak'])
                ->default('menunggu');

            // Level validasi aktif (1 = madya_1)
            $table->unsignedTinyInteger('current_level')->default(1);

            // Untuk sistem timer auto-approve
            $table->timestamp('last_action_at')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validasi');
    }
};
