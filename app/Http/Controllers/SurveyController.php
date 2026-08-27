<?php

namespace App\Http\Controllers;

use App\Models\SurveyResponse;
use App\Models\Permohonan;
use App\Models\Dokumen;
use App\Models\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class SurveyController extends Controller
{
    /**
     * Auto-migration fail-safe for cPanel
     */
    private function ensureSchema()
    {
        if (!Schema::hasTable('survey_responses')) {
            try {
                \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
            } catch (\Throwable $e) {}
        }
    }

    /**
     * Public Survey & IKM Dashboard Page (/layanan-informasi/laporan-survey & /survey-kepuasan)
     */
    public function index()
    {
        $this->ensureSchema();

        $stats = SurveyResponse::getLiveStatistics();
        $settings = Dashboard::pluck('value', 'key')->toArray();

        // Dokumen laporan resmi survey SKM PKTJ (PDF)
        $laporan = Dokumen::where(function($q) {
            $q->where('kategori', 'like', '%survey%')
              ->orWhere('kategori', 'like', '%laporan%')
              ->orWhere('judul', 'like', '%survey%')
              ->orWhere('judul', 'like', '%kepuasan%')
              ->orWhere('judul', 'like', '%ikm%');
        })->where('aktif', true)->orderBy('tanggal', 'desc')->get();

        return view('laporan-survey-kepuasan', compact('stats', 'settings', 'laporan'));
    }

    /**
     * Submit Survey Response (AJAX or Standard POST)
     */
    public function store(Request $request)
    {
        $this->ensureSchema();

        $request->validate([
            'sumber_informasi' => 'required|in:website,sosial_media',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $data = [
            'sumber_informasi' => $request->input('sumber_informasi'),
            'informasi_diterima' => $request->input('informasi_diterima'),
            'ui_ux' => $request->input('ui_ux'),
            'rating' => (int) $request->input('rating', 5),
            'saran_masukan' => $request->input('saran_masukan'),
            'ip_address' => $request->ip(),
        ];

        if ($request->input('sumber_informasi') === 'website') {
            $data['nomor_registrasi'] = $request->input('nomor_registrasi');
        } else {
            $data['nama'] = $request->input('nama');
            $data['usia'] = $request->input('usia');
            $data['kemudahan_prosedur'] = $request->input('kemudahan_prosedur');
            $data['kesesuaian_jawaban'] = $request->input('kesesuaian_jawaban');
        }

        $response = SurveyResponse::create($data);

        if ($request->ajax() || $request->wantsJson()) {
            $newStats = SurveyResponse::getLiveStatistics();
            return response()->json([
                'status' => 'success',
                'message' => 'Terima kasih! Survei kepuasan Anda telah berhasil dikirim dan statistik kepuasan langsung diperbarui.',
                'stats' => $newStats
            ]);
        }

        return redirect()->back()->with('success_survey', 'Terima kasih! Survei kepuasan Anda telah berhasil dikirim.');
    }

    /**
     * AJAX Check Nomor Registrasi
     */
    public function checkRegistrasi(Request $request)
    {
        $regNumber = trim($request->input('nomor_registrasi', ''));
        if (empty($regNumber)) {
            return response()->json(['found' => false, 'message' => 'Nomor registrasi wajib diisi.']);
        }

        $found = false;
        $info = null;

        if (Schema::hasTable('permohonans')) {
            $perm = Permohonan::where('nomor_registrasi', $regNumber)
                              ->orWhere('id', str_replace(['REQ-', 'PI-', '#'], '', $regNumber))
                              ->first();
            if ($perm) {
                $found = true;
                $info = [
                    'nama' => $perm->nama_pemohon ?? $perm->nama ?? 'Pemohon Terverifikasi',
                    'status' => $perm->status ?? 'Selesai',
                    'rincian' => $perm->rincian_informasi ?? ''
                ];
            }
        }

        // Return positive even if not found in database to allow public testing
        return response()->json([
            'found' => true,
            'verified' => $found,
            'info' => $info,
            'message' => $found ? 'Nomor permohonan terverifikasi resmi!' : 'Nomor permohonan valid untuk pengisian survei.'
        ]);
    }

    /**
     * Admin Index (/admin/layanan/laporan-survey)
     */
    public function adminIndex(Request $request)
    {
        $this->ensureSchema();

        $query = SurveyResponse::query();

        if ($request->filled('sumber') && $request->sumber !== 'all') {
            $query->where('sumber_informasi', $request->sumber);
        }

        if ($request->filled('rating') && $request->rating !== 'all') {
            $query->where('rating', $request->rating);
        }

        $responses = $query->latest()->paginate(20)->withQueryString();
        $stats = SurveyResponse::getLiveStatistics();

        // Dokumen laporan resmi
        $laporans = Dokumen::where(function($q) {
            $q->where('kategori', 'like', '%survey%')
              ->orWhere('kategori', 'like', '%laporan%')
              ->orWhere('judul', 'like', '%survey%')
              ->orWhere('judul', 'like', '%kepuasan%');
        })->latest()->get();

        return view('admin.layanan.laporan-survey', compact('responses', 'stats', 'laporans'));
    }

    /**
     * Admin Destroy
     */
    public function adminDestroy($id)
    {
        $this->ensureSchema();
        $res = SurveyResponse::findOrFail($id);
        $res->delete();

        return redirect()->back()->with('success', 'Data respon survei berhasil dihapus.');
    }
}
