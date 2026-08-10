"""
=================================================================
  SENSOR PDF OTOMATIS - PPID PKTJ
  Sesuai Regulasi:
  • UU No. 14 Tahun 2008 tentang Keterbukaan Informasi Publik
    (khususnya Pasal 17 - Informasi yang Dikecualikan)
  • PM Kemenhub No. 46 Tahun 2018 tentang Pedoman Pengelolaan
    Informasi dan Dokumentasi di Lingkungan Kementerian Perhubungan

  Versi: 2.0 - Legal Compliant
=================================================================
"""

import os
import re
import json
import threading
import tkinter as tk
from tkinter import ttk, filedialog, messagebox, scrolledtext
from pathlib import Path
import fitz  # PyMuPDF


# =================================================================
# KONFIGURASI SENSOR BERDASARKAN REGULASI
# =================================================================

# ──────────────────────────────────────────────────────────────────
# Sumber: UU No. 14 Tahun 2008 Pasal 17 Huruf H
# "Informasi yang dapat mengungkap RAHASIA PRIBADI"
# ──────────────────────────────────────────────────────────────────
PASAL_17H_PATTERNS = {
    # Pasal 17 huruf h angka 1 - Identitas Pribadi
    "NIK (Nomor Induk Kependudukan)": {
        "regex": r'\b\d{16}\b',
        "pasal": "Ps. 17h(1) UU KIP - Identitas Pribadi",
        "enabled": True,
    },
    "Nomor Kartu Keluarga (KK)": {
        "regex": r'\b\d{16}\b',
        "pasal": "Ps. 17h(1) UU KIP - Identitas Pribadi",
        "enabled": True,
    },
    "Nomor Paspor": {
        "regex": r'\b[A-Z]{1,2}[0-9]{6,7}\b',
        "pasal": "Ps. 17h(1) UU KIP - Identitas Pribadi",
        "enabled": True,
    },
    "Nomor Rekening Bank": {
        "regex": r'(?i)(?:rekening|rek\.?\s*bank|no\.?\s*rek)\s*[:\-]?\s*\b\d{10,16}\b',
        "pasal": "Ps. 17h(3) UU KIP - Kondisi Keuangan",
        "enabled": True,
    },
    "Nomor SIM": {
        "regex": r'(?i)(?:sim|no\.?\s*sim|nomor\s*sim)\s*[:\-]?\s*\b\d{12,14}\b',
        "pasal": "Ps. 17h(1) UU KIP - Identitas Pribadi",
        "enabled": True,
    },
    "Alamat Rumah (lengkap)": {
        "regex": r'(?i)(?<!transpo[rt]asi[ \t])(?:jl\.|jalan|gg\.|gang)[ \t]+[A-Za-z0-9\.\-]{3,30}(?:[ \t]+[A-Za-z0-9\.\-]{2,20}){0,2}[ \t]+(?:no\.?|nomor|blok|rt|rw)[ \t]*[a-zA-Z0-9\/\-]+',
        "pasal": "Ps. 17h(1) UU KIP - Identitas Pribadi (Alamat)",
        "enabled": False,  # Off by default - terlalu luas, aktifkan manual jika perlu
    },

    # Pasal 17 huruf h angka 2 - Data Kesehatan
    "Diagnosa/Rekam Medis (kata kunci)": {
        "regex": r'(?i)\b(diagnosa|diagnosis|rekam\s*medis|riwayat\s*penyakit|anamnesis|terapi|resep|golongan\s*darah|tekanan\s*darah|positif\s*[a-z]+|negatif\s*[a-z]+|suspect|konfirmasi\s*[a-z]+|pemeriksaan\s*jiwa|gangguan\s*mental)\b',
        "pasal": "Ps. 17h(2) UU KIP - Riwayat Kesehatan",
        "enabled": True,
    },

    # Pasal 17 huruf h angka 3 - Kondisi Keuangan
    "NPWP": {
        "regex": r'\b\d{2}\.\d{3}\.\d{3}\.\d{1}-\d{3}\.\d{3}\b',
        "pasal": "Ps. 17h(3) UU KIP - Kondisi Keuangan",
        "enabled": True,
    },
    "Nominal Gaji/Pendapatan": {
        "regex": r'(?i)(gaji\s*(pokok|bersih|kotor|net|bruto)?|tunjangan\s*\w+|take\s*home\s*pay|pendapatan\s*(bersih|kotor)|honor\w*|insentif|remunerasi)\s*[:\-]?\s*Rp\.?\s*[\d\.,]+',
        "pasal": "Ps. 17h(3) UU KIP - Kondisi Keuangan Pribadi",
        "enabled": True,
    },
    "Jumlah Rupiah (umum)": {
        "regex": r'\bRp\.?[ \t]*[\d]{3,}(?:[.,]\d+)*',
        "pasal": "Ps. 17h(3) UU KIP - Data Keuangan",
        "enabled": False,  # Off by default - terlalu luas
    },

    # Pasal 17 huruf h angka 4 - Hasil Evaluasi/Tes
    "Nilai/Skor Ujian Pribadi": {
        "regex": r'(?i)(nilai\s*(ujian|tes|seleksi|akhir|rata.?rata)|skor\s*(total|akhir|psikotes?|wawancara)|hasil\s*(tes|seleksi|ujian|evaluasi)|IPK|indeks\s*prestasi)\s*[:\-]?\s*[\d.,]+',
        "pasal": "Ps. 17h(4) UU KIP - Hasil Evaluasi Pribadi",
        "enabled": True,
    },
    "Peringkat/Ranking Individu": {
        "regex": r'(?i)(peringkat|ranking|rangking|urutan)\s*(ke)?\s*\d+',
        "pasal": "Ps. 17h(4) UU KIP - Hasil Evaluasi Pribadi",
        "enabled": True,
    },
}

