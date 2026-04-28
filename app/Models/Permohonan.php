<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permohonan extends Model
{
    use HasFactory;

    protected $table = 'permohonan';

    protected $fillable = [
        'tanggal_permohonan', 'nama_pemohon', 'alamat', 'nomor_telepon',
        'pekerjaan', 'npwp', 'email',
        'rincian_informasi', 'tujuan_penggunaan',
        // alias ke kolom DB lama
        'jenis_informasi', 'deskripsi_permohonan',
        'foto_ktp', 'berkas_pendukung',
        'status', 'custom_fields_data', 'tanggal_selesai', 'kategori_laporan',
        // kolom lama tetap untuk admin
        'username', 'password', 'perusahaan_instansi', 'jenis_identitas', 'nomor_identitas', 'format_informasi',
        'status_informasi_dikuasai', 'status_informasi_belum_didokumentasikan',
        'bentuk_informasi_salinan', 'jenis_permohonan_salinan', 'alasan_penolakan_text',
        'penolakan_pasal_uu', 'tanggal_pemberitahuan_tertulis', 'tanggal_pemberian_informasi',
        'biaya_salinan', 'cara_pembayaran'
    ];

    protected $casts = [
        'custom_fields_data' => 'array',
        'tanggal_selesai' => 'datetime',
        'tanggal_pemberitahuan_tertulis' => 'date',
        'tanggal_pemberian_informasi' => 'date',
    ];

    public function keberatans()
    {
        return $this->hasMany(Keberatan::class);
    }
}
