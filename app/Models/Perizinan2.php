<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perizinan2 extends Model
{
    protected $table = 'perizinan_2';
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'kepada',
        'perihal',
        'tanggal_proses',
        'petugas',
        'nip',
        'jabatan',
        'no_pmh',
        'no_keg',
        'tgl_pmh',
        'jenis_pmh',
        'nama_pers',
        'jenis_pers',
        'jenis_keg',
        'nib',
        'npwp',
        'sektor',
        'luas',
        'skala',
        'risiko',
        'kbli',
        'nama_izin',
        'pj_pers',
        'alamat',
        'kab',
        'no_telp',
        'email',
        'modal',
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
        'validator_ke',
        'tgl_validasi'
    ];

    public function validasi()
    {
        return $this->hasOne(Validasi::class, 'perizinan_id'); // perizinan_id di tabel validasi
    }

}
