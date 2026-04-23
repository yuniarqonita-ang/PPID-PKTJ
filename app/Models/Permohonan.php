<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permohonan extends Model
{
    use HasFactory;

    protected $table = 'permohonan';

    protected $fillable = [
        'username', 'email', 'password', 'nama_pemohon', 'alamat', 'nomor_telepon',
        'pekerjaan', 'perusahaan_instansi', 'jenis_identitas', 'nomor_identitas',
        'foto_ktp', 'jenis_informasi', 'deskripsi_permohonan', 'format_informasi',
        'berkas_pendukung', 'status', 'custom_fields_data', 'tanggal_selesai', 'kategori_laporan',
        'npwp', 'status_informasi_dikuasai', 'status_informasi_belum_didokumentasikan',
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
