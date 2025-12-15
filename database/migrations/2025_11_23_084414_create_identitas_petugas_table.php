<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('identitas_petugas', function (Blueprint $table) {
            $table->integer('id_petugas')->autoIncrement();
            $table->string('petugas', 255)->nullable();
            $table->string('nip', 100);
            $table->string('jabatan', 255);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('identitas_petugas');
    }
};
