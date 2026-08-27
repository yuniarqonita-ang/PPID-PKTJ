<?php

namespace App\Http\Controllers;

use App\Models\Pejabat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class PejabatController extends Controller
{
    public function index()
    {
        try {
            if (!Schema::hasTable('pejabats')) {
                Artisan::call('migrate', ['--force' => true]);
            }
        } catch (\Throwable $e) {}

        $pejabats = Pejabat::orderBy('urutan', 'asc')->orderBy('id', 'asc')->get();
        if ($pejabats->isEmpty()) {
            foreach (Pejabat::getDefaultPejabatData() as $item) {
                Pejabat::updateOrCreate(['nama' => $item['nama']], $item);
            }
            $pejabats = Pejabat::orderBy('urutan', 'asc')->orderBy('id', 'asc')->get();
        }
        return view('admin.pejabat.index', compact('pejabats'));
    }

    public function create()
    {
        return view('admin.pejabat.create');
    }

    public function store(Request $request)
    {
        try {
            if (!Schema::hasTable('pejabats')) {
                Artisan::call('migrate', ['--force' => true]);
            }
        } catch (\Throwable $e) {}

        $request->validate([
            'nama'                 => 'required|string|max:255',
            'jabatan'              => 'required|string|max:255',
            'tempat_tanggal_lahir' => 'nullable|string|max:255',
            'foto'                 => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'foto_width'           => 'nullable|integer',
            'foto_height'          => 'nullable|integer',
            'foto_card_height'     => 'nullable|integer',
            'foto_position'        => 'nullable|string',
            'foto_radius'          => 'nullable|string',
            'biografi'             => 'nullable|string',
            'pendidikan'           => 'nullable|string',
            'riwayat_jabatan'      => 'nullable|string',
            'penghargaan'          => 'nullable|string',
            'lhkpn_link'           => 'nullable|url',
            'lhkpn_file'           => 'nullable|file|mimes:pdf|max:10240',
            'lhkpn_tahun'          => 'nullable|string|max:50',
            'urutan'               => 'nullable|integer',
        ]);

        $data = $request->except(['_token', 'foto', 'lhkpn_file']);
        $data['aktif'] = $request->has('aktif');
        $data['foto_width'] = $request->input('foto_width', 160) ?: 160;
        $data['foto_height'] = $request->input('foto_height', 240) ?: 240;
        $data['foto_card_height'] = $request->input('foto_card_height', 390) ?: 390;
        $data['foto_position'] = $request->input('foto_position', 'top center') ?: 'top center';
        $data['foto_radius'] = $request->input('foto_radius', '14px') ?: '14px';

        // Handle arrays from textarea lines
        if ($request->filled('pendidikan')) {
            $data['pendidikan'] = array_values(array_filter(array_map('trim', explode("\n", $request->pendidikan))));
        } else {
            $data['pendidikan'] = [];
        }

        if ($request->filled('riwayat_jabatan')) {
            $data['riwayat_jabatan'] = array_values(array_filter(array_map('trim', explode("\n", $request->riwayat_jabatan))));
        } else {
            $data['riwayat_jabatan'] = [];
        }

        if ($request->filled('penghargaan')) {
            $data['penghargaan'] = array_values(array_filter(array_map('trim', explode("\n", $request->penghargaan))));
        } else {
            $data['penghargaan'] = [];
        }

        // Handle Photo
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-._]/', '_', $file->getClientOriginalName());
            $path = $file->storeAs('pejabat', $filename, 'public');
            $data['foto'] = 'storage/' . $path;
        }

        // Handle LHKPN File
        if ($request->hasFile('lhkpn_file')) {
            $file = $request->file('lhkpn_file');
            $filename = 'lhkpn_' . time() . '_' . preg_replace('/[^A-Za-z0-9\-._]/', '_', $file->getClientOriginalName());
            $path = $file->storeAs('lhkpn', $filename, 'public');
            $data['lhkpn_file'] = 'storage/' . $path;
        }

        Pejabat::create($data);

        return redirect()->route('admin.informasi.berkala.index')
            ->with('success', 'Data Profil Pejabat berhasil ditambahkan!');
    }

    public function edit($id)
    {
        try {
            if (!Schema::hasTable('pejabats')) {
                Artisan::call('migrate', ['--force' => true]);
            }
        } catch (\Throwable $e) {}

        $pejabat = Pejabat::find($id);

        if (!$pejabat) {
            // Auto seed default data
            $defaults = Pejabat::getDefaultPejabatData();
            foreach ($defaults as $item) {
                Pejabat::updateOrCreate(['nama' => $item['nama']], $item);
            }
            $pejabat = Pejabat::find($id);
            if (!$pejabat) {
                $pejabat = Pejabat::first();
            }
        }

        if (!$pejabat) {
            $defaultData = Pejabat::getDefaultPejabatData()[0];
            $pejabat = new Pejabat($defaultData);
            $pejabat->id = 1;
        }

        return view('admin.pejabat.edit', compact('pejabat'));
    }

    public function update(Request $request, $id)
    {
        try {
            if (!Schema::hasTable('pejabats')) {
                Artisan::call('migrate', ['--force' => true]);
            } else if (!Schema::hasColumn('pejabats', 'foto_width')) {
                \Illuminate\Database\Schema\Blueprint;
                Schema::table('pejabats', function ($table) {
                    $table->integer('foto_width')->nullable()->default(160);
                    $table->integer('foto_height')->nullable()->default(240);
                    $table->integer('foto_card_height')->nullable()->default(390);
                    $table->string('foto_position')->nullable()->default('top center');
                    $table->string('foto_radius')->nullable()->default('14px');
                });
            }
        } catch (\Throwable $e) {}

        $pejabat = Pejabat::find($id);
        if (!$pejabat) {
            $defaults = Pejabat::getDefaultPejabatData();
            foreach ($defaults as $item) {
                Pejabat::updateOrCreate(['nama' => $item['nama']], $item);
            }
            $pejabat = Pejabat::find($id);
        }

        if (!$pejabat) {
            $pejabat = Pejabat::create([
                'nama' => $request->input('nama', 'Pejabat PKTJ'),
                'jabatan' => $request->input('jabatan', 'Pimpinan'),
            ]);
        }

        $request->validate([
            'nama'                 => 'required|string|max:255',
            'jabatan'              => 'required|string|max:255',
            'tempat_tanggal_lahir' => 'nullable|string|max:255',
            'foto'                 => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'foto_width'           => 'nullable|integer',
            'foto_height'          => 'nullable|integer',
            'foto_card_height'     => 'nullable|integer',
            'foto_position'        => 'nullable|string',
            'foto_radius'          => 'nullable|string',
            'biografi'             => 'nullable|string',
            'pendidikan'           => 'nullable|string',
            'riwayat_jabatan'      => 'nullable|string',
            'penghargaan'          => 'nullable|string',
            'lhkpn_link'           => 'nullable|url',
            'lhkpn_file'           => 'nullable|file|mimes:pdf|max:10240',
            'lhkpn_tahun'          => 'nullable|string|max:50',
            'urutan'               => 'nullable|integer',
        ]);

        $data = $request->except(['_token', '_method', 'foto', 'lhkpn_file']);
        $data['aktif'] = $request->has('aktif');
        $data['foto_width'] = $request->input('foto_width', 160) ?: 160;
        $data['foto_height'] = $request->input('foto_height', 240) ?: 240;
        $data['foto_card_height'] = $request->input('foto_card_height', 390) ?: 390;
        $data['foto_position'] = $request->input('foto_position', 'top center') ?: 'top center';
        $data['foto_radius'] = $request->input('foto_radius', '14px') ?: '14px';

        if ($request->filled('pendidikan')) {
            $data['pendidikan'] = array_values(array_filter(array_map('trim', explode("\n", $request->pendidikan))));
        } else {
            $data['pendidikan'] = [];
        }

        if ($request->filled('riwayat_jabatan')) {
            $data['riwayat_jabatan'] = array_values(array_filter(array_map('trim', explode("\n", $request->riwayat_jabatan))));
        } else {
            $data['riwayat_jabatan'] = [];
        }

        if ($request->filled('penghargaan')) {
            $data['penghargaan'] = array_values(array_filter(array_map('trim', explode("\n", $request->penghargaan))));
        } else {
            $data['penghargaan'] = [];
        }

        // Handle Photo Update
        if ($request->hasFile('foto')) {
            if ($pejabat->foto && strpos($pejabat->foto, 'storage/') === 0) {
                $oldPath = str_replace('storage/', '', $pejabat->foto);
                Storage::disk('public')->delete($oldPath);
            }
            $file = $request->file('foto');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-._]/', '_', $file->getClientOriginalName());
            $path = $file->storeAs('pejabat', $filename, 'public');
            $data['foto'] = 'storage/' . $path;
        }

        // Handle LHKPN File Update
        if ($request->hasFile('lhkpn_file')) {
            if ($pejabat->lhkpn_file && strpos($pejabat->lhkpn_file, 'storage/') === 0) {
                $oldPath = str_replace('storage/', '', $pejabat->lhkpn_file);
                Storage::disk('public')->delete($oldPath);
            }
            $file = $request->file('lhkpn_file');
            $filename = 'lhkpn_' . time() . '_' . preg_replace('/[^A-Za-z0-9\-._]/', '_', $file->getClientOriginalName());
            $path = $file->storeAs('lhkpn', $filename, 'public');
            $data['lhkpn_file'] = 'storage/' . $path;
        }

        $pejabat->update($data);

        return redirect()->route('admin.informasi.berkala.index')
            ->with('success', 'Data Pejabat ' . $pejabat->nama . ' berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pejabat = Pejabat::find($id);
        if ($pejabat) {
            if ($pejabat->foto && strpos($pejabat->foto, 'storage/') === 0) {
                $oldPath = str_replace('storage/', '', $pejabat->foto);
                Storage::disk('public')->delete($oldPath);
            }
            $pejabat->delete();
        }

        return redirect()->route('admin.informasi.berkala.index')
            ->with('success', 'Data Profil Pejabat berhasil dihapus!');
    }

    public function updateSizeSettings(Request $request)
    {
        $keys = [
            'pejabat_foto_table_width'  => $request->input('pejabat_foto_table_width', 155),
            'pejabat_foto_table_height' => $request->input('pejabat_foto_table_height', 230),
            'pejabat_foto_card_height'  => $request->input('pejabat_foto_card_height', 390),
            'pejabat_foto_position'     => $request->input('pejabat_foto_position', 'top center'),
            'pejabat_foto_radius'       => $request->input('pejabat_foto_radius', '14px'),
            'pejabat_foto_admin_height' => $request->input('pejabat_foto_admin_height', 125),
        ];

        foreach ($keys as $k => $val) {
            \App\Models\Dashboard::updateOrCreate(
                ['key' => $k],
                [
                    'value'       => (string)$val,
                    'type'        => 'text',
                    'description' => 'Pengaturan Ukuran Foto Pejabat ' . $k,
                    'aktif'       => true
                ]
            );
        }

        return redirect()->route('admin.informasi.berkala.index')
            ->with('success', 'Pengaturan ukuran tampilan foto pejabat berhasil disimpan!');
    }
}