# ──────────────────────────────────────────────────────────────────
# Sumber: UU KIP Pasal 17 Huruf G
# "Akta otentik yang bersifat pribadi"
# ──────────────────────────────────────────────────────────────────
PASAL_17G_PATTERNS = {
    "Nomor Akta Kelahiran/Nikah": {
        "regex": r'(?i)(akta\s*(kelahiran|nikah|kematian|cerai|waris)\s*(nomor|no\.?)\s*[\d/\-A-Z]+)',
        "pasal": "Ps. 17g UU KIP - Akta Otentik Pribadi",
        "enabled": True,
    },
}

# ──────────────────────────────────────────────────────────────────
# Sumber: UU KIP Pasal 17 Huruf A-F + PM Kemenhub 46/2018
# "Informasi yang membahayakan kepentingan umum"
# ──────────────────────────────────────────────────────────────────
PASAL_17AF_PM46_PATTERNS = {
    # PM 46/2018 - Kepegawaian Internal
    "Dokumen Hukuman Disiplin Pegawai": {
        "regex": r'(?i)(hukuman\s*disiplin|penjatuhan\s*hukuman|berita\s*acara\s*pemeriksaan|BAP\s*pegawai|keputusan\s*hukuman|sk\s*hukuman\s*disiplin)',
        "pasal": "PM 46/2018 - Data Disiplin Pegawai",
        "enabled": True,
    },
    "Proses Investigasi Internal": {
        "regex": r'(?i)(investigasi\s*internal|pemeriksaan\s*internal|laporan\s*investigasi|kronologi\s*kejadian\s*internal|dugaan\s*pelanggaran)',
        "pasal": "Ps. 17d UU KIP & PM 46/2018 - Proses Hukum",
        "enabled": True,
    },
    "Informasi Pengadaan Belum Final": {
        "regex": r'(?i)(harga\s*perkiraan\s*sendiri|HPS|rencana\s*umum\s*pengadaan\s*sebelum\s*diumumkan|spesifikasi\s*teknis\s*rahasia|negosiasi\s*harga)',
        "pasal": "Ps. 17b UU KIP & PM 46/2018 - Pengadaan",
        "enabled": True,
    },

    # Kontak Pribadi
    "Nomor HP / Telepon Pribadi": {
        "regex": r'\b(?:\+62|62|0)8[0-9]{8,11}\b',
        "pasal": "Ps. 17h(1) UU KIP - Identitas Pribadi",
        "enabled": True,
    },
    "Alamat Email": {
        "regex": r'\b[A-Za-z0-9._%+\-]+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}\b',
        "pasal": "Ps. 17h(1) UU KIP - Identitas Pribadi",
        "enabled": True,
    },
    "Tanggal Lahir": {
        "regex": r'(?i)(?:tgl\.?[ \t]*lahir|tanggal[ \t]*lahir|ttl|tempat.*tgl.*lahir)[: \t]+[A-Za-z0-9[ \t]\.\-,/]+|\b\d{2}[/\-\.](?:0[1-9]|1[0-2])[/\-\.](?:194[5-9]|19[5-9]\d|200\d|2010)\b',
        "pasal": "Ps. 17h(1) UU KIP - Identitas Pribadi",
        "enabled": True,
    },
    "Nama Ibu Kandung": {
        "regex": r'(?i)(nama\s*ibu\s*kandung|ibu\s*kandung\s*[:\-]|mother\'?s?\s*name)[:\s]+[A-Z][a-zA-Z\s]+',
        "pasal": "Ps. 17h(1) UU KIP - Identitas Pribadi",
        "enabled": True,
    },
}

