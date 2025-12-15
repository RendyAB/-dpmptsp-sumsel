<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users_2', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('id_petugas')->nullable();
            $table->string('username', 50)->unique();
            $table->string('password', 255);
            $table->enum('role', ['petugas', 'ahli_madya', 'kepala_bidang', 'admin']);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->integer('created_by')->nullable();
            $table->integer('level_validator')->nullable();

            // Foreign key → identitas_petugas
            $table->foreign('id_petugas')
                ->references('id_petugas')
                ->on('identitas_petugas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users_2');
    }
};
