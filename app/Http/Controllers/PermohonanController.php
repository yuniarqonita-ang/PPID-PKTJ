<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use App\Models\Dashboard;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PermohonanController extends Controller
{
    private function getFormSchema()
    {
        $schemaSetting = Dashboard::where('key', 'permohonan_form_schema')->first();
        if ($schemaSetting && $schemaSetting->value) {
            $data = json_decode($schemaSetting->value, true);
            
            // Handle old format (array of fields)
            if (is_array($data) && array_values($data) === $data) {
                return [
                    'section_title' => 'INFORMASI TAMBAHAN',
                    'fields' => $data
                ];
            }
            
            // New format (object with section_title and fields)
            return array_merge([
                'section_title' => 'INFORMASI TAMBAHAN',
                'fields' => []
            ], (array)$data);
        }
        
        return [
            'section_title' => 'INFORMASI TAMBAHAN',
            'fields' => []
        ];
    }

    public function form()
    {
        $schema = $this->getFormSchema();
        $sectionTitle = $schema['section_title'];
        $customFields = $schema['fields'];
        $settings = Dashboard::pluck('value', 'key')->toArray();
        return view('permohonan.form', compact('customFields', 'sectionTitle', 'settings'));
    }

    public function adminForm()
    {
        $schema = $this->getFormSchema();
        $sectionTitle = $schema['section_title'];
        $customFields = $schema['fields'];
        $settings = Dashboard::pluck('value', 'key')->toArray();
        return view('admin.permohonan.form', compact('customFields', 'sectionTitle', 'settings'));
    }

    public function saveForm(Request $request)
    {
        // 1. Save Schema if provided
        if ($request->has('fields')) {
            $schema = [
                'section_title' => $request->input('section_title', 'INFORMASI TAMBAHAN'),
                'fields' => $request->input('fields', [])
            ];
            
            Dashboard::updateOrCreate(
                ['key' => 'permohonan_form_schema'],
                [
                    'value' => json_encode($schema),
                    'type' => 'json',
                    'description' => 'Skema Dynamic Form Permohonan',
                    'aktif' => true
                ]
            );
        }

        // 2. Save any other settings passed in the request
        $exclude = ['_token', 'section_title', 'fields', 'core_settings'];
        $allData = $request->all();

        foreach ($allData as $key => $value) {
            if (!in_array($key, $exclude) && $value !== null) {
                Dashboard::updateOrCreate(
                    ['key' => $key],
                    [
                        'value' => is_array($value) ? json_encode($value) : $value,
                        'type' => is_array($value) ? 'json' : 'text',
                        'description' => 'Pengaturan Dinamis Permohonan',
                        'aktif' => true
                    ]
                );
            }
        }

        // 3. Handle special nested core_settings if they exist
        if ($request->has('core_settings')) {
            foreach ($request->input('core_settings') as $key => $value) {
                Dashboard::updateOrCreate(
                    ['key' => $key],
                    [
                        'value' => $value,
                        'type' => 'text',
                        'description' => 'Konfigurasi Inti Permohonan',
                        'aktif' => true
                    ]
                );
            }
        }

        return response()->json(['success' => true]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_permohonan'    => 'required|date',
            'nama_pemohon'          => 'required|string|max:255',
            'alamat'                => 'required|string',
            'nomor_telepon'         => 'required|string|max:255',
            'pekerjaan'             => 'required|string|max:100',
            'npwp'                  => 'required|string|max:30',
            'jenis_pemohon'         => 'required|in:Perorangan,Organisasi',
            'rincian_informasi'     => 'required|string',
            'tujuan_penggunaan'     => 'required|string',
            'jenis_permohonan_salinan' => 'required|string',
            'cara_mendapatkan'      => 'required|string',
            'petugas_penerima'      => 'required|string|max:255',
            'foto_ktp'              => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'berkas_pendukung'      => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        // Upload files
        $fotoKtp = $request->file('foto_ktp')->store('permohonan/ktp', 'public');
        $berkasPendukung = $request->hasFile('berkas_pendukung')
            ? $request->file('berkas_pendukung')->store('permohonan/berkas', 'public')
            : null;

        // Map data tambahan ke JSON agar tidak perlu migrasi database besar
        $customFieldsData = [
            'jenis_pemohon'      => $validated['jenis_pemohon'],
            'cara_mendapatkan'   => $validated['cara_mendapatkan'],
            'petugas_penerima'   => $validated['petugas_penerima'],
            'email_or_phone'     => $validated['nomor_telepon'],
        ];

        Permohonan::create([
            'tanggal_permohonan'                      => $validated['tanggal_permohonan'],
            'nama_pemohon'                            => $validated['nama_pemohon'],
            'alamat'                                  => $validated['alamat'],
            'pekerjaan'                               => $validated['pekerjaan'],
            'npwp'                                    => $validated['npwp'],
            'nomor_telepon'                           => $validated['nomor_telepon'],
            'email'                                   => $validated['nomor_telepon'], // Map to nomor_telepon as form uses shared field
            'deskripsi_permohonan'                    => $validated['rincian_informasi'],
            'jenis_informasi'                         => $validated['tujuan_penggunaan'],
            'foto_ktp'                                => $fotoKtp,
            'berkas_pendukung'                        => $berkasPendukung,
            'status'                                  => 'pending',
            'custom_fields_data'                      => $customFieldsData,
            'jenis_permohonan_salinan'                => $validated['jenis_permohonan_salinan'],
            // Default values for fields not in form
            'status_informasi_dikuasai'               => 1,
            'status_informasi_belum_didokumentasikan' => 0,
            'bentuk_informasi_salinan'                => $validated['jenis_permohonan_salinan'] == 'Mendapatkan salinan' ? 'Softcopy' : 'N/A',
        ]);

        return redirect()->route('permohonan.form')->with('success', 'Permohonan informasi Anda berhasil dikirimkan! Silakan tunggu konfirmasi dari pihak PPID PKTJ.');
    }

    public function index(Request $request)
    {
        $query = Permohonan::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date . " 00:00:00", $request->end_date . " 23:59:59"]);
        }

        $permohonan = $query->latest()->paginate(10)->withQueryString();
        return view('admin.permohonan.submissions', compact('permohonan'));
    }

    /**
     * Admin: Export Register Permohonan to Excel (XLS - HTML Table format)
     */
    public function exportExcelRegister(Request $request)
    {
        $query = Permohonan::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date . " 00:00:00", $request->end_date . " 23:59:59"]);
        }

        $permohonan = $query->latest()->get();
        $settings   = \App\Models\Dashboard::pluck('value', 'key')->toArray();
        $namaLembaga = $settings['ppid_nama'] ?? 'POLITEKNIK KESELAMATAN TRANSPORTASI JALAN';
        $filename   = "register_permohonan_" . date('Y-m-d') . ".xls";

        $html = '<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
  body { font-family: Arial, sans-serif; font-size: 9pt; }
  table { border-collapse: collapse; width: 100%; }
  th, td { border: 1px solid #000; padding: 3px 5px; text-align: center; vertical-align: middle; }
  th { background-color: #f2f2f2; font-weight: bold; }
  .title-row td { border: none; font-weight: bold; font-size: 11pt; text-align: center; padding: 8px 0; }
  .subtitle-row td { border: none; font-weight: bold; font-size: 10pt; text-align: center; padding: 4px 0; }
  td.text-left { text-align: left; }
</style>
</head>
<body>
<table>
  <tr class="subtitle-row"><td colspan="23">REGISTER PERMOHONAN INFORMASI PUBLIK</td></tr>
  <tr class="subtitle-row"><td colspan="23">' . strtoupper($namaLembaga) . '</td></tr>
  <tr><td colspan="23"></td></tr>
  <!-- Header Row 1 -->
  <tr>
    <th rowspan="3">No</th>
    <th rowspan="3">Tanggal</th>
    <th rowspan="3">Nama</th>
    <th rowspan="3">Alamat</th>
    <th rowspan="3">Pekerjaan</th>
    <th rowspan="3">NPWP</th>
    <th rowspan="3">No Telpon</th>
    <th rowspan="3">E-mail</th>
    <th rowspan="3">Rincian Informasi yang dibutuhkan</th>
    <th rowspan="3">Tujuan Penggunaan Informasi</th>
    <th colspan="3">Status Informasi</th>
    <th colspan="2">Bentuk Informasi yang dikuasai</th>
    <th colspan="2">Jenis Permohonan</th>
    <th rowspan="3">Keputusan</th>
    <th rowspan="3">Alasan Penolakan</th>
    <th colspan="2">Hari dan Tanggal</th>
    <th colspan="2">Biaya &amp; Cara Pembayaran</th>
  </tr>
  <!-- Header Row 2 -->
  <tr>
    <th colspan="2">Dibawah penguasaan</th>
    <th rowspan="2">Belum didokumentasikan</th>
    <th rowspan="2">Softcopy</th>
    <th rowspan="2">Hardcopy</th>
    <th rowspan="2">Melihat/ Mendengar</th>
    <th rowspan="2">Meminta salinan</th>
    <th rowspan="2">Pemberitahuan tertulis</th>
    <th rowspan="2">Pemberian Informasi</th>
    <th rowspan="2">Biaya</th>
    <th rowspan="2">Cara</th>
  </tr>
  <!-- Header Row 3 -->
  <tr>
    <th>Ya</th>
    <th>Tidak</th>
  </tr>';

        foreach ($permohonan as $index => $item) {
            $statusLabel = match($item->status) {
                'selesai'  => 'Dipenuhi',
                'ditolak'  => 'Ditolak',
                'diproses' => 'Diproses',
                default    => 'Pending'
            };
            $html .= '<tr>
    <td>' . ($index + 1) . '</td>
    <td>' . ($item->tanggal_permohonan
                ? \Carbon\Carbon::parse($item->tanggal_permohonan)->format('d/m/Y')
                : $item->created_at->format('d/m/Y')) . '</td>
    <td class="text-left">' . e($item->nama_pemohon) . '</td>
    <td class="text-left">' . e($item->alamat) . '</td>
    <td>' . e($item->pekerjaan) . '</td>
    <td>' . e($item->npwp) . '</td>
    <td>' . e($item->nomor_telepon) . '</td>
    <td>' . e($item->email) . '</td>
    <td class="text-left">' . e($item->deskripsi_permohonan) . '</td>
    <td class="text-left">' . e($item->jenis_informasi) . '</td>
    <td>' . ($item->status_informasi_dikuasai ? '✓' : '') . '</td>
    <td>' . (!$item->status_informasi_dikuasai ? '✓' : '') . '</td>
    <td>' . ($item->status_informasi_belum_didokumentasikan ? '✓' : '') . '</td>
    <td>' . ($item->bentuk_informasi_salinan == 'Softcopy' ? '✓' : '') . '</td>
    <td>' . ($item->bentuk_informasi_salinan == 'Hardcopy' ? '✓' : '') . '</td>
    <td>' . ($item->jenis_permohonan_salinan == 'Melihat' ? '✓' : '') . '</td>
    <td>' . ($item->jenis_permohonan_salinan == 'Meminta Salinan' || $item->jenis_permohonan_salinan == 'Mendapatkan salinan' ? '✓' : '') . '</td>
    <td>' . $statusLabel . '</td>
    <td class="text-left">' . e($item->alasan_penolakan_text ?? '') . '</td>
    <td>' . ($item->tanggal_pemberitahuan_tertulis ? \Carbon\Carbon::parse($item->tanggal_pemberitahuan_tertulis)->format('d/m/Y') : '') . '</td>
    <td>' . ($item->tanggal_pemberian_informasi ? \Carbon\Carbon::parse($item->tanggal_pemberian_informasi)->format('d/m/Y') : '') . '</td>
    <td>' . e($item->biaya_salinan ?? '') . '</td>
    <td>' . e($item->cara_pembayaran ?? '') . '</td>
  </tr>';
        }

        $html .= '</table></body></html>';

        return response($html)
            ->header('Content-Type', 'application/vnd.ms-excel; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->header('Cache-Control', 'max-age=0');
    }

    /**
     * Admin: Export Register Permohonan to Excel (Alias)
     */
    public function exportExcel(Request $request)
    {
        return $this->exportExcelRegister($request);
    }

    /**
     * Admin: Export Register Permohonan to CSV
     */
    public function exportCsv(Request $request)
    {
        $query = Permohonan::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date . " 00:00:00", $request->end_date . " 23:59:59"]);
        }

        $permohonan = $query->latest()->get();
        $filename   = "register_permohonan_" . date('Y-m-d') . ".csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function() use ($permohonan) {
            $file = fopen('php://output', 'w');
            fputs($file, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM for UTF-8 compatibility
            
            fputcsv($file, [
                'ID', 'Tanggal', 'Nama Pemohon', 'Alamat', 'Pekerjaan', 'NPWP', 'No Telepon', 'Email', 
                'Rincian Informasi', 'Tujuan Penggunaan', 'Status'
            ]);

            foreach ($permohonan as $item) {
                fputcsv($file, [
                    $item->id,
                    $item->tanggal_permohonan ?: $item->created_at->format('Y-m-d'),
                    $item->nama_pemohon,
                    $item->alamat,
                    $item->pekerjaan,
                    $item->npwp,
                    $item->nomor_telepon,
                    $item->email,
                    $item->deskripsi_permohonan,
                    $item->jenis_informasi,
                    strtoupper($item->status)
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Admin: Export Rejection Decision to Word (.doc)
     */
    public function exportWordReject($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        $settings = Dashboard::pluck('value', 'key')->toArray();

        $header = "
            <html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'>
            <head><meta charset='utf-8'><title>SK Penolakan Permohonan</title></head>
            <body>
        ";
        $footer = "</body></html>";

        $content = view('admin.reports.templates.sk_penolakan', compact('permohonan', 'settings'))->render();

        $filename = "SK_Penolakan_" . $permohonan->id . ".doc";

        return response($header . $content . $footer)
            ->header('Content-Type', 'application/msword')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    /**
     * Download document (if exists)
     */
    public function downloadDocument($id)
    {
        $permohonan = Permohonan::find($id);
        
        if (!$permohonan) {
            abort(404);
        }

        // Check if there's a document associated with this permohonan
        // This would depend on your database structure
        return response()->json(['message' => 'Document download feature coming soon']);
    }

    public function show(Permohonan $permohonan)
    {
        return view('admin.permohonan.show', compact('permohonan'));
    }

    public function edit(Permohonan $permohonan)
    {
        return view('admin.permohonan.edit', compact('permohonan'));
    }

    public function update(Request $request, Permohonan $permohonan)
    {
        $updateData = [
            'status'           => $request->input('status', $permohonan->status),
            'kategori_laporan' => $request->input('kategori_laporan', $permohonan->kategori_laporan),
        ];

        if ($request->filled('tanggal_selesai')) {
            $updateData['tanggal_selesai'] = $request->tanggal_selesai;
        }

        if ($request->filled('alasan_penolakan_text')) {
            $updateData['alasan_penolakan_text'] = $request->alasan_penolakan_text;
        }

        if ($request->filled('penolakan_pasal_uu')) {
            $updateData['penolakan_pasal_uu'] = $request->penolakan_pasal_uu;
        }

        // Jika status selesai dan tanggal selesai belum ada, set hari ini
        if ($updateData['status'] === 'selesai' && empty($updateData['tanggal_selesai'])) {
            $updateData['tanggal_selesai'] = now()->format('Y-m-d');
        }

        $permohonan->update($updateData);

        return redirect()->route('admin.permohonan.show', $permohonan->id)
            ->with('success', 'Status permohonan berhasil diperbarui.');
    }

    public function report(Request $request)
    {
        $periodeType = $request->input('periode_type', 'bulanan');
        $tahun       = $request->input('tahun', date('Y'));
        $bulan       = $request->input('bulan', date('m'));

        $query = Permohonan::query();

        if ($periodeType === 'tahunan') {
            $query->whereYear('tanggal_permohonan', $tahun)
                  ->orWhereYear('created_at', $tahun);
        } else {
            $query->where(function ($q) use ($tahun, $bulan) {
                $q->whereYear('tanggal_permohonan', $tahun)->whereMonth('tanggal_permohonan', $bulan);
            })->orWhere(function ($q) use ($tahun, $bulan) {
                $q->whereYear('created_at', $tahun)->whereMonth('created_at', $bulan);
            });
        }

        $submissions = $query->orderBy('tanggal_permohonan', 'asc')->get();
        $settings    = Dashboard::pluck('value', 'key')->toArray();

        return view('admin.permohonan.report', compact('submissions', 'periodeType', 'tahun', 'bulan', 'settings'));
    }

    public function exportReport(Request $request)
    {
        $periodeType = $request->input('periode_type', 'bulanan');
        $tahun       = $request->input('tahun', date('Y'));
        $bulan       = $request->input('bulan', date('m'));

        $query = Permohonan::query();

        if ($periodeType === 'tahunan') {
            $query->whereYear('tanggal_permohonan', $tahun)
                  ->orWhereYear('created_at', $tahun);
        } else {
            $query->where(function ($q) use ($tahun, $bulan) {
                $q->whereYear('tanggal_permohonan', $tahun)->whereMonth('tanggal_permohonan', $bulan);
            })->orWhere(function ($q) use ($tahun, $bulan) {
                $q->whereYear('created_at', $tahun)->whereMonth('created_at', $bulan);
            });
        }

        $submissions = $query->orderBy('tanggal_permohonan', 'asc')->get();
        $settings    = Dashboard::pluck('value', 'key')->toArray();

        $ppid_name    = $settings['report_ppid_name'] ?? '..........................';;
        $ppid_nip     = $settings['report_ppid_nip'] ?? '..........................';;
        $namaLembaga  = $settings['ppid_nama'] ?? 'POLITEKNIK KESELAMATAN TRANSPORTASI JALAN';

        $bulanNamaMap = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni',
                         '07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];

        $periodeLabel = $periodeType === 'tahunan'
            ? "Tahun {$tahun}"
            : ($bulanNamaMap[str_pad($bulan, 2, '0', STR_PAD_LEFT)] ?? $bulan) . " {$tahun}";

        $filename = "Laporan_Pelayanan_PPID_{$periodeLabel}.xls";

        $html = '<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
  body { font-family: Arial, sans-serif; font-size: 9pt; }
  table { border-collapse: collapse; width: 100%; }
  th, td { border: 1px solid #000; padding: 3px 6px; text-align: center; vertical-align: middle; }
  th { background-color: #dce6f1; font-weight: bold; }
  .title-row td { border: none; font-weight: bold; font-size: 11pt; text-align: center; padding: 6px 0; }
  .subtitle-row td { border: none; font-weight: bold; font-size: 10pt; text-align: center; padding: 3px 0; }
  td.text-left { text-align: left; }
  .sign-table { border: none; width: auto; margin-top: 20px; margin-left: auto; }
  .sign-table td { border: none; text-align: center; padding: 2px 15px; }
</style>
</head>
<body>
<table>
  <tr class="title-row"><td colspan="15">LAPORAN PEMOHON INFORMASI PPID PELAKSANA UPT ' . strtoupper($namaLembaga) . ' TAHUN ' . $tahun . '</td></tr>
  <tr class="subtitle-row"><td colspan="15">LAPORAN PELAYANAN INFORMASI PUBLIK ' . strtoupper($periodeLabel) . '</td></tr>
  <tr><td colspan="15"></td></tr>
  <tr>
    <th rowspan="2">NO</th>
    <th rowspan="2">BULAN</th>
    <th rowspan="2">TANGGAL PERMOHONAN INFORMASI</th>
    <th rowspan="2">NAMA PEMOHON INFORMASI</th>
    <th rowspan="2">ASAL</th>
    <th rowspan="2">RINCIAN INFORMASI YANG DIBUTUHKAN</th>
    <th rowspan="2">KETERANGAN<br>(Dipenuhi/Ditolak/Proses)</th>
    <th rowspan="2">METODE PELAYANAN INFORMASI<br>(Website/Medsos/Ruang PPID)</th>
    <th colspan="2">WAKTU PENYELESAIAN</th>
    <th rowspan="2">ALASAN PENOLAKAN</th>
  </tr>
  <tr>
    <th>JAM</th>
    <th>MENIT</th>
  </tr>';

        $prevBulan = '';
        $noBulan   = 0;

        foreach ($submissions as $index => $item) {
            $tglMinta   = $item->tanggal_permohonan ?? $item->created_at;
            $tglSelesai = $item->tanggal_selesai;
            $bulanKey   = \Carbon\Carbon::parse($tglMinta)->format('m');
            $bulanNama  = $bulanNamaMap[$bulanKey] ?? '';
            $menit      = $tglSelesai ? \Carbon\Carbon::parse($tglMinta)->diffInMinutes(\Carbon\Carbon::parse($tglSelesai)) : '';
            $jam        = ($menit !== '') ? floor($menit / 60) : '';
            $menitSisa  = ($menit !== '') ? ($menit % 60) : '';
            $statusLabel = match($item->status) {
                'selesai'  => 'Dipenuhi',
                'ditolak'  => 'Ditolak',
                'diproses' => 'Diproses',
                default    => 'Pending'
            };

            if ($bulanNama !== $prevBulan) {
                $noBulan++;
                $prevBulan = $bulanNama;
                $bulanCell = '<td>' . $noBulan . ' ' . $bulanNama . '</td>';
            } else {
                $bulanCell = '<td></td>';
            }

            $html .= '<tr>
    <td>' . ($index + 1) . '</td>
    ' . $bulanCell . '
    <td>' . \Carbon\Carbon::parse($tglMinta)->format('d/m/Y') . '</td>
    <td class="text-left">' . e($item->nama_pemohon) . '</td>
    <td>' . e($item->perusahaan_instansi ?? $item->alamat) . '</td>
    <td class="text-left">' . e($item->deskripsi_permohonan) . '</td>
    <td>' . $statusLabel . '</td>
    <td>' . e($item->jenis_permohonan_salinan ?? ($item->bentuk_informasi_salinan ?? 'Media Sosial')) . '</td>
    <td>' . $jam . '</td>
    <td>' . $menitSisa . '</td>
    <td class="text-left">' . e($item->alasan_penolakan_text ?? '') . '</td>
  </tr>';
        }

        $html .= '<tr><td colspan="15"></td></tr></table>';

        // Tanda tangan
        $html .= '<br><table style="border:none; width:100%;">
  <tr>
    <td style="border:none; width:70%;"></td>
    <td style="border:none; text-align:center; width:30%;">Tegal, ' . date('d F Y') . '</td>
  </tr>
  <tr>
    <td></td>
    <td style="border:none; text-align:center;">PPID ' . strtoupper($namaLembaga) . '</td>
  </tr>
  <tr><td colspan="2" style="height:60px; border:none;"></td></tr>
  <tr>
    <td></td>
    <td style="border:none; text-align:center;"><strong>' . e($ppid_name) . '</strong></td>
  </tr>
  <tr>
    <td></td>
    <td style="border:none; text-align:center;">NIP. ' . e($ppid_nip) . '</td>
  </tr>
</table>
</body></html>';

        $bom = "\xEF\xBB\xBF";

        return response($bom . $html)
            ->header('Content-Type', 'application/vnd.ms-excel; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->header('Cache-Control', 'max-age=0');
    }

    public function exportReportWord(Request $request)
    {
        $startDate = $request->input('start_date', date('Y-m-01'));
        $endDate = $request->input('end_date', date('Y-m-t'));

        $submissions = Permohonan::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->orderBy('created_at', 'asc')
            ->get();

        $settings = Dashboard::pluck('value', 'key')->toArray();

        $ppid_name = $settings['report_ppid_name'] ?? '..........................';
        $ppid_nip = $settings['report_ppid_nip'] ?? '..........................';
        $menteri_name = $settings['report_menteri_name'] ?? 'BUDI KARYA SUMADI';

        $header = "
            <html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'>
            <head><meta charset='utf-8'><title>Laporan Bulanan PPID</title></head>
            <body>
        ";
        $footer = "</body></html>";

        $content = view('admin.reports.templates.laporan_bulanan_word', compact('submissions', 'startDate', 'endDate', 'ppid_name', 'ppid_nip', 'menteri_name'))->render();

        $filename = "Laporan_Bulanan_PPID_" . $startDate . "_sd_" . $endDate . ".doc";

        return response($header . $content . $footer)
            ->header('Content-Type', 'application/msword')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    public function destroy(Permohonan $permohonan)
    {
        $permohonan->delete();
        return redirect()->route('admin.permohonan.index')->with('success', 'Permohonan berhasil dihapus.');
    }
}
