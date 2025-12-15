<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('non_perizinan', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('kepada', 255);
            $table->string('perihal', 255);
            $table->date('tanggal_proses')->nullable();
            $table->string('petugas', 255);
            $table->string('nip', 50);
            $table->string('jabatan', 255);
            $table->string('no_agenda', 100);
            $table->string('no_surat', 100);
            $table->string('jenis_izin', 150);
            $table->string('no_izin', 100);
            $table->string('nama_kapal', 150)->nullable();
            $table->string('nib', 100);
            $table->string('id_izin', 100)->nullable();
            $table->date('tgl_pmh')->nullable();
            $table->date('tgl_terima')->nullable();
            $table->string('jenis_pmh', 50);
            $table->string('cek_fisik', 100)->nullable();
            $table->string('id_oss', 100)->nullable();
            $table->string('id_proyek', 100)->nullable();
            $table->string('nama_pemilik', 150)->nullable();
            $table->string('no_usaha', 100)->nullable();
            $table->date('tgl_izin')->nullable();
            $table->text('alamat');
            $table->string('npwp', 100)->nullable();
            $table->string('nik', 50)->nullable();
            $table->string('jenis_pers', 100);
            $table->string('jenis_keg', 100);
            $table->string('sektor', 150)->nullable();
            $table->string('skala', 50)->nullable();
            $table->string('risiko', 50)->nullable();
            $table->string('kbli', 255)->nullable();
            $table->text('alamat_lokasi')->nullable();
            $table->string('kab', 150)->nullable();
            $table->string('no_telp', 50)->nullable();
            $table->string('email', 150)->nullable();
            $table->decimal('investasi', 18, 2)->nullable();
            $table->string('dokumen', 50)->nullable();
            $table->string('jumlah_dok', 255)->nullable();
            $table->string('jenis_dok', 255)->nullable();
            $table->string('no_verif', 100)->nullable();
            $table->date('tgl_verif')->nullable();
            $table->string('dok_verif', 255)->nullable();
            $table->enum('status', ['menunggu', 'disetujui', 'dikembalikan', 'ditolak'])->default('menunggu');
            $table->text('catatan')->nullable();
            $table->date('tgl_terbit')->nullable();
            $table->string('ket_status', 255)->nullable();
            $table->string('pdf_file', 255)->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('non_perizinan');
    }
};
