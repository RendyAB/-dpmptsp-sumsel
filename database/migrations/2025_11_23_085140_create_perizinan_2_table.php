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
        Schema::create('perizinan_2', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kepada')->nullable();
            $table->string('perihal')->nullable();
            $table->date('tanggal_proses')->nullable();
            $table->string('petugas')->nullable();
            $table->string('nip', 100)->nullable();
            $table->string('jabatan')->nullable();
            $table->string('no_pmh', 100)->nullable();
            $table->string('no_keg', 100)->nullable();
            $table->date('tgl_pmh')->nullable();
            $table->string('jenis_pmh', 100)->nullable();
            $table->string('nama_pers', 255)->nullable();
            $table->string('jenis_pers', 255)->nullable();
            $table->string('jenis_keg', 255)->nullable();
            $table->string('nib', 100)->nullable();
            $table->string('npwp', 100)->nullable();
            $table->string('sektor', 100)->nullable();
            $table->string('luas', 100)->nullable();
            $table->string('skala', 100)->nullable();
            $table->string('risiko', 100)->nullable();
            $table->string('kbli', 100)->nullable();
            $table->string('nama_izin', 255)->nullable();
            $table->string('pj_pers', 255)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->string('kab', 100)->nullable();
            $table->string('no_telp', 100)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('modal', 100)->nullable();
            $table->string('dokumen', 255)->nullable();
            $table->text('jumlah_dok')->nullable();
            $table->string('jenis_dok', 255)->nullable();
            $table->string('no_verif', 100)->nullable();
            $table->string('tgl_verif', 100)->nullable(); // masih string di database asli
            $table->string('dok_verif', 255)->nullable();
            $table->enum('status', ['menunggu', 'disetujui', 'dikembalikan', 'ditolak'])->default('menunggu');
            $table->text('catatan')->nullable();
            $table->date('tgl_terbit')->nullable();
            $table->text('ket_status')->nullable();
            $table->string('pdf_file', 255)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->integer('validator_ke')->default(0);
            $table->dateTime('tgl_validasi')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perizinan_2');
    }
};
