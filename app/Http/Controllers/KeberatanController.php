<?php

namespace App\Http\Controllers;

use App\Models\Keberatan;
use App\Models\Permohonan;
use App\Models\Dashboard;
use Illuminate\Http\Request;

class KeberatanController extends Controller
{
    // ──────────────────────────────────────
    // FORM BUILDER METHODS
    // ──────────────────────────────────────

    private function getFormSchema()
    {
        $schemaSetting = Dashboard::where('key', 'keberatan_form_schema')->first();
        if ($schemaSetting && $schemaSetting->value) {
            $data = json_decode($schemaSetting->value, true);
            if (is_array($data) && array_values($data) === $data) {
                return ['section_title' => 'INFORMASI TAMBAHAN', 'fields' => $data];
            }
            return array_merge(['section_title' => 'INFORMASI TAMBAHAN', 'fields' => []], (array)$data);
        }
        return ['section_title' => 'INFORMASI TAMBAHAN', 'fields' => []];
    }

    public function adminForm()
    {
        $schema       = $this->getFormSchema();
        $sectionTitle = $schema['section_title'];
        $customFields = $schema['fields'];
        $settings     = Dashboard::pluck('value', 'key')->toArray();
        return view('admin.keberatan.form', compact('customFields', 'sectionTitle', 'settings'));
    }

