<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PermohonanController extends Controller
{
    private function getFormSchema()
    {
        if (Storage::disk('public')->exists('form_schema.json')) {
            return json_decode(Storage::disk('public')->get('form_schema.json'), true);
        }
        return [];
    }

    public function form()
    {
        $customFields = $this->getFormSchema();
        return view('permohonan.form', compact('customFields'));
    }

    public function adminForm()
    {
        $customFields = $this->getFormSchema();
        return view('admin.permohonan.form', compact('customFields'));
    }

    public function saveForm(Request $request)
    {
        $schema = func_get_args()[0]->input('schema', []);
        Storage::disk('public')->put('form_schema.json', json_encode($schema));
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

        return redirect()->back()->with('success', 'Registrasi dan permohonan informasi berhasil dikirimkan. Silakan tunggu konfirmasi kami melalui email.');
    }

    public function index()
    {
        $permohonan = Permohonan::latest()->paginate(10);
        return view('admin.permohonan.submissions', compact('permohonan'));
    }

    /**
     * Export permohonan data to Excel
     */
    public function exportExcel()
    {
        $permohonan = Permohonan::latest()->get();
        
        $filename = "permohonan_informasi_" . date('Y-m-d') . ".csv";
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($permohonan) {
            $file = fopen('php://output', 'w');
            
            // CSV Header
            fputcsv($file, ['ID', 'Username', 'Nama Pemohon', 'Email', 'Telepon', 'Jenis Informasi', 'Deskripsi', 'Format', 'Status', 'Tanggal Daftar']);
            
            // CSV Data
            foreach ($permohonan as $item) {
                fputcsv($file, [
                    $item->id,
                    $item->username,
                    $item->nama_pemohon,
                    $item->email,
                    $item->nomor_telepon,
                    $item->jenis_informasi,
                    $item->deskripsi_permohonan,
                    $item->format_informasi,
                    $item->status ?? 'pending',
                    $item->created_at->format('Y-m-d H:i:s')
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
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
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,completed,rejected',
        ]);

        $permohonan->update($validated);

        return redirect()->route('admin.permohonan.show', $permohonan)->with('success', 'Status permohonan berhasil diperbarui.');
    }

    public function destroy(Permohonan $permohonan)
    {
        $permohonan->delete();
        return redirect()->route('admin.permohonan.index')->with('success', 'Permohonan berhasil dihapus.');
    }
}