# Gabungkan semua dalam satu dict untuk kemudahan
ALL_PATTERNS = {}
ALL_PATTERNS.update({f"[Ps.17h] {k}": v for k, v in PASAL_17H_PATTERNS.items()})
ALL_PATTERNS.update({f"[Ps.17g] {k}": v for k, v in PASAL_17G_PATTERNS.items()})
ALL_PATTERNS.update({f"[PM46+KIP] {k}": v for k, v in PASAL_17AF_PM46_PATTERNS.items()})

# FILE KONFIGURASI
CONFIG_FILE = os.path.join(os.path.dirname(os.path.abspath(__file__)), "config_sensor.json")

WARNA_HITAM = (0, 0, 0)


# =================================================================
# FUNGSI INTI: SENSOR PDF
# =================================================================

def load_config():
    default = {
        "active_patterns": {k: v["enabled"] for k, v in ALL_PATTERNS.items()},
        "custom_keywords": [],
        "flatten": True,
        "output_suffix": "_TERSENSOR",
        "sensor_gambar": True,
    }
    if os.path.exists(CONFIG_FILE):
        try:
            with open(CONFIG_FILE, "r", encoding="utf-8") as f:
                saved = json.load(f)
                default.update(saved)
        except Exception:
            pass
    return default


def save_config(config):
    with open(CONFIG_FILE, "w", encoding="utf-8") as f:
        json.dump(config, f, indent=2, ensure_ascii=False)


def sensor_satu_file(input_path, output_path, config, log_callback=None):
    def log(msg):
        if log_callback:
            log_callback(msg)

    try:
        doc = fitz.open(input_path)
        total_redaksi = 0
        active = config.get("active_patterns", {})

        # Kumpulkan pola yang aktif
        pola_aktif = []

        for nama, data in ALL_PATTERNS.items():
            if active.get(nama, data["enabled"]):
                pola_aktif.append((nama, data["regex"], data["pasal"]))

        # Kata kunci kustom
        for kw in config.get("custom_keywords", []):
            kw = kw.strip()
            if kw:
                pola_aktif.append((
                    f'Kustom: "{kw}"',
                    re.escape(kw),
                    "Kata kunci kustom pengguna"
                ))

        # Jika tidak ada pola aktif, tidak ada sensor gambar, dan tidak ada flatten, baru kita lewati
        if not pola_aktif and not config.get("sensor_gambar", True) and not config.get("flatten", True):
            log("  ⚠️  Tidak ada aksi aktif (pola teks, sensor gambar, atau perataan dinonaktifkan), lewati.")
            return 0, "Tidak ada aksi aktif"

        for nomor_hal, halaman in enumerate(doc, start=1):
            teks = halaman.get_text("text")
            for nama_pola, regex, pasal in pola_aktif:
                for cocok in re.finditer(regex, teks, re.IGNORECASE):
                    kata = cocok.group()
                    rects = halaman.search_for(kata)
                    for rect in rects:
                        halaman.add_redact_annot(rect, fill=WARNA_HITAM, cross_out=False)
                        total_redaksi += 1
                        preview = kata[:25] + "..." if len(kata) > 25 else kata
                        log(f"    🔒 Hal.{nomor_hal} | {nama_pola} | '{preview}'")

            # Auto-detect and censor signatures & QR codes (images in the lower portion of the page)
            if config.get("sensor_gambar", True):
                try:
                    for img in halaman.get_image_info():
                        bbox = img.get("bbox")
                        if bbox:
                            x0, y0, x1, y1 = bbox
                            w = x1 - x0
                            h = y1 - y0
                            # Heuristic for signature / QR code area
                            if (y0 > halaman.rect.height * 0.55 and 
                                w < halaman.rect.width * 0.7 and 
                                h < halaman.rect.height * 0.5 and 
                                w > 15 and h > 15):
                                rect = fitz.Rect(x0, y0, x1, y1)
                                halaman.add_redact_annot(rect, fill=WARNA_HITAM, cross_out=False)
                                total_redaksi += 1
                                log(f"    🔒 Hal.{nomor_hal} | Auto-Sensor Gambar (Ttd/QR) | Posisi: [{int(x0)}, {int(y0)}]")
                except Exception as e_img:
                    log(f"    ⚠️ Gagal memindai gambar pada Hal.{nomor_hal}: {str(e_img)}")

            halaman.apply_redactions()

        # === FLATTENING (Kunci Keamanan Utama) ===
        if config.get("flatten", True):
            log(f"  🔄 Flattening: Mengubah halaman menjadi gambar permanen...")
            doc_baru = fitz.open()
            for halaman in doc:
                mat = fitz.Matrix(200 / 72, 200 / 72)
                pix = halaman.get_pixmap(matrix=mat, alpha=False)
                hal_baru = doc_baru.new_page(
                    width=halaman.rect.width,
                    height=halaman.rect.height
                )
                hal_baru.insert_image(hal_baru.rect, pixmap=pix)
            doc_baru.save(output_path, garbage=4, deflate=True)
            doc_baru.close()
        else:
            doc.save(output_path, garbage=4, deflate=True)

        doc.close()
        return total_redaksi, "OK"

    except Exception as e:
        return -1, str(e)


