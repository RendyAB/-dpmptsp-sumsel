<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perizinan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kab_kota_id')->constrained('kab_kota');
            $table->foreignId('sektor_perizinan_id')->constrained('sektor_perizinan');
            $table->enum('jenis_input', ['OSS RBA', 'NON OSS RBA']);
            $table->integer('jumlah');
            $table->tinyInteger('triwulan'); // 1, 2, 3, 4
            $table->integer('tahun');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perizinan');
    }
};
