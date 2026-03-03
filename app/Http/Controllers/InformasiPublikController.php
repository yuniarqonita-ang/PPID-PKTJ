<?php

namespace App\Http\Controllers;

use App\Models\InformasiBerkala;
use App\Models\InformasiSertamerta;
use App\Models\InformasiSetiapsaat;
use App\Models\InformasiDikecualikan;
use App\Models\Prosedur;
use App\Models\Faq;

class InformasiPublikController extends Controller
{
    // Informasi Berkala
    public function informasiBerkala()
    {
        $informasi = InformasiBerkala::where('aktif', true)->latest()->get();
        return view('informasi.berkala', compact('informasi'));
    }

    // Informasi Serta Merta
    public function informasiSertamerta()
    {
        $informasi = InformasiSertamerta::where('aktif', true)->latest()->get();
        return view('informasi.sertamerta', compact('informasi'));
    }

    // Informasi Setiap Saat
    public function informasiSetiapsaat()
    {
        $informasi = InformasiSetiapsaat::where('aktif', true)->latest()->get();
        return view('informasi.setiapsaat', compact('informasi'));
    }

    // Informasi Dikecualikan
    public function informasiDikecualikan()
    {
        $informasi = InformasiDikecualikan::where('aktif', true)->latest()->get();
        return view('informasi.dikecualikan', compact('informasi'));
    }

    // Prosedur
    public function prosedur($kategori)
    {
        $prosedur = Prosedur::where('kategori', $kategori)->where('aktif', true)->latest()->get();
        return view('informasi.prosedur', compact('prosedur', 'kategori'));
    }

    // Download file
    public function downloadFile($model, $id)
    {
        switch($model) {
            case 'berkala':
                $data = InformasiBerkala::findOrFail($id);
                break;
            case 'sertamerta':
                $data = InformasiSertamerta::findOrFail($id);
                break;
            case 'setiapsaat':
                $data = InformasiSetiapsaat::findOrFail($id);
                break;
            case 'dikecualikan':
                $data = InformasiDikecualikan::findOrFail($id);
                break;
            case 'prosedur':
                $data = Prosedur::findOrFail($id);
                break;
            default:
                abort(404);
        }

        $filePath = public_path($data->file_path);
        
        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->download($filePath, $data->file_name);
    }
}
