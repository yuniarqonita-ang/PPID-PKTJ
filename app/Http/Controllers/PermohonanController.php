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
            'tanggal_permohonan'                   => 'required|date',
            'nama_pemohon'                         => 'required|string|max:255',
            'alamat'                               => 'required|string',
            'pekerjaan'                            => 'nullable|string|max:100',
            'npwp'                                 => 'nullable|string|max:30',
            'nomor_telepon'                        => 'required|string|max:20',
            'email'                                => 'required|email|max:255',
            'rincian_informasi'                    => 'required|string',
            'tujuan_penggunaan'                    => 'required|string',
            'status_informasi_dikuasai'            => 'required|in:ya,tidak',
            'status_informasi_belum_didokumentasikan' => 'nullable|in:ya,tidak',
            'bentuk_informasi_salinan'             => 'required|in:Softcopy,Hardcopy',
            'jenis_permohonan_salinan'             => 'required|in:Melihat,Meminta Salinan',
            'foto_ktp'                             => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'berkas_pendukung'                     => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240',
        ], [
            'tanggal.required'                    => 'Tanggal permohonan wajib diisi.',
            'nama_pemohon.required'               => 'Nama lengkap wajib diisi.',
            'alamat.required'                     => 'Alamat wajib diisi.',
            'nomor_telepon.required'              => 'Nomor telepon wajib diisi.',
            'email.required'                      => 'Email wajib diisi.',
            'email.email'                         => 'Format email tidak valid.',
            'rincian_informasi.required'          => 'Rincian informasi yang dibutuhkan wajib diisi.',
            'tujuan_penggunaan.required'          => 'Tujuan penggunaan informasi wajib diisi.',
            'status_informasi_dikuasai.required'  => 'Status informasi di bawah penguasaan wajib dipilih.',
            'bentuk_informasi_salinan.required'   => 'Bentuk informasi wajib dipilih.',
            'jenis_permohonan_salinan.required'   => 'Jenis permohonan wajib dipilih.',
            'foto_ktp.required'                   => 'Scan/foto identitas wajib diunggah.',
        ]);

        // Map field form ke kolom database — HANYA kolom yang benar-benar ada di tabel
        $fotoKtp = $request->hasFile('foto_ktp')
            ? $request->file('foto_ktp')->store('permohonan/ktp', 'public')
            : null;

        $berkasPendukung = $request->hasFile('berkas_pendukung')
            ? $request->file('berkas_pendukung')->store('permohonan/berkas', 'public')
            : null;

        Permohonan::create([
            'tanggal_permohonan'                      => $validated['tanggal_permohonan'],
            'nama_pemohon'                            => $validated['nama_pemohon'],
            'alamat'                                  => $validated['alamat'],
            'pekerjaan'                               => $validated['pekerjaan'] ?? null,
            'npwp'                                    => $validated['npwp'] ?? null,
            'nomor_telepon'                           => $validated['nomor_telepon'],
            'email'                                   => $validated['email'],
            'deskripsi_permohonan'                    => $validated['rincian_informasi'],
            'jenis_informasi'                         => $validated['tujuan_penggunaan'],
            'status_informasi_dikuasai'               => $validated['status_informasi_dikuasai'] === 'ya' ? 1 : 0,
            'status_informasi_belum_didokumentasikan' => ($validated['status_informasi_belum_didokumentasikan'] ?? '') === 'ya' ? 1 : 0,
            'bentuk_informasi_salinan'                => $validated['bentuk_informasi_salinan'],
            'jenis_permohonan_salinan'                => $validated['jenis_permohonan_salinan'],
            'foto_ktp'                                => $fotoKtp,
            'berkas_pendukung'                        => $berkasPendukung,
            'status'                                  => 'pending',
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
     * Admin: Export Register Permohonan to Excel (CSV)
     */
    public function exportExcelRegister(Request $request)
    {
        $query = Permohonan::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date . " 00:00:00", $request->end_date . " 23:59:59"]);
        }

        $permohonan = $query->latest()->get();
        $filename = "register_permohonan_" . date('Y-m-d') . ".csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($permohonan) {
            $file = fopen('php://output', 'w');
            
            // Header (As per Image 1)
            fputcsv($file, [
                'No', 'Tanggal', 'Nama', 'Alamat', 'Pekerjaan', 'NPWP', 'No telpon', 'E-mail', 
                'Rincian Informasi', 'Tujuan Penggunaan', 'Status (Ya)', 'Status (Tidak)', 'Belum Dokumentasi',
                'Bentuk (Soft)', 'Bentuk (Hard)', 'Jenis (Lihat)', 'Jenis (Salinan)', 'Keputusan',
                'Alasan Penolakan', 'Tgl Beritahu', 'Tgl Pemberian', 'Biaya', 'Cara Bayar'
            ]);
            
            foreach ($permohonan as $index => $item) {
                fputcsv($file, [
                    $index + 1,
                    $item->created_at->format('Y-m-d'),
                    $item->nama_pemohon,
                    $item->alamat,
                    $item->pekerjaan,
                    $item->npwp,
                    $item->nomor_telepon,
                    $item->email,
                    $item->deskripsi_permohonan,
                    $item->jenis_informasi,
                    $item->status_informasi_dikuasai ? 'V' : '',
                    !$item->status_informasi_dikuasai ? 'V' : '',
                    $item->status_informasi_belum_didokumentasikan ? 'V' : '',
                    $item->bentuk_informasi_salinan == 'Softcopy' ? 'V' : '',
                    $item->bentuk_informasi_salinan == 'Hardcopy' ? 'V' : '',
                    $item->jenis_permohonan_salinan == 'Melihat' ? 'V' : '',
                    $item->jenis_permohonan_salinan == 'Meminta Salinan' ? 'V' : '',
                    $item->status,
                    $item->alasan_penolakan_text,
                    $item->tanggal_pemberitahuan_tertulis ? $item->tanggal_pemberitahuan_tertulis->format('Y-m-d') : '',
                    $item->tanggal_pemberian_informasi ? $item->tanggal_pemberian_informasi->format('Y-m-d') : '',
                    $item->biaya_salinan,$item->cara_pembayaran
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

        $ppid_name    = $settings['report_ppid_name'] ?? '..........................';
        $ppid_nip     = $settings['report_ppid_nip'] ?? '..........................';
        $menteri_name = $settings['report_menteri_name'] ?? '..........................';

        $periodeLabel = $periodeType === 'tahunan'
            ? "Tahun {$tahun}"
            : date('F', mktime(0, 0, 0, $bulan, 1)) . " {$tahun}";

        $filename = "Laporan_B1-B4_PPID_{$periodeLabel}.csv";
        $headers  = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($submissions, $periodeLabel, $ppid_name, $ppid_nip, $menteri_name) {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['LAPORAN PELAKSANAAN TUGAS PELAYANAN INFORMASI PUBLIK']);
            fputcsv($file, ['POLITEKNIK KESELAMATAN TRANSPORTASI JALAN — PPID']);
            fputcsv($file, ['Periode: ' . $periodeLabel]);
            fputcsv($file, []);

            // Header B1-B4
            fputcsv($file, [
                'No', 'Bulan', 'Tanggal Permohonan', 'Tanggal Selesai', 'Waktu (Hari)',
                'Nama Pemohon', 'Instansi/Asal',
                'Rincian Informasi yang Dibutuhkan',
                'Berkala', 'Serta Merta', 'Setiap Saat', 'Dikecualikan',
                'Keterangan (Dipenuhi/Ditolak/Proses)',
                'Metode Pelayanan',
                'Alasan Penolakan'
            ]);

            $bulanNama = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];

            foreach ($submissions as $index => $item) {
                $tglMinta   = $item->tanggal_permohonan ?? $item->created_at;
                $tglSelesai = $item->tanggal_selesai;
                $hari       = $tglSelesai ? \Carbon\Carbon::parse($tglMinta)->diffInDays(\Carbon\Carbon::parse($tglSelesai)) : '';
                $bulanItem  = $bulanNama[\Carbon\Carbon::parse($tglMinta)->format('m')] ?? '';
                $statusLabel= match($item->status) {
                    'selesai' => 'Dipenuhi',
                    'ditolak' => 'Ditolak',
                    'diproses'=> 'Diproses',
                    default   => 'Pending'
                };

                fputcsv($file, [
                    $index + 1,
                    $bulanItem,
                    \Carbon\Carbon::parse($tglMinta)->format('d/m/Y'),
                    $tglSelesai ? \Carbon\Carbon::parse($tglSelesai)->format('d/m/Y') : '',
                    $hari,
                    $item->nama_pemohon,
                    $item->perusahaan_instansi ?? $item->alamat,
                    $item->deskripsi_permohonan,
                    $item->kategori_laporan == 'berkala'     ? 'V' : '',
                    $item->kategori_laporan == 'sertamerta'  ? 'V' : '',
                    $item->kategori_laporan == 'setiapsaat'  ? 'V' : '',
                    $item->kategori_laporan == 'dikecualikan'? 'V' : '',
                    $statusLabel,
                    $item->jenis_permohonan_salinan ?? $item->bentuk_informasi_salinan ?? '',
                    $item->alasan_penolakan_text ?? '',
                ]);
            }

            fputcsv($file, []);
            fputcsv($file, ['', '', '', '', '', '', '', '', '', '', '', '', '', 'Tegal, ' . date('d F Y')]);
            fputcsv($file, ['', '', '', '', '', '', '', '', '', '', '', '', '', 'PPID PKTJ']);
            fputcsv($file, []);
            fputcsv($file, ['', '', '', '', '', '', '', '', '', '', '', '', '', $ppid_name]);
            fputcsv($file, ['', '', '', '', '', '', '', '', '', '', '', '', '', 'NIP. ' . $ppid_nip]);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
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
