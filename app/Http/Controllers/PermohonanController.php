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
            'username' => 'required|string|max:50|unique:permohonan,username',
            'nama_pemohon' => 'required|string|max:255',
            'jenis_identitas' => 'required|in:ktp,paspor,sim,lainnya',
            'nomor_identitas' => 'required|string|max:50',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string|max:20',
            'pekerjaan' => 'nullable|string|max:100',
            'perusahaan_instansi' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:permohonan,email',
            'password' => 'required|string|min:6|confirmed',
            'jenis_informasi' => 'nullable|string|max:255',
            'deskripsi_permohonan' => 'nullable|string',
            'format_informasi' => 'nullable|in:digital,cetak,keduanya',
            'foto_ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'berkas_pendukung' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240',
        ]);

        if ($request->hasFile('foto_ktp')) {
            $validated['foto_ktp'] = $request->file('foto_ktp')->store('permohonan/ktp', 'public');
        }

        if ($request->hasFile('berkas_pendukung')) {
            $validated['berkas_pendukung'] = $request->file('berkas_pendukung')->store('permohonan/berkas', 'public');
        }

        // Handle Custom Dynamic Fields
        $customData = [];
        if ($request->has('custom_fields')) {
            foreach ($request->input('custom_fields') as $key => $val) {
                $customData[$key] = $val;
            }
        }
        if ($request->hasFile('custom_fields_file')) {
            foreach ($request->file('custom_fields_file') as $key => $file) {
                $customData[$key] = $file->store('permohonan/custom', 'public');
            }
        }
        $validated['custom_fields_data'] = $customData;

        // Hash password sebelum disimpan
        $validated['password'] = Hash::make($validated['password']);

        Permohonan::create($validated);

        return redirect()->route('home')->with('success', 'Registrasi dan permohonan informasi Anda berhasil dikirimkan! Akun Anda telah dibuat. Silakan tunggu konfirmasi lebih lanjut melalui email yang terdaftar.');
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

    public function report(Request $request)
    {
        $startDate = $request->input('start_date', date('Y-m-01'));
        $endDate = $request->input('end_date', date('Y-m-t'));

        $submissions = Permohonan::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->orderBy('created_at', 'asc')
            ->get();

        $settings = Dashboard::pluck('value', 'key')->toArray();

        return view('admin.permohonan.report', compact('submissions', 'startDate', 'endDate', 'settings'));
    }

    public function exportReport(Request $request)
    {
        $startDate = $request->input('start_date', date('Y-m-01'));
        $endDate = $request->input('end_date', date('Y-m-t'));

        $submissions = Permohonan::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->orderBy('created_at', 'asc')
            ->get();

        $settings = Dashboard::pluck('value', 'key')->toArray();

        // Signatory Settings
        $ppid_name = $settings['report_ppid_name'] ?? '..........................';
        $ppid_nip = $settings['report_ppid_nip'] ?? '..........................';
        $menteri_name = $settings['report_menteri_name'] ?? 'BUDI KARYA SUMADI';

        $filename = "Laporan_Bulanan_PPID_" . $startDate . "_sd_" . $endDate . ".csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($submissions, $startDate, $endDate, $ppid_name, $ppid_nip, $menteri_name) {
            $file = fopen('php://output', 'w');
            
            // Format Table Header based on user image
            fputcsv($file, ['FORMAT LAPORAN PELAKSANAAN TUGAS PELAYANAN INFORMASI PUBLIK']);
            fputcsv($file, ['Periode:', $startDate . ' s/d ' . $endDate]);
            fputcsv($file, []);
            
            // Table Columns
            fputcsv($file, ['No', 'Tanggal Minta', 'Tanggal Jawab', 'Waktu (Hari)', 'Nama & Alamat', 'Permohonan Informasi', 'Jenis Informasi (Berkala)', 'Jenis Informasi (Serta Merta)', 'Jenis Informasi (Setiap Saat)', 'Jenis Informasi (Dikecualikan)', 'Keterangan/Status']);
            
            foreach ($submissions as $index => $item) {
                $minta = $item->created_at;
                $jawab = $item->tanggal_selesai;
                $diff = $jawab ? $minta->diffInDays($jawab) : '-';
                
                fputcsv($file, [
                    $index + 1,
                    $minta->format('d/m/Y'),
                    $jawab ? $jawab->format('d/m/Y') : '-',
                    $diff,
                    $item->nama_pemohon . ' (' . $item->alamat . ')',
                    $item->deskripsi_permohonan,
                    $item->kategori_laporan == 'berkala' ? 'V' : '',
                    $item->kategori_laporan == 'sertamerta' ? 'V' : '',
                    $item->kategori_laporan == 'setiapsaat' ? 'V' : '',
                    $item->kategori_laporan == 'dikecualikan' ? 'V' : '',
                    $item->status
                ]);
            }
            
            fputcsv($file, []);
            fputcsv($file, ['', '', '', '', '', '', '', '', 'PPID']);
            fputcsv($file, ['', '', '', '', '', '', '', '', $ppid_name]);
            fputcsv($file, ['', '', '', '', '', '', '', '', 'NIP. ' . $ppid_nip]);
            fputcsv($file, []);
            fputcsv($file, ['', '', '', '', '', '', 'MENTERI PERHUBUNGAN REPUBLIK INDONESIA']);
            fputcsv($file, ['', '', '', '', '', '', $menteri_name]);
            
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
