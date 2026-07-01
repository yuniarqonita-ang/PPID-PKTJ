<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('dashboards')) {
            $key = 'sop_pendokumentasian_isi_konten';
            
            $existing = DB::table('dashboards')->where('key', $key)->first();
            
            $sopHtml = '<p>Berikut adalah beberapa dokumen Standar Operasional Prosedur (SOP) internal yang terdokumentasi di lingkungan PKTJ:</p>
<ul class="list-group list-group-flush shadow-sm rounded-4 border mb-4">
    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
        <div class="d-flex align-items-center gap-2">
            <i class="fa-solid fa-file-pdf text-danger fs-4"></i>
            <div>
                <strong class="text-slate-800" style="color: #334155; font-weight: 700; display: block; margin-bottom: 2px;">SOP Pelaporan Kegiatan (SPI)</strong>
                <div class="text-xs text-slate-500" style="font-size: 12px; color: #64748b;">Prosedur pelaporan kegiatan internal oleh Satuan Pemeriksaan Intern</div>
            </div>
        </div>
        <a href="https://drive.google.com/file/d/1rjOLvAAZi4Df5JbYUI7ehqkIA0SxJmp7/view" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">Lihat Dokumen</a>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
        <div class="d-flex align-items-center gap-2">
            <i class="fa-solid fa-file-pdf text-danger fs-4"></i>
            <div>
                <strong class="text-slate-800" style="color: #334155; font-weight: 700; display: block; margin-bottom: 2px;">SOP Audit Kinerja (SPI)</strong>
                <div class="text-xs text-slate-500" style="font-size: 12px; color: #64748b;">Prosedur audit kinerja operasional di lingkungan PKTJ</div>
            </div>
        </div>
        <a href="https://drive.google.com/file/d/1MrFh943kq-nfi5KogndwEfsBw6ePkP74/view" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">Lihat Dokumen</a>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
        <div class="d-flex align-items-center gap-2">
            <i class="fa-solid fa-file-pdf text-danger fs-4"></i>
            <div>
                <strong class="text-slate-800" style="color: #334155; font-weight: 700; display: block; margin-bottom: 2px;">SOP Pengusulan Diklat (SPI)</strong>
                <div class="text-xs text-slate-500" style="font-size: 12px; color: #64748b;">Prosedur pengusulan program pendidikan dan pelatihan</div>
            </div>
        </div>
        <a href="https://drive.google.com/file/d/18MVB1TaWjESUO-ngOYIFUB6hqks5A6Ub/view" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">Lihat Dokumen</a>
    </li>
</ul>';

            if ($existing) {
                $currentVal = $existing->value;
                
                // If it is empty or does not contain these SOPs, update it
                if (empty($currentVal) || strpos($currentVal, 'SOP Pelaporan Kegiatan') === false) {
                    if (empty($currentVal) || trim($currentVal) == '<p>&nbsp;</p>' || strlen($currentVal) < 50) {
                        $newVal = $sopHtml;
                    } else {
                        // Append to current content
                        $newVal = $currentVal . '<br>' . $sopHtml;
                    }
                    
                    DB::table('dashboards')
                        ->where('key', $key)
                        ->update([
                            'value' => $newVal,
                            'updated_at' => now(),
                        ]);
                }
            } else {
                DB::table('dashboards')->insert([
                    'key' => $key,
                    'value' => $sopHtml,
                    'type' => 'text',
                    'description' => 'Teks dinamis untuk sop_pendokumentasian konten',
                    'aktif' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No loss
    }
};
