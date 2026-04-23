<?php

namespace App\Http\Controllers;

use App\Models\Keberatan;
use App\Models\Permohonan;
use App\Models\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class KeberatanController extends Controller
{
    /**
     * Admin: Display a listing of objections.
     */
    public function index(Request $request)
    {
        $query = Keberatan::with('permohonan');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date . " 00:00:00", $request->end_date . " 23:59:59"]);
        }

        $keberatans = $query->latest()->paginate(10)->withQueryString();
        return view('admin.keberatan.index', compact('keberatans'));
    }

    /**
     * Public: Show the form for creating a new objection.
     */
    public function createPublic()
    {
        $settings = Dashboard::pluck('value', 'key')->toArray();
        return view('keberatan.form', compact('settings'));
    }

    /**
     * Public: Store a newly created objection.
     */
    public function storePublic(Request $request)
    {
        try {
            $validated = $request->validate([
                'nomor_registrasi_permohonan' => 'nullable|string',
                'nama_pemohon' => 'required|string|max:255',
                'pekerjaan' => 'required|string|max:255',
                'alamat' => 'required|string',
                'nomor_telepon' => 'required|string|max:50',
                'email' => 'required|email|max:255',
                'nama_kuasa' => 'nullable|string|max:255',
                'alamat_kuasa' => 'nullable|string',
                'nomor_telepon_kuasa' => 'nullable|string|max:50',
                'alasan_keberatan_list' => 'required|array',
                'alasan_keberatan_lainnya' => 'nullable|string',
                'kasus_posisi' => 'nullable|string',
                'file_ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
                'file_surat_kuasa' => 'nullable|file|mimes:pdf|max:5120',
            ]);

            // Create unique registration code for objection
            $nomorKeberatan = 'KEB-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));

            // Find associated permohonan if exists (can be ID or username/reg code)
            $permohonan = null;
            if (!empty($validated['nomor_registrasi_permohonan'])) {
                $permohonan = Permohonan::where('id', $validated['nomor_registrasi_permohonan'])
                    ->orWhere('username', $validated['nomor_registrasi_permohonan'])
                    ->first();
            }

            // Prepare data for model (exclude files and permohonan_id for now)
            $data = Arr::except($validated, ['nomor_registrasi_permohonan', 'file_ktp', 'file_surat_kuasa']);
            $data['nomor_registrasi_keberatan'] = $nomorKeberatan;
            $data['permohonan_id'] = $permohonan ? $permohonan->id : null;
            $data['tanggal_keberatan'] = now();
            $data['status'] = 'Pending';

            // Store files and add paths to data array
            if ($request->hasFile('file_ktp')) {
                $data['file_ktp'] = $request->file('file_ktp')->store('keberatan/ktp', 'public');
            }
            if ($request->hasFile('file_surat_kuasa')) {
                $data['file_surat_kuasa'] = $request->file('file_surat_kuasa')->store('keberatan/kuasa', 'public');
            }

            $keberatan = Keberatan::create($data);

            return redirect()->back()->with('success', 'Keberatan Anda telah berhasil diajukan dengan Nomor Registrasi: ' . $nomorKeberatan);

        } catch (\Exception $e) {
            Log::error('Keberatan Submission Error: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat mengirim keberatan: ' . $e->getMessage());
        }
    }

    /**
     * Admin: Display the specified objection.
     */
    public function show($id)
    {
        $keberatan = Keberatan::with('permohonan')->findOrFail($id);
        return view('admin.keberatan.show', compact('keberatan'));
    }

    /**
     * Admin: Show the form for editing the specified objection.
     */
    public function edit($id)
    {
        $keberatan = Keberatan::findOrFail($id);
        return view('admin.keberatan.edit', compact('keberatan'));
    }

    /**
     * Admin: Update the specified objection.
     */
    public function update(Request $request, $id)
    {
        $keberatan = Keberatan::findOrFail($id);
        $keberatan->update($request->all());

        return redirect()->route('admin.keberatan.index')->with('success', 'Data keberatan berhasil diperbarui.');
    }

    /**
     * Admin: Remove the specified objection.
     */
    public function destroy($id)
    {
        Keberatan::destroy($id);
        return redirect()->route('admin.keberatan.index')->with('success', 'Data keberatan berhasil dihapus.');
    }

    /**
     * Admin: Export Register Keberatan to Excel (CSV).
     */
    public function exportExcel(Request $request)
    {
        $query = Keberatan::with('permohonan');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date . " 00:00:00", $request->end_date . " 23:59:59"]);
        }

        $keberatans = $query->latest()->get();
        
        $filename = "register_keberatan_" . date('Y-m-d') . ".csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($keberatans) {
            $file = fopen('php://output', 'w');
            
            // Header (As per Image 2)
            fputcsv($file, [
                'No', 'Tanggal', 'Nama', 'Alamat', 'Pekerjaan', 'NPWP', 'No telpon', 'E-mail', 
                'Rincian Informasi', 'Tujuan Penggunaan', 'Alasan (a)', 'Alasan (b)', 'Alasan (c)', 
                'Alasan (d)', 'Alasan (e)', 'Alasan (f)', 'Alasan (g)', 
                'Keputusan Atasan', 'Hari/Tgl Tanggapan', 'Nama & Posisi Atasan', 'Tanggapan Pemohon'
            ]);
            
            foreach ($keberatans as $index => $item) {
                $reasons = $item->alasan_keberatan_list ?? [];
                fputcsv($file, [
                    $index + 1,
                    $item->tanggal_keberatan ? $item->tanggal_keberatan->format('Y-m-d') : '',
                    $item->nama_pemohon,
                    $item->alamat,
                    $item->pekerjaan,
                    $item->npwp,
                    $item->nomor_telepon,
                    $item->email,
                    $item->rincian_informasi,
                    $item->tujuan_penggunaan,
                    in_array('a', $reasons) ? 'V' : '',
                    in_array('b', $reasons) ? 'V' : '',
                    in_array('c', $reasons) ? 'V' : '',
                    in_array('d', $reasons) ? 'V' : '',
                    in_array('e', $reasons) ? 'V' : '',
                    in_array('f', $reasons) ? 'V' : '',
                    in_array('g', $reasons) ? 'V' : '',
                    $item->keputusan_atasan_ppid,
                    $item->tanggal_tanggapan_keberatan ? $item->tanggal_tanggapan_keberatan->format('Y-m-d') : '',
                    $item->nama_atasan_ppid . ' (' . $item->posisi_atasan_ppid . ')',
                    $item->tanggapan_pemohon
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Admin: Export single objection to Word.
     */
    public function exportWord($id)
    {
        $keberatan = Keberatan::with('permohonan')->findOrFail($id);
        $settings = Dashboard::pluck('value', 'key')->toArray();

        $header = "
            <html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'>
            <head><meta charset='utf-8'><title>Formulir Keberatan</title></head>
            <body>
        ";
        $footer = "</body></html>";

        $content = view('admin.reports.templates.form_keberatan', compact('keberatan', 'settings'))->render();

        $filename = "Form_Keberatan_" . $keberatan->nomor_registrasi_keberatan . ".doc";

        return response($header . $content . $footer)
            ->header('Content-Type', 'application/msword')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}