def proses_batch(daftar_file, folder_output, config,
                 progress_callback=None, log_callback=None, selesai_callback=None):
    def log(msg):
        if log_callback:
            log_callback(msg)

    total = len(daftar_file)
    sukses = 0
    gagal = 0
    total_sensor = 0
    suffix = config.get("output_suffix", "_TERSENSOR")
    os.makedirs(folder_output, exist_ok=True)

    log(f"\n{'='*58}")
    log(f"  🚀 SENSOR PDF - PPID PKTJ  |  {total} file")
    log(f"  ⚖️  Dasar: UU KIP No.14/2008 + PM Kemenhub 46/2018")
    log(f"{'='*58}\n")

    for i, input_path in enumerate(daftar_file, start=1):
        nama = os.path.basename(input_path)
        output = os.path.join(folder_output, Path(input_path).stem + suffix + ".pdf")
        log(f"[{i}/{total}] 📄 {nama}")

        jumlah, pesan = sensor_satu_file(input_path, output, config, log_callback)

        if jumlah >= 0:
            sukses += 1
            total_sensor += jumlah
            log(f"  ✅ Selesai! {jumlah} item disensor.\n")
        else:
            gagal += 1
            log(f"  ❌ GAGAL: {pesan}\n")

        if progress_callback:
            progress_callback(i, total)

    log(f"\n{'='*58}")
    log(f"  🎉 SELESAI!")
    log(f"  ✅ Sukses        : {sukses} file")
    log(f"  ❌ Gagal         : {gagal} file")
    log(f"  🔒 Total disensor : {total_sensor} item")
    log(f"  📁 Output        : {folder_output}")
    log(f"{'='*58}\n")

    if selesai_callback:
        selesai_callback(sukses, gagal, total_sensor, folder_output)


# =================================================================
# GUI - ANTARMUKA GRAFIS
# =================================================================

