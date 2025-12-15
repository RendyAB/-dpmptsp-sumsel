<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('investasi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kab_kota_id')->constrained('kab_kota')->onDelete('cascade');
            $table->foreignId('kategori_sektor_id')->constrained('kategori_sektor')->onDelete('cascade');
            $table->foreignId('sektor_investasi_id')->constrained('sektor_investasi')->onDelete('cascade');

            // PMA
            $table->integer('lkpm_pma')->default(0);
            $table->decimal('realisasi_pma', 20, 2)->default(0);
            $table->integer('tki_pma')->default(0);
            $table->integer('tka_pma')->default(0);

            // PMDN
            $table->integer('lkpm_pmdn')->default(0);
            $table->decimal('realisasi_pmdn', 20, 2)->default(0);
            $table->integer('tki_pmdn')->default(0);
            $table->integer('tka_pmdn')->default(0);

            // Informasi waktu
            $table->integer('tahun');
            $table->tinyInteger('triwulan'); // 1-4

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investasi');
    }
};
