<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Agenda::orderBy('tanggal', 'desc')->get();
        return view('admin.agenda.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|string|max:255',
            'konten'  => 'nullable|string',
            'tanggal' => 'required|date',
            'waktu'   => 'nullable|string|max:10',
            'lokasi'  => 'nullable|string|max:255',
            'gambar'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'judul'   => $request->judul,
            'konten'  => $request->konten ?? '',
            'tanggal' => $request->tanggal,
            'waktu'   => $request->waktu,
            'lokasi'  => $request->lokasi,
            'aktif'   => $request->has('aktif'),
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('agenda', 'public');
        }

        Agenda::create($data);

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $agenda = Agenda::findOrFail($id);
        return view('admin.agenda.show', compact('agenda'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agenda = Agenda::findOrFail($id);
        return view('admin.agenda.edit', compact('agenda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $agenda = Agenda::findOrFail($id);

        $request->validate([
            'judul'   => 'required|string|max:255',
            'konten'  => 'nullable|string',
            'tanggal' => 'required|date',
            'waktu'   => 'nullable|string|max:10',
            'lokasi'  => 'nullable|string|max:255',
            'gambar'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $agenda->judul   = $request->judul;
        $agenda->konten  = $request->konten ?? '';
        $agenda->tanggal = $request->tanggal;
        $agenda->waktu   = $request->waktu;
        $agenda->lokasi  = $request->lokasi;
        $agenda->aktif   = $request->has('aktif');

        if ($request->hasFile('gambar')) {
            if ($agenda->gambar) {
                Storage::disk('public')->delete($agenda->gambar);
            }
            $agenda->gambar = $request->file('gambar')->store('agenda', 'public');
        }

        $agenda->save();

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $agenda = Agenda::findOrFail($id);

        if ($agenda->gambar) {
            Storage::disk('public')->delete($agenda->gambar);
        }

        $agenda->delete();

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil dihapus');
    }

    public function publicIndex()
    {
        $items = Agenda::where('aktif', true)->latest()->get();
        return view('agenda', compact('items'));
    }
}