class AplikasiSensorPDF:
    def __init__(self, root):
        self.root = root
        self.root.title("🔒 Sensor PDF Otomatis — PPID PKTJ")
        self.root.geometry("1000x780")
        self.root.configure(bg="#f0f4ff")
        self.root.resizable(True, True)

        self.config = load_config()
        self.daftar_file = []
        self.sedang_proses = False
        self.folder_hasil = ""

        self._buat_tampilan()

    def _buat_tampilan(self):
        # HEADER
        frame_header = tk.Frame(self.root, bg="#004a99", pady=15)
        frame_header.pack(fill="x")
        tk.Label(frame_header, text="🔒 SENSOR PDF OTOMATIS — PPID PKTJ",
                 font=("Arial", 18, "bold"), fg="white", bg="#004a99").pack()
        tk.Label(frame_header,
                 text="⚖️  Sesuai UU KIP No.14/2008 Pasal 17  •  PM Kemenhub No.46/2018",
                 font=("Arial", 9), fg="#ffc107", bg="#004a99").pack()

        self.notebook = ttk.Notebook(self.root)
        self.notebook.pack(fill="both", expand=True, padx=10, pady=10)

        self.tab_file = tk.Frame(self.notebook, bg="#f0f4ff")
        self.notebook.add(self.tab_file, text="  📂 Pilih File  ")
        self._buat_tab_file()

        self.tab_settings = tk.Frame(self.notebook, bg="#f0f4ff")
        self.notebook.add(self.tab_settings, text="  ⚖️ Pengaturan Sensor (Sesuai Regulasi)  ")
        self._buat_tab_settings()

        self.tab_kustom = tk.Frame(self.notebook, bg="#f0f4ff")
        self.notebook.add(self.tab_kustom, text="  ✏️ Kata Kunci Kustom  ")
        self._buat_tab_kustom()

        self.tab_proses = tk.Frame(self.notebook, bg="#f0f4ff")
        self.notebook.add(self.tab_proses, text="  ▶️ Proses & Log  ")
        self._buat_tab_proses()

    def _buat_tab_file(self):
        f = self.tab_file
        tk.Label(f, text="File PDF yang akan diproses:", font=("Arial", 11, "bold"),
                 bg="#f0f4ff", fg="#004a99").pack(anchor="w", padx=15, pady=(15, 5))

        fb = tk.Frame(f, bg="#f0f4ff")
        fb.pack(fill="x", padx=15, pady=5)
        for txt, cmd, col in [
            ("➕ Tambah File PDF", self._tambah_file, "#004a99"),
            ("📁 Tambah Seluruh Folder", self._tambah_folder, "#28a745"),
            ("🗑️ Hapus Semua", self._hapus_semua_file, "#dc3545"),
        ]:
            tk.Button(fb, text=txt, command=cmd, bg=col, fg="white",
                      font=("Arial", 10, "bold"), relief="flat",
                      padx=12, pady=7, cursor="hand2").pack(side="left", padx=(0, 5))

        frame_list = tk.Frame(f, bg="#f0f4ff")
        frame_list.pack(fill="both", expand=True, padx=15, pady=5)
        sb = tk.Scrollbar(frame_list)
        sb.pack(side="right", fill="y")
        self.listbox_file = tk.Listbox(frame_list, yscrollcommand=sb.set,
                                        font=("Consolas", 9), selectmode="extended",
                                        bg="white", fg="#1e293b", selectbackground="#004a99",
                                        relief="flat", bd=1)
        self.listbox_file.pack(fill="both", expand=True)
        sb.config(command=self.listbox_file.yview)

        self.label_jumlah = tk.Label(f, text="0 file dipilih",
                                      font=("Arial", 9), bg="#f0f4ff", fg="#64748b")
        self.label_jumlah.pack(anchor="w", padx=15, pady=3)

        tk.Label(f, text="Simpan hasil ke folder:", font=("Arial", 11, "bold"),
                 bg="#f0f4ff", fg="#004a99").pack(anchor="w", padx=15, pady=(10, 3))

        fo = tk.Frame(f, bg="#f0f4ff")
        fo.pack(fill="x", padx=15, pady=(0, 15))
        self.var_output = tk.StringVar(
            value=os.path.join(os.path.expanduser("~"), "Desktop", "PDF_Tersensor"))
        tk.Entry(fo, textvariable=self.var_output, font=("Arial", 10),
                 bg="white", relief="flat", bd=1).pack(side="left", fill="x",
                                                        expand=True, ipady=5, padx=(0, 5))
        tk.Button(fo, text="📂 Browse", command=self._pilih_output,
                  bg="#6c757d", fg="white", font=("Arial", 9, "bold"),
                  relief="flat", padx=10, pady=5, cursor="hand2").pack(side="right")

    def _buat_tab_settings(self):
        f = self.tab_settings

        # Scrollable frame
        canvas = tk.Canvas(f, bg="#f0f4ff", highlightthickness=0)
        scrollbar = ttk.Scrollbar(f, orient="vertical", command=canvas.yview)
        scroll_frame = tk.Frame(canvas, bg="#f0f4ff")
        scroll_frame.bind("<Configure>", lambda e: canvas.configure(
            scrollregion=canvas.bbox("all")))
        canvas.create_window((0, 0), window=scroll_frame, anchor="nw")
        canvas.configure(yscrollcommand=scrollbar.set)
        canvas.pack(side="left", fill="both", expand=True)
        scrollbar.pack(side="right", fill="y")

        # Bind mouse wheel
        def _on_mousewheel(event):
            canvas.yview_scroll(int(-1 * (event.delta / 120)), "units")
        canvas.bind_all("<MouseWheel>", _on_mousewheel)

        self.var_patterns = {}

        # Kelompokkan berdasarkan prefix
        groups = {
            "[Ps.17h]": ("⚠️ Pasal 17 Huruf H — Rahasia Pribadi",
                          "Meliputi: Identitas diri, data kesehatan, kondisi keuangan, hasil evaluasi\n"
                          "Dasar: UU KIP No.14/2008 Pasal 17 Huruf H"),
            "[Ps.17g]": ("📜 Pasal 17 Huruf G — Akta Otentik Pribadi",
                          "Meliputi: Akta kelahiran, nikah, kematian, waris\n"
                          "Dasar: UU KIP No.14/2008 Pasal 17 Huruf G"),
            "[PM46+KIP]": ("🏢 PM Kemenhub 46/2018 + UU KIP Pasal 17a-f",
                            "Meliputi: Dokumen disiplin pegawai, investigasi internal, pengadaan, kontak pribadi\n"
                            "Dasar: PM Kemenhub No.46 Tahun 2018 & UU KIP Pasal 17a-f"),
        }

        for prefix, (judul, keterangan) in groups.items():
            # Frame grup
            fg = tk.LabelFrame(scroll_frame, text=f" {judul} ",
                                font=("Arial", 10, "bold"), bg="#f0f4ff",
                                fg="#004a99", padx=10, pady=5)
            fg.pack(fill="x", padx=15, pady=8, ipady=5)

            tk.Label(fg, text=keterangan, font=("Arial", 8, "italic"),
                     bg="#f0f4ff", fg="#64748b", justify="left").pack(anchor="w", pady=(0, 8))

            for nama, data in ALL_PATTERNS.items():
                if not nama.startswith(prefix):
                    continue

                aktif = self.config.get("active_patterns", {}).get(nama, data["enabled"])
                var = tk.BooleanVar(value=aktif)
                self.var_patterns[nama] = var

                row = tk.Frame(fg, bg="#f0f4ff")
                row.pack(fill="x", pady=1)

                label_nama = nama.replace(prefix + " ", "")
                tk.Checkbutton(row, text=f"  {label_nama}",
                               variable=var, bg="#f0f4ff",
                               font=("Arial", 10), fg="#1e293b",
                               activebackground="#f0f4ff",
                               cursor="hand2").pack(side="left")
                tk.Label(row, text=f"({data['pasal']})",
                         font=("Arial", 8), fg="#94a3b8", bg="#f0f4ff").pack(side="left", padx=5)

        # Opsi Sensor Gambar (Tanda Tangan & QR Code)
        fg_img = tk.LabelFrame(scroll_frame, text=" 🖊️ Sensor Gambar Otomatis ",
                               font=("Arial", 10, "bold"), bg="#f0f4ff",
                               fg="#16a34a", padx=10, pady=5)
        fg_img.pack(fill="x", padx=15, pady=8, ipady=5)

        tk.Label(fg_img, text="Meliputi: Gambar scan tanda tangan basah dan Kode QR (barcode 2D) di bagian bawah dokumen.",
                 font=("Arial", 8, "italic"), bg="#f0f4ff", fg="#64748b", justify="left").pack(anchor="w", pady=(0, 8))

        self.var_sensor_gambar = tk.BooleanVar(value=self.config.get("sensor_gambar", True))
        tk.Checkbutton(fg_img,
                       text="  Sensor Otomatis Tanda Tangan & Kode QR di Area Bawah (Disarankan)",
                       variable=self.var_sensor_gambar, bg="#f0f4ff",
                       font=("Arial", 10, "bold"), fg="#1e293b",
                       activebackground="#f0f4ff", cursor="hand2").pack(anchor="w")

        # Opsi lanjutan (Flatten & Suffix)
        fl = tk.LabelFrame(scroll_frame, text=" ⚙️ Opsi Keamanan & Output ", font=("Arial", 10, "bold"),
                            bg="#f0f4ff", fg="#004a99")
        fl.pack(fill="x", padx=15, pady=5)

        self.var_flatten = tk.BooleanVar(value=self.config.get("flatten", True))
        tk.Checkbutton(fl,
                       text="  🛡️ FLATTEN — Ubah PDF ke Gambar Permanen (WAJIB untuk keamanan maksimal)",
                       variable=self.var_flatten, bg="#f0f4ff",
                       font=("Arial", 10, "bold"), fg="#004a99",
                       activebackground="#f0f4ff", cursor="hand2").pack(anchor="w", pady=5, padx=5)

        rs = tk.Frame(fl, bg="#f0f4ff")
        rs.pack(anchor="w", pady=5, padx=5)
        tk.Label(rs, text="Nama tambahan file output:", font=("Arial", 10), bg="#f0f4ff").pack(side="left")
        self.var_suffix = tk.StringVar(value=self.config.get("output_suffix", "_TERSENSOR"))
        tk.Entry(rs, textvariable=self.var_suffix, width=18,
                 font=("Arial", 10), bg="white", relief="flat", bd=1).pack(side="left", padx=10, ipady=3)
        tk.Label(rs, text="→ Contoh: Dokumen.pdf ➡ Dokumen_TERSENSOR.pdf",
                 font=("Arial", 9, "italic"), bg="#f0f4ff", fg="#64748b").pack(side="left")

        # Tombol simpan di bawah
        tk.Button(scroll_frame, text="💾 Simpan Pengaturan Sensor",
                  command=self._simpan_pengaturan,
                  bg="#ffc107", fg="#004a99", font=("Arial", 11, "bold"),
                  relief="flat", padx=20, pady=8, cursor="hand2").pack(pady=15)

    def _buat_tab_kustom(self):
        f = self.tab_kustom
        tk.Label(f, text="✏️ Kata Kunci Kustom Tambahan",
                 font=("Arial", 13, "bold"), bg="#f0f4ff", fg="#004a99").pack(anchor="w", padx=15, pady=(15, 3))
        tk.Label(f,
                 text="Tambahkan kata kunci spesifik sesuai kebutuhan dokumen PKTJ.\n"
                      "Contoh: nama institusi tertentu, kode rahasia, nama orang.\n"
                      "Tulis 1 kata kunci per baris.",
                 font=("Arial", 9), bg="#f0f4ff", fg="#64748b", justify="left").pack(anchor="w", padx=15)

        self.text_keywords = scrolledtext.ScrolledText(
            f, height=15, font=("Consolas", 11), bg="white", relief="flat", bd=1)
        self.text_keywords.pack(fill="both", expand=True, padx=15, pady=10)

        # Muat dari config
        kws = self.config.get("custom_keywords", [])
        if kws:
            self.text_keywords.insert("1.0", "\n".join(kws))

        # (Opsi Lanjutan & Simpan moved to Settings Tab for single page controls)

    def _buat_tab_proses(self):
        f = self.tab_proses

        fp = tk.Frame(f, bg="#f0f4ff")
        fp.pack(fill="x", padx=15, pady=(15, 5))
        self.label_progress = tk.Label(fp, text="Siap memproses...",
                                        font=("Arial", 10), bg="#f0f4ff", fg="#64748b")
        self.label_progress.pack(anchor="w")
        self.progress_bar = ttk.Progressbar(fp, mode="determinate")
        self.progress_bar.pack(fill="x", pady=5)

        self.btn_mulai = tk.Button(f,
                                    text="▶️  MULAI SENSOR PDF SEKARANG",
                                    command=self._mulai_proses,
                                    bg="#004a99", fg="white",
                                    font=("Arial", 14, "bold"),
                                    relief="flat", padx=30, pady=15, cursor="hand2")
        self.btn_mulai.pack(pady=8)

        self.btn_buka = tk.Button(f, text="📂 Buka Folder Hasil",
                                   command=self._buka_folder,
                                   bg="#28a745", fg="white",
                                   font=("Arial", 10, "bold"),
                                   relief="flat", padx=15, pady=7,
                                   cursor="hand2", state="disabled")
        self.btn_buka.pack(pady=3)

        tk.Label(f, text="📋 Log Proses:", font=("Arial", 10, "bold"),
                 bg="#f0f4ff", fg="#004a99").pack(anchor="w", padx=15, pady=(10, 3))

        self.log_area = scrolledtext.ScrolledText(
            f, height=22, font=("Consolas", 9),
            bg="#0f172a", fg="#86efac",
            insertbackground="white", relief="flat", bd=0,
            state="disabled")
        self.log_area.pack(fill="both", expand=True, padx=15, pady=(0, 15))

    # ── HANDLERS ──────────────────────────────────────────────────

    def _tambah_file(self):
        paths = filedialog.askopenfilenames(title="Pilih File PDF",
                                             filetypes=[("PDF", "*.pdf"), ("Semua", "*.*")])
        for p in paths:
            if p not in self.daftar_file:
                self.daftar_file.append(p)
                self.listbox_file.insert("end", p)
        self._update_jml()

    def _tambah_folder(self):
        folder = filedialog.askdirectory(title="Pilih Folder Berisi PDF")
        if folder:
            n = 0
            for root_dir, _, files in os.walk(folder):
                for f in files:
                    if f.lower().endswith(".pdf"):
                        fp = os.path.join(root_dir, f)
                        if fp not in self.daftar_file:
                            self.daftar_file.append(fp)
                            self.listbox_file.insert("end", fp)
                            n += 1
            self._update_jml()
            messagebox.showinfo("Folder Dipindai", f"✅ {n} file PDF ditemukan!")

    def _hapus_semua_file(self):
        self.daftar_file.clear()
        self.listbox_file.delete(0, "end")
        self._update_jml()

    def _pilih_output(self):
        folder = filedialog.askdirectory(title="Pilih Folder Output")
        if folder:
            self.var_output.set(folder)

    def _update_jml(self):
        self.label_jumlah.config(text=f"{len(self.daftar_file)} file dipilih")

    def _simpan_pengaturan(self):
        # Pola regulasi
        self.config["active_patterns"] = {k: v.get() for k, v in self.var_patterns.items()}
        # Kata kunci kustom
        raw = self.text_keywords.get("1.0", "end").strip()
        self.config["custom_keywords"] = [k.strip() for k in raw.split("\n") if k.strip()]
        # Opsi
        self.config["flatten"] = self.var_flatten.get()
        self.config["sensor_gambar"] = self.var_sensor_gambar.get()
        self.config["output_suffix"] = self.var_suffix.get()
        save_config(self.config)
        messagebox.showinfo("✅ Tersimpan", "Pengaturan berhasil disimpan!")

    def _log(self, msg):
        def _do():
            self.log_area.config(state="normal")
            self.log_area.insert("end", msg + "\n")
            self.log_area.see("end")
            self.log_area.config(state="disabled")
        self.root.after(0, _do)

    def _update_progress(self, current, total):
        pct = int((current / total) * 100) if total else 0
        def _do():
            self.progress_bar["value"] = pct
            self.label_progress.config(
                text=f"Memproses {current}/{total} file ({pct}%)...")
        self.root.after(0, _do)

    def _selesai(self, sukses, gagal, total_sensor, folder_output):
        self.folder_hasil = folder_output
        def _do():
            self.sedang_proses = False
            self.btn_mulai.config(state="normal", text="▶️  MULAI SENSOR PDF SEKARANG")
            self.btn_buka.config(state="normal")
            self.label_progress.config(text=f"🎉 Selesai! {sukses} sukses, {gagal} gagal.")
            self.progress_bar["value"] = 100
            messagebox.showinfo("🎉 Proses Selesai!",
                                f"SENSOR PDF BERHASIL!\n\n"
                                f"✅ File Sukses   : {sukses}\n"
                                f"❌ File Gagal    : {gagal}\n"
                                f"🔒 Total Sensor  : {total_sensor} item\n"
                                f"⚖️  Dasar Hukum  : UU KIP + PM 46/2018\n\n"
                                f"📁 Hasil: {folder_output}\n\n"
                                f"File AMAN untuk di-upload ke Google Drive!")
        self.root.after(0, _do)

    def _buka_folder(self):
        if self.folder_hasil and os.path.exists(self.folder_hasil):
            os.startfile(self.folder_hasil)

    def _mulai_proses(self):
        if self.sedang_proses:
            return
        if not self.daftar_file:
            messagebox.showwarning("⚠️", "Tambahkan file PDF terlebih dahulu!")
            return

        self._simpan_pengaturan()
        folder_out = self.var_output.get().strip()
        if not folder_out:
            messagebox.showwarning("⚠️", "Tentukan folder output terlebih dahulu!")
            return

        n = len(self.daftar_file)
        flatten_info = "✅ AKTIF (100% Aman)" if self.config.get("flatten", True) else "❌ TIDAK AKTIF"
        if not messagebox.askyesno("Konfirmasi",
                                    f"Siap memproses {n} file PDF.\n\n"
                                    f"🛡️ Flatten: {flatten_info}\n"
                                    f"📁 Output : {folder_out}\n\n"
                                    f"Lanjutkan?"):
            return

        self.sedang_proses = True
        self.btn_mulai.config(state="disabled", text="⏳ Sedang Memproses...")
        self.progress_bar["value"] = 0
        self.notebook.select(self.tab_proses)

        threading.Thread(
            target=proses_batch,
            args=(self.daftar_file.copy(), folder_out,
                  self.config.copy(), self._update_progress,
                  self._log, self._selesai),
            daemon=True
        ).start()


# =================================================================
if __name__ == "__main__":
    root = tk.Tk()
    app = AplikasiSensorPDF(root)
    root.mainloop()
