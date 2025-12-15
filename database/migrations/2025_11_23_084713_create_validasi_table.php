<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('validasi', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('id_permohonan');
            $table->enum('jenis_permohonan', ['perizinan', 'non_perizinan']);
            $table->enum('status', ['menunggu', 'disetujui', 'dikembalikan', 'ditolak'])
                ->default('menunggu');
            $table->text('catatan')->nullable();
            $table->integer('id_validator')->nullable(); // FK → users(id)
            $table->integer('urutan_validator')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->timestamp('validated_at')->nullable();

            // Foreign key → users
            $table->foreign('id_validator')
                ->references('id')
                ->on('users_2')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('validasi');
    }
};