    public function saveForm(Request $request)
    {
        if ($request->has('fields')) {
            $schema = [
                'section_title' => $request->input('section_title', 'INFORMASI TAMBAHAN'),
                'fields'        => $request->input('fields', [])
            ];
            Dashboard::updateOrCreate(
                ['key' => 'keberatan_form_schema'],
                ['value' => json_encode($schema), 'type' => 'json', 'description' => 'Skema Dynamic Form Keberatan', 'aktif' => true]
            );
        }

        $exclude = ['_token', 'section_title', 'fields', 'core_settings'];
        foreach ($request->all() as $key => $value) {
            if (!in_array($key, $exclude) && $value !== null) {
                Dashboard::updateOrCreate(
                    ['key' => $key],
                    ['value' => is_array($value) ? json_encode($value) : $value, 'type' => is_array($value) ? 'json' : 'text', 'description' => 'Pengaturan Dinamis Keberatan', 'aktif' => true]
                );
            }
        }

        if ($request->has('core_settings')) {
            foreach ($request->input('core_settings') as $key => $value) {
                Dashboard::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value, 'type' => 'text', 'description' => 'Konfigurasi Inti Keberatan', 'aktif' => true]
                );
            }
        }

        return response()->json(['success' => true]);
    }

    // ──────────────────────────────────────
    // ADMIN LISTING
    // ──────────────────────────────────────

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
            'nomor_registrasi_permohonan' => 'required|string',
            'tujuan_penggunaan_informasi' => 'required|string|max:500',
            'nama_pemohon'               => 'required|string|max:255',
            'pekerjaan'                  => 'required|string|max:255',
            'npwp'                       => 'nullable|string|max:30',
            'alamat'                     => 'required|string',
            'nomor_telepon'              => 'required|string|max:50',
            'email'                      => 'required|email|max:255',
            'nama_kuasa'                 => 'nullable|string|max:255',
            'alamat_kuasa'              => 'nullable|string',
            'nomor_telepon_kuasa'        => 'nullable|string|max:50',
            'alasan_keberatan_list'      => 'required|array',
            'alasan_keberatan_lainnya'   => 'nullable|string',
            'kasus_posisi'               => 'nullable|string',
            'file_ktp'                   => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_surat_kuasa'           => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Cari permohonan jika nomor registrasi diisi
        $permohonan = null;
        if ($validated['nomor_registrasi_permohonan']) {
            $permohonan = Permohonan::where('id', $validated['nomor_registrasi_permohonan'])->first();
        }

        $keberatan = new Keberatan();

        // Map secara eksplisit ke kolom yang ada di tabel keberatans
        $keberatan->permohonan_id               = $permohonan ? $permohonan->id : null;
        $keberatan->nama_pemohon                = $validated['nama_pemohon'];
        $keberatan->pekerjaan                   = $validated['pekerjaan'];
        $keberatan->npwp                        = $validated['npwp'] ?? null;
        $keberatan->alamat                      = $validated['alamat'];
        $keberatan->nomor_telepon               = $validated['nomor_telepon'];
        $keberatan->email                       = $validated['email'];
        $keberatan->nama_kuasa                  = $validated['nama_kuasa'] ?? null;
        $keberatan->alamat_kuasa                = $validated['alamat_kuasa'] ?? null;
        $keberatan->nomor_telepon_kuasa         = $validated['nomor_telepon_kuasa'] ?? null;
        $keberatan->tujuan_penggunaan           = $validated['tujuan_penggunaan_informasi'];
        $keberatan->alasan_keberatan_list       = $validated['alasan_keberatan_list'];
        $keberatan->alasan_keberatan_lainnya    = $validated['alasan_keberatan_lainnya'] ?? null;
        $keberatan->kasus_posisi                = $validated['kasus_posisi'] ?? null;
        $keberatan->tanggal_keberatan           = now();
        $keberatan->nomor_registrasi_keberatan  = 'KEB-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
        $keberatan->status                      = 'pending';

        // Handle file uploads
        if ($request->hasFile('file_ktp')) {
            $file     = $request->file('file_ktp');
            $filename = time() . '_ktp_' . $file->getClientOriginalName();
            $file->storeAs('public/keberatan/ktp', $filename);
            $keberatan->file_ktp = 'storage/keberatan/ktp/' . $filename;
        }

        if ($request->hasFile('file_surat_kuasa')) {
            $file     = $request->file('file_surat_kuasa');
            $filename = time() . '_kuasa_' . $file->getClientOriginalName();
            $file->storeAs('public/keberatan/kuasa', $filename);
            $keberatan->file_surat_kuasa = 'storage/keberatan/kuasa/' . $filename;
        }

        $keberatan->save();

        return redirect()->back()->with('success', 'Keberatan Anda telah berhasil diajukan dengan Nomor Registrasi: ' . $keberatan->nomor_registrasi_keberatan);
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
     * Admin: Export Register Keberatan to Excel (XLS - HTML Table format).
     */
    public function exportExcel(Request $request)
    {
        $query = Keberatan::with('permohonan');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date . " 00:00:00", $request->end_date . " 23:59:59"]);
        }

        $keberatans  = $query->latest()->get();
        $settings    = Dashboard::pluck('value', 'key')->toArray();
        $namaLembaga = $settings['ppid_nama'] ?? 'POLITEKNIK KESELAMATAN TRANSPORTASI JALAN';
        $filename    = "register_keberatan_" . date('Y-m-d') . ".xls";

        // Definisi alasan keberatan berdasarkan pasal 35 ayat (1) UU KIP
        $alasanLabel = [
            'a' => 'a',
            'b' => 'b',
            'c' => 'c',
            'd' => 'd',
            'e' => 'e',
            'f' => 'f',
            'g' => 'g',
        ];

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
  <tr class="subtitle-row"><td colspan="21">FORM REGISTRASI KEBERATAN</td></tr>
  <tr class="subtitle-row"><td colspan="21">' . strtoupper($namaLembaga) . '</td></tr>
  <tr><td colspan="21"></td></tr>
  <!-- Header Row 1 -->
  <tr>
    <th rowspan="2">No</th>
    <th rowspan="2">Tanggal</th>
    <th rowspan="2">Nama</th>
    <th rowspan="2">Alamat</th>
    <th rowspan="2">Pekerjaan</th>
    <th rowspan="2">NPWP</th>
    <th rowspan="2">No Telpon</th>
    <th rowspan="2">E-mail</th>
    <th rowspan="2">Rincian Informasi yang dibutuhkan</th>
    <th rowspan="2">Tujuan Penggunaan Informasi</th>
    <th colspan="7">Alasan Pengajuan Keberatan (pasal 35 ayat (1) UU KIP)</th>
    <th rowspan="2">Keputusan Atasan PPID</th>
    <th rowspan="2">Hari dan Tanggal Pemberian Tanggapan atas Keberatan</th>
    <th rowspan="2">Nama dan Posisi Atasan PPID</th>
    <th rowspan="2">Tanggapan Pemohon Informasi</th>
  </tr>
  <!-- Header Row 2 (sub-headers for Alasan) -->
  <tr>
    <th>a</th>
    <th>b</th>
    <th>c</th>
    <th>d</th>
    <th>e</th>
    <th>f</th>
    <th>g</th>
  </tr>';

        foreach ($keberatans as $index => $item) {
            $reasons = $item->alasan_keberatan_list ?? [];
            $namaAtasan = trim(($item->nama_atasan_ppid ?? '') . ($item->posisi_atasan_ppid ? ' (' . $item->posisi_atasan_ppid . ')' : ''));
            $html .= '<tr>
    <td>' . ($index + 1) . '</td>
    <td>' . ($item->tanggal_keberatan ? \Carbon\Carbon::parse($item->tanggal_keberatan)->format('d/m/Y') : '') . '</td>
    <td class="text-left">' . e($item->nama_pemohon) . '</td>
    <td class="text-left">' . e($item->alamat) . '</td>
    <td>' . e($item->pekerjaan) . '</td>
    <td>' . e($item->npwp ?? '') . '</td>
    <td>' . e($item->nomor_telepon) . '</td>
    <td>' . e($item->email) . '</td>
    <td class="text-left">' . e($item->rincian_informasi ?? ($item->permohonan ? $item->permohonan->deskripsi_permohonan : '')) . '</td>
    <td class="text-left">' . e($item->tujuan_penggunaan) . '</td>
    <td>' . (in_array('a', $reasons) ? '✓' : '') . '</td>
    <td>' . (in_array('b', $reasons) ? '✓' : '') . '</td>
    <td>' . (in_array('c', $reasons) ? '✓' : '') . '</td>
    <td>' . (in_array('d', $reasons) ? '✓' : '') . '</td>
    <td>' . (in_array('e', $reasons) ? '✓' : '') . '</td>
    <td>' . (in_array('f', $reasons) ? '✓' : '') . '</td>
    <td>' . (in_array('g', $reasons) ? '✓' : '') . '</td>
    <td>' . e($item->keputusan_atasan_ppid ?? '') . '</td>
    <td>' . ($item->tanggal_tanggapan_keberatan ? \Carbon\Carbon::parse($item->tanggal_tanggapan_keberatan)->format('d/m/Y') : '') . '</td>
    <td class="text-left">' . e($namaAtasan) . '</td>
    <td class="text-left">' . e($item->tanggapan_pemohon ?? '') . '</td>
  </tr>';
        }

        $html .= '</table></body></html>';

        return response($html)
            ->header('Content-Type', 'application/vnd.ms-excel; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->header('Cache-Control', 'max-age=0');
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
