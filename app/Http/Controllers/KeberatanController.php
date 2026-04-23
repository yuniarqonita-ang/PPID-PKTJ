<?php

namespace App\Http\Controllers;

use App\Models\Keberatan;
use App\Models\Permohonan;
use App\Models\Dashboard;
use Illuminate\Http\Request;

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
        $validated = $request->validate([
            'nomor_registrasi_permohonan' => 'required|exists:permohonan,id', // Assuming they enter ID for now or I search by custom reg number
            'nama_pemohon' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
            'email' => 'required|email',
            'rincian_informasi' => 'required',
            'tujuan_penggunaan' => 'required',
            'alasan_keberatan_list' => 'required|array',
            'kasus_posisi' => 'required',
        ]);

        $permohonan = Permohonan::find($validated['nomor_registrasi_permohonan']);
        
        $keberatan = new Keberatan($validated);
        $keberatan->permohonan_id = $permohonan->id;
        $keberatan->tanggal_keberatan = now();
        $keberatan->nomor_registrasi_keberatan = 'KEB-' . strtoupper(uniqid()); // Simple unique ID
        $keberatan->save();

        return redirect()->back()->with('success', 'Keberatan Anda telah berhasil diajukan dengan nomor registrasi: ' . $keberatan->nomor_registrasi_keberatan);
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
