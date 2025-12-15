<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sektor_investasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_sektor_id')->constrained('kategori_sektor')->onDelete('cascade');
            $table->string('nama'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sektor_investasi');
    }
};
