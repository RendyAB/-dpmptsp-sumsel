<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NonPerizinan extends Model
{
    protected $table = 'non_perizinan';
    protected $primaryKey = 'id';
    public $timestamps = false; // karena tidak ada updated_at

    protected $fillable = [
        'kepada',
        'perihal',
        'tanggal_proses',
        'petugas',
        'nip',
        'jabatan',
        'no_agenda',
        'no_surat',
        'jenis_izin',
        'no_izin',
        'nama_kapal',
        'nib',
        'id_izin',
        'tgl_pmh',
        'tgl_terima',
        'jenis_pmh',
        'cek_fisik',
        'id_oss',
        'id_proyek',
        'nama_pemilik',
        'no_usaha',
        'tgl_izin',
        'alamat',
        'npwp',
        'nik',
        'jenis_pers',
        'jenis_keg',
        'sektor',
        'skala',
        'risiko',
        'kbli',
        'alamat_lokasi',
        'kab',
        'no_telp',
        'email',
        'investasi',
        'dokumen',
        'jumlah_dok',
        'jenis_dok',
        'no_verif',
        'tgl_verif',
        'dok_verif',
        'status',
        'catatan',
        'tgl_terbit',
        'ket_status',
        'pdf_file',
        'created_at',
    ];

    /**
     * Relasi ke tabel validasi
     * validasi.perizinan_id → non_perizinan.id
     */
    public function validasi()
    {
        return $this->hasOne(Validasi::class, 'perizinan_id');
    }
}
