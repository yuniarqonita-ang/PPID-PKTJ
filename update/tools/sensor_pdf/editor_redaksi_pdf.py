"""
Editor Redaksi PDF — PPID PKTJ  (v3)
Fitur:
  ⬛  Sensor Hitam  — blok teks jadi hitam solid permanen
  🖍️  Highlight     — stabilo warna transparan (teks tetap terbaca, seperti Word)
  📦  Kotak Warna  — gambar kotak berwarna bebas
  ✏️  Edit Teks    — klik kata lalu ubah / perbaiki typo langsung di PDF
  💾  Flatten      — kunci jadi gambar permanen (tidak bisa dicopy/diedit)
"""

import tkinter as tk
from tkinter import ttk, filedialog, messagebox, simpledialog
import os, sys

try:
    import fitz
    from PIL import Image, ImageDraw, ImageTk
except ImportError as e:
    _r = tk.Tk(); _r.withdraw()
    messagebox.showerror("Library Belum Ada",
        f"{e}\n\nJalankan di CMD:\n  pip install PyMuPDF Pillow")
    sys.exit(1)

# ─── Tema ─────────────────────────────────────────────────────────────────────
C_BG    = "#1a1a2e"
C_PANEL = "#16213e"
C_CARD  = "#0f3460"
C_BLUE  = "#0066cc"
C_GREEN = "#16a34a"
C_AMBER = "#d97706"
C_TEXT  = "#e2e8f0"
C_MUTED = "#94a3b8"

# Palet warna (nama, hex-preview, tuple-rgb 0..1, alpha-highlight 0..255)
PALET = [
    ("⬛ Hitam",      "#111111", (0.0,  0.0,  0.0),  255),
    ("🟡 Kuning",     "#FFD600", (1.0,  0.84, 0.0),  255),
    ("🟢 Hijau",      "#00E676", (0.0,  0.90, 0.46), 255),
    ("🔵 Biru Muda",  "#40C4FF", (0.25, 0.77, 1.0),  255),
    ("🩷 Pink",       "#FF80AB", (1.0,  0.50, 0.67), 255),
    ("🟠 Oranye",     "#FF6D00", (1.0,  0.43, 0.0),  255),
    ("🔴 Merah",      "#F44336", (0.96, 0.26, 0.21), 255),
    ("⬜ Putih",      "#FFFFFF", (1.0,  1.0,  1.0),  255),
]


# ─────────────────────────────────────────────────────────────────────────────
class EditorRedaksiPDF:
    def __init__(self, root: tk.Tk):
        self.root = root
        self.root.title("✏️ Editor Redaksi PDF — PPID PKTJ")
        self.root.configure(bg=C_BG)
        try:
            self.root.state("zoomed")
        except Exception:
            pass

        self.doc:       fitz.Document | None = None
        self.path_file: str | None           = None
        self.hal_aktif: int                  = 0
        self.zoom:      float                = 1.5
        self.gambar_tk                       = None

        # ops[hal_idx] = list of operation dicts
        self.ops: dict[int, list[dict]] = {}

        self.mode      = tk.StringVar(value="sensor")
        self.warna_idx = tk.IntVar(value=0)

        self._drag_start = None
        self._rect_temp  = None

        self._build_ui()

    # ─────────────────────────────────────────────────────────────────────────
    #  UI
    # ─────────────────────────────────────────────────────────────────────────
    def _build_ui(self):
        def _btn(p, txt, cmd, bg=C_BLUE, fg="white", bold=False, **kw):
            f = ("Arial", 10, "bold") if bold else ("Arial", 10)
            return tk.Button(p, text=txt, command=cmd, bg=bg, fg=fg, font=f,
                             relief="flat", padx=9, pady=5, cursor="hand2",
                             activebackground=bg, **kw)

        # Toolbar
        tb = tk.Frame(self.root, bg=C_PANEL, pady=6)
        tb.pack(fill="x", side="top")

        _btn(tb, "📂 Buka PDF", self._buka, bold=True).pack(side="left", padx=(8,4))
        ttk.Separator(tb, orient="vertical").pack(side="left", fill="y", padx=5, pady=4)

        tk.Label(tb, text="Mode:", bg=C_PANEL, fg=C_MUTED,
                 font=("Arial", 9)).pack(side="left", padx=(4,2))

        modes = [
            ("⬛ Sensor Hitam",    "sensor",    "#1e3a8a"),
            ("🖍️ Highlight",       "highlight", "#92400e"),
            ("📦 Kotak Warna",     "kotak",     "#4c1d95"),
            ("✏️ Edit Teks",       "edit",      "#065f46"),
        ]
        for label, val, sc in modes:
            tk.Radiobutton(tb, text=label, variable=self.mode, value=val,
                           bg=C_PANEL, fg=C_TEXT, selectcolor=sc,
                           activebackground=C_PANEL, font=("Arial", 10, "bold"),
                           cursor="hand2", command=self._on_mode_change
                           ).pack(side="left", padx=4)

        ttk.Separator(tb, orient="vertical").pack(side="left", fill="y", padx=5, pady=4)
        _btn(tb, "↩️ Batalkan",        self._undo,       bg="#374151").pack(side="left", padx=3)
        _btn(tb, "🗑️ Hapus Hal. Ini", self._clear_page, bg="#374151").pack(side="left", padx=3)

        _btn(tb, "💾 Simpan + Flatten (Permanen)",
             self._save, bg=C_GREEN, bold=True).pack(side="right", padx=(4,10))
        _btn(tb, "🔒 Simpan Tanpa Flatten",
             lambda: self._save(flatten=False), bg=C_AMBER).pack(side="right", padx=4)

        # Baris Warna
        baris_w = tk.Frame(self.root, bg="#0d1117", pady=5)
        baris_w.pack(fill="x", side="top")

        tk.Label(baris_w, text=" 🎨 Warna:", bg="#0d1117", fg=C_MUTED,
                 font=("Arial", 9, "bold")).pack(side="left", padx=(10,4))

        self._warna_btns = []
        for i, (nama, hx, _, _a) in enumerate(PALET):
            b = tk.Button(baris_w, text=nama, bg="#1f2937", fg=C_TEXT,
                          font=("Arial", 9), relief="sunken" if i==0 else "flat",
                          padx=8, pady=3, cursor="hand2",
                          highlightbackground=hx, highlightthickness=3,
                          command=lambda idx=i: self._pilih_warna(idx))
            b.pack(side="left", padx=2)
            self._warna_btns.append(b)

        # Hint mode
        self.lbl_mode_hint = tk.Label(baris_w, text="", bg="#0d1117", fg="#fbbf24",
                                       font=("Arial", 9, "italic"))
        self.lbl_mode_hint.pack(side="right", padx=12)

        # Status bar
        sb = tk.Frame(self.root, bg=C_CARD, pady=4)
        sb.pack(fill="x", side="bottom")
        self.lbl_status = tk.Label(sb, text="Buka file PDF untuk memulai...",
                                   bg=C_CARD, fg=C_MUTED, font=("Arial", 9))
        self.lbl_status.pack(side="left", padx=10)
        self.lbl_count = tk.Label(sb, text="", bg=C_CARD, fg=C_TEXT,
                                  font=("Arial", 9, "bold"))
        self.lbl_count.pack(side="right", padx=10)

        # Konten
        main = tk.Frame(self.root, bg=C_BG)
        main.pack(fill="both", expand=True)

        # Panel kiri
        left = tk.Frame(main, bg=C_PANEL, width=180)
        left.pack(side="left", fill="y")
        left.pack_propagate(False)
        tk.Label(left, text="📄 Halaman", bg=C_PANEL, fg=C_TEXT,
                 font=("Arial", 10, "bold")).pack(pady=(12,4))
        lb_f = tk.Frame(left, bg=C_PANEL)
        lb_f.pack(fill="both", expand=True, padx=4)
        _sb2 = ttk.Scrollbar(lb_f)
        _sb2.pack(side="right", fill="y")
        self.listbox = tk.Listbox(lb_f, bg="#0d1117", fg=C_TEXT, font=("Arial",10),
                                   selectbackground=C_BLUE, relief="flat",
                                   borderwidth=0, yscrollcommand=_sb2.set,
                                   activestyle="none")
        self.listbox.pack(fill="both", expand=True)
        _sb2.config(command=self.listbox.yview)
        self.listbox.bind("<<ListboxSelect>>", self._on_page_sel)

        # Zoom
        zf = tk.Frame(left, bg=C_PANEL)
        zf.pack(pady=8, padx=6, fill="x")
        tk.Label(zf, text="Zoom:", bg=C_PANEL, fg=C_MUTED, font=("Arial",9)).pack(side="left")
        tk.Button(zf, text="−", command=self._zoom_out, bg="#1f2937", fg="white",
                  relief="flat", font=("Arial",11,"bold"), width=2,
                  cursor="hand2").pack(side="left", padx=2)
        self.lbl_zoom = tk.Label(zf, text="150%", bg=C_PANEL, fg=C_TEXT,
                                  font=("Arial",9), width=4)
        self.lbl_zoom.pack(side="left")
        tk.Button(zf, text="+", command=self._zoom_in, bg="#1f2937", fg="white",
                  relief="flat", font=("Arial",11,"bold"), width=2,
                  cursor="hand2").pack(side="left", padx=2)

        guide = (
            "ℹ️ Cara Pakai:\n\n"
            "⬛ Sensor:\nSeret → kotak hitam\nsolid (teks hilang)\n\n"
            "🖍️ Highlight:\nSeret → warna transparan\n(teks masih terbaca)\n\n"
            "📦 Kotak Warna:\nSeret bebas → kotak\nberwarna\n\n"
            "✏️ Edit Teks:\nKlik 1x di kata →\ndialog edit muncul\n\n"
            "↩️ = hapus aksi\nterakhir\n\n"
            "💾 + Flatten =\nkunci jadi gambar"
        )
        tk.Label(left, text=guide, bg=C_PANEL, fg=C_MUTED, font=("Arial",8),
                 justify="left", wraplength=162).pack(pady=4, padx=8, anchor="w")

        # Canvas
        right = tk.Frame(main, bg="#2d2d2d")
        right.pack(side="left", fill="both", expand=True)
        vs = ttk.Scrollbar(right, orient="vertical")
        vs.pack(side="right", fill="y")
        hs = ttk.Scrollbar(right, orient="horizontal")
        hs.pack(side="bottom", fill="x")
        self.canvas = tk.Canvas(right, bg="#2d2d2d", cursor="crosshair",
                                 xscrollcommand=hs.set, yscrollcommand=vs.set,
                                 highlightthickness=0)
        self.canvas.pack(fill="both", expand=True)
        vs.config(command=self.canvas.yview)
        hs.config(command=self.canvas.xview)

        self.canvas.create_text(400, 300,
            text="📂  Klik 'Buka PDF' untuk memulai",
            fill="#4b5563", font=("Arial",18), tags="hint")

        self.canvas.bind("<ButtonPress-1>",   self._md)
        self.canvas.bind("<B1-Motion>",        self._mm)
        self.canvas.bind("<ButtonRelease-1>",  self._mu)
        self.canvas.bind("<MouseWheel>",        self._scroll_v)
        self.canvas.bind("<Shift-MouseWheel>", self._scroll_h)

        self._on_mode_change()

    # ─────────────────────────────────────────────────────────────────────────
    #  UI HELPERS
    # ─────────────────────────────────────────────────────────────────────────
    def _pilih_warna(self, idx: int):
        self.warna_idx.set(idx)
        for i, b in enumerate(self._warna_btns):
            b.config(relief="sunken" if i == idx else "flat")

    def _on_mode_change(self):
        m = self.mode.get()
        hints = {
            "sensor":    "⬛ Klik & seret di teks untuk mensensor (jadi hitam solid)",
            "highlight": "🖍️ Klik & seret di teks untuk memberi highlight warna",
            "kotak":     "📦 Klik & seret untuk menggambar kotak berwarna bebas",
            "edit":      "✏️ Klik 1x di kata yang ingin diubah/diperbaiki",
        }
        self.lbl_mode_hint.config(text=hints.get(m, ""))
        cur = "xterm" if m in ("sensor","highlight","edit") else "crosshair"
        self.canvas.config(cursor=cur)

    def _warna_sekarang(self):
        nm, hx, rgb, alpha = PALET[self.warna_idx.get()]
        return hx, rgb, alpha

    # ─────────────────────────────────────────────────────────────────────────
    #  FILE
    # ─────────────────────────────────────────────────────────────────────────
    def _buka(self):
        path = filedialog.askopenfilename(
            title="Pilih File PDF",
            filetypes=[("PDF","*.pdf"), ("Semua","*.*")])
        if not path:
            return
        try:
            if self.doc:
                self.doc.close()
            self.doc       = fitz.open(path)
            self.path_file = path
            self.hal_aktif = 0
            self.ops       = {}
            self.listbox.delete(0, tk.END)
            for i in range(len(self.doc)):
                self.listbox.insert(tk.END, f"   Hal. {i+1}")
            self.listbox.selection_set(0)
            self._render()
            self.lbl_status.config(text=f"📄 {os.path.basename(path)}")
            self.root.title(f"✏️ Editor Redaksi PDF — {os.path.basename(path)}")
        except Exception as e:
            messagebox.showerror("Error", f"Gagal membuka:\n{e}")

    # ─────────────────────────────────────────────────────────────────────────
    #  RENDER — menggunakan PIL alpha-compositing (tidak ada stipple/dot)
    # ─────────────────────────────────────────────────────────────────────────
    def _render(self):
        if not self.doc:
            return
        hal = self.doc[self.hal_aktif]
        mat = fitz.Matrix(self.zoom, self.zoom)
        pix = hal.get_pixmap(matrix=mat, alpha=False)

        # Mulai dari gambar PDF asli
        base = Image.frombytes("RGB", [pix.width, pix.height], pix.samples).convert("RGBA")
        overlay = Image.new("RGBA", base.size, (0, 0, 0, 0))
        draw = ImageDraw.Draw(overlay)

        for op in self.ops.get(self.hal_aktif, []):
            r  = op["rect"]
            x0 = int(r.x0 * self.zoom)
            y0 = int(r.y0 * self.zoom)
            x1 = int(r.x1 * self.zoom)
            y1 = int(r.y1 * self.zoom)
            t  = op["type"]

            if t == "sensor":
                # Hitam solid — tidak ada label, tidak ada titik
                draw.rectangle([x0, y0, x1, y1], fill=(0, 0, 0, 255))

            elif t == "highlight":
                rgb_01 = op["color_rgb"]
                r_ = int(rgb_01[0] * 255)
                g_ = int(rgb_01[1] * 255)
                b_ = int(rgb_01[2] * 255)
                # Transparansi: teks masih terbaca (seperti stabilo Word)
                draw.rectangle([x0, y0, x1, y1],
                                fill=(r_, g_, b_, op["alpha"]))

            elif t == "kotak":
                rgb_01 = op["color_rgb"]
                r_ = int(rgb_01[0] * 255)
                g_ = int(rgb_01[1] * 255)
                b_ = int(rgb_01[2] * 255)
                draw.rectangle([x0, y0, x1, y1],
                                fill=(r_, g_, b_, op["alpha"]),
                                outline=(r_, g_, b_, 255),
                                width=2)

            elif t == "edit_text":
                # Kotak putih menutup teks lama + teks baru di atasnya
                draw.rectangle([x0, y0, x1, y1], fill=(255, 255, 255, 245))
                # Tampilkan teks baru di preview (sebagai placeholder)
                new_txt = op.get("new_text", "")
                if new_txt:
                    draw.text((x0 + 2, y0 + 1), new_txt, fill=(0, 0, 0, 255))

        result = Image.alpha_composite(base, overlay).convert("RGB")
        self.gambar_tk = ImageTk.PhotoImage(result)

        self.canvas.delete("all")
        self.canvas.config(scrollregion=(0, 0, pix.width, pix.height))
        self.canvas.create_image(0, 0, anchor="nw", image=self.gambar_tk, tags="pdf")
        self._refresh_count()
        self.lbl_zoom.config(text=f"{int(self.zoom*100)}%")

    def _refresh_count(self):
        total = sum(len(v) for v in self.ops.values())
        hal_n = len(self.ops.get(self.hal_aktif, []))
        if self.doc:
            self.lbl_count.config(
                text=f"Hal. {self.hal_aktif+1}/{len(self.doc)}  │  "
                     f"Hal. ini: {hal_n}  │  Total: {total} aksi")

    # ─────────────────────────────────────────────────────────────────────────
    #  MOUSE
    # ─────────────────────────────────────────────────────────────────────────
    def _cx(self, x):  return self.canvas.canvasx(x)
    def _cy(self, y):  return self.canvas.canvasy(y)
    def _p(self, cx, cy): return cx/self.zoom, cy/self.zoom

    def _md(self, e):
        if not self.doc:
            return
        if self.mode.get() == "edit":
            self._handle_edit_click(e)
            return
        self._drag_start = (self._cx(e.x), self._cy(e.y))

    def _mm(self, e):
        if not self.doc or not self._drag_start or self.mode.get() == "edit":
            return
        if self._rect_temp:
            self.canvas.delete(self._rect_temp)
        sx, sy = self._drag_start
        ex, ey = self._cx(e.x), self._cy(e.y)
        _, hx, _, _ = PALET[self.warna_idx.get()]
        color = "#111111" if self.mode.get() == "sensor" else hx
        self._rect_temp = self.canvas.create_rectangle(
            sx, sy, ex, ey, outline=color, width=2, dash=(5,3), tags="temp")

    def _mu(self, e):
        if not self.doc or not self._drag_start or self.mode.get() == "edit":
            return
        if self._rect_temp:
            self.canvas.delete(self._rect_temp); self._rect_temp = None

        sx, sy = self._drag_start
        ex, ey = self._cx(e.x), self._cy(e.y)
        self._drag_start = None

        x0, x1 = sorted([sx, ex])
        y0, y1 = sorted([sy, ey])
        if (x1-x0) < 4 or (y1-y0) < 4:
            return

        px0, py0 = self._p(x0, y0)
        px1, py1 = self._p(x1, y1)
        area = fitz.Rect(px0, py0, px1, py1)

        m = self.mode.get()
        _, rgb, alpha = self._warna_sekarang()

        if m == "sensor":
            final = self._snap_teks(area)
            op = {"type":"sensor", "rect":final,
                  "color_rgb":(0,0,0), "alpha":255}

        elif m == "highlight":
            final = self._snap_teks(area)
            op = {"type":"highlight", "rect":final,
                  "color_rgb":rgb, "alpha":alpha}

        else:  # kotak
            op = {"type":"kotak", "rect":area,
                  "color_rgb":rgb, "alpha":alpha}

        self.ops.setdefault(self.hal_aktif, []).append(op)
        self._render()

    # ─────────────────────────────────────────────────────────────────────────
    #  EDIT TEKS
    # ─────────────────────────────────────────────────────────────────────────
    def _handle_edit_click(self, e):
        """Klik di mode Edit: deteksi kata yang diklik → buka dialog edit."""
        px, py = self._p(self._cx(e.x), self._cy(e.y))
        hal    = self.doc[self.hal_aktif]
        words  = hal.get_text("words")  # (x0,y0,x1,y1,text,block,line,widx)

        target = None
        for w in words:
            wr = fitz.Rect(w[0], w[1], w[2], w[3])
            if wr.contains(fitz.Point(px, py)):
                target = w
                break

        if not target:
            # Coba cari kata terdekat dalam radius 5pt
            for w in words:
                wr = fitz.Rect(w[0]-5, w[1]-5, w[2]+5, w[3]+5)
                if wr.contains(fitz.Point(px, py)):
                    target = w
                    break

        if not target:
            self.lbl_status.config(text="⚠️ Tidak ada teks di area yang diklik.")
            return

        old_text = target[4]
        rect_kata = fitz.Rect(target[0], target[1], target[2], target[3])

        # Dialog edit
        dlg = tk.Toplevel(self.root)
        dlg.title("✏️ Edit Teks")
        dlg.configure(bg=C_BG)
        dlg.resizable(False, False)
        dlg.grab_set()

        tk.Label(dlg, text="Teks asli:", bg=C_BG, fg=C_MUTED,
                 font=("Arial",9)).grid(row=0, column=0, sticky="w", padx=12, pady=(12,2))
        tk.Label(dlg, text=old_text, bg=C_CARD, fg="#fbbf24",
                 font=("Consolas",11), padx=8, pady=4).grid(row=1, column=0, columnspan=2,
                                                              padx=12, sticky="ew")

        tk.Label(dlg, text="Teks baru:", bg=C_BG, fg=C_MUTED,
                 font=("Arial",9)).grid(row=2, column=0, sticky="w", padx=12, pady=(10,2))
        var_baru = tk.StringVar(value=old_text)
        entry = tk.Entry(dlg, textvariable=var_baru, font=("Consolas",13),
                          bg="#1f2937", fg="white", insertbackground="white",
                          relief="flat", width=30)
        entry.grid(row=3, column=0, columnspan=2, padx=12, pady=2, ipady=6, sticky="ew")
        entry.select_range(0, tk.END)
        entry.focus()

        # Deteksi fontsize dari blok teks
        fontsize = 11.0
        try:
            blok = hal.get_text("dict")
            for block in blok.get("blocks", []):
                for line in block.get("lines", []):
                    for span in line.get("spans", []):
                        sr = fitz.Rect(span["bbox"])
                        if sr.intersects(rect_kata):
                            fontsize = span.get("size", 11.0)
        except Exception:
            pass

        def _terapkan():
            baru = var_baru.get().strip()
            if baru == old_text:
                dlg.destroy(); return
            op = {
                "type":      "edit_text",
                "rect":      rect_kata,
                "old_text":  old_text,
                "new_text":  baru,
                "fontsize":  fontsize,
                "color_rgb": (0,0,0),
                "alpha":     255,
            }
            self.ops.setdefault(self.hal_aktif, []).append(op)
            self._render()
            self.lbl_status.config(text=f"✏️ '{old_text}' → '{baru}'")
            dlg.destroy()

        def _hapus():
            """Hapus kata sepenuhnya (sensor putih)."""
            op = {
                "type":      "edit_text",
                "rect":      rect_kata,
                "old_text":  old_text,
                "new_text":  "",
                "fontsize":  fontsize,
                "color_rgb": (0,0,0),
                "alpha":     255,
            }
            self.ops.setdefault(self.hal_aktif, []).append(op)
            self._render()
            dlg.destroy()

        btn_frame = tk.Frame(dlg, bg=C_BG)
        btn_frame.grid(row=4, column=0, columnspan=2, pady=12, padx=12, sticky="ew")
        tk.Button(btn_frame, text="✅ Terapkan", command=_terapkan,
                  bg=C_GREEN, fg="white", font=("Arial",10,"bold"),
                  relief="flat", padx=12, pady=5, cursor="hand2").pack(side="left", padx=4)
        tk.Button(btn_frame, text="🗑️ Hapus Kata", command=_hapus,
                  bg=C_AMBER, fg="white", font=("Arial",10),
                  relief="flat", padx=12, pady=5, cursor="hand2").pack(side="left", padx=4)
        tk.Button(btn_frame, text="✕ Batal", command=dlg.destroy,
                  bg="#374151", fg="white", font=("Arial",10),
                  relief="flat", padx=12, pady=5, cursor="hand2").pack(side="right", padx=4)

        entry.bind("<Return>", lambda _: _terapkan())
        entry.bind("<Escape>", lambda _: dlg.destroy())
        dlg.wait_window()

    # ─────────────────────────────────────────────────────────────────────────
    #  HELPERS
    # ─────────────────────────────────────────────────────────────────────────
    def _snap_teks(self, area: fitz.Rect) -> fitz.Rect:
        hal   = self.doc[self.hal_aktif]
        words = hal.get_text("words")
        rects = [fitz.Rect(w[0],w[1],w[2],w[3])
                 for w in words
                 if area.intersects(fitz.Rect(w[0],w[1],w[2],w[3]))]
        if not rects:
            return area
        merged = rects[0]
        for r in rects[1:]:
            merged = merged | r
        return merged + fitz.Rect(-1.5, -1.5, 1.5, 1.5)

    def _undo(self):
        lst = self.ops.get(self.hal_aktif, [])
        if lst:
            lst.pop(); self._render()
        else:
            self.lbl_status.config(text="Tidak ada aksi untuk dibatalkan.")

    def _clear_page(self):
        if not self.ops.get(self.hal_aktif): return
        if messagebox.askyesno("Hapus Semua", "Hapus semua aksi di halaman ini?"):
            self.ops[self.hal_aktif] = []; self._render()

    def _on_page_sel(self, _=None):
        sel = self.listbox.curselection()
        if sel and self.doc:
            self.hal_aktif = sel[0]; self._render()

    def _zoom_in(self):
        self.zoom = min(self.zoom+0.25, 4.0); self._render()

    def _zoom_out(self):
        self.zoom = max(self.zoom-0.25, 0.5); self._render()

    def _scroll_v(self, e):
        self.canvas.yview_scroll(int(-1*(e.delta/120)), "units")

    def _scroll_h(self, e):
        self.canvas.xview_scroll(int(-1*(e.delta/120)), "units")

    # ─────────────────────────────────────────────────────────────────────────
    #  SAVE
    # ─────────────────────────────────────────────────────────────────────────
    def _save(self, flatten: bool = True):
        if not self.doc:
            messagebox.showwarning("Peringatan", "Belum ada PDF yang dibuka!"); return
        total = sum(len(v) for v in self.ops.values())
        if total == 0:
            messagebox.showwarning("Peringatan", "Belum ada aksi yang diterapkan!"); return

        nama, _ = os.path.splitext(self.path_file)
        output  = filedialog.asksaveasfilename(
            defaultextension=".pdf",
            filetypes=[("PDF","*.pdf")],
            initialfile=os.path.basename(nama)+"_DIEDIT.pdf",
            title="Simpan File")
        if not output:
            return

        try:
            self.lbl_status.config(text="⏳ Memproses..."); self.root.update()

            for idx_hal, ops_list in self.ops.items():
                hal = self.doc[idx_hal]

                # 1. Sensor hitam (redact — hapus teks permanen)
                sensors = [op for op in ops_list if op["type"] == "sensor"]
                for op in sensors:
                    hal.add_redact_annot(op["rect"], fill=(0,0,0), cross_out=False)
                if sensors:
                    hal.apply_redactions()

                # 2. Edit teks — redact area lama lalu tulis teks baru
                edits = [op for op in ops_list if op["type"] == "edit_text"]
                for op in edits:
                    hal.add_redact_annot(op["rect"], fill=(1,1,1), cross_out=False)
                if edits:
                    hal.apply_redactions()
                for op in edits:
                    if op["new_text"]:
                        hal.insert_text(
                            fitz.Point(op["rect"].x0, op["rect"].y1 - 1),
                            op["new_text"],
                            fontsize=op["fontsize"],
                            color=(0,0,0),
                        )

                # 3. Highlight (annotasi PDF standar)
                for op in [o for o in ops_list if o["type"] == "highlight"]:
                    words = hal.get_text("words")
                    quads = [fitz.Rect(w[0],w[1],w[2],w[3]).quad
                             for w in words
                             if op["rect"].intersects(fitz.Rect(w[0],w[1],w[2],w[3]))]
                    annot = hal.add_highlight_annot(quads if quads else op["rect"].quad)
                    annot.set_colors(stroke=op["color_rgb"])
                    annot.set_opacity(op["alpha"] / 255)
                    annot.update()

                # 4. Kotak warna (gambar langsung ke halaman)
                for op in [o for o in ops_list if o["type"] == "kotak"]:
                    r = op["rect"]; rgb = op["color_rgb"]
                    shape = hal.new_shape()
                    shape.draw_rect(r)
                    shape.finish(color=rgb, fill=rgb,
                                 fill_opacity=op["alpha"]/255, width=1)
                    shape.commit()

            # Flatten atau simpan
            if flatten:
                doc_out = fitz.open()
                for i in range(len(self.doc)):
                    h   = self.doc[i]
                    pix = h.get_pixmap(matrix=fitz.Matrix(2,2), alpha=False)
                    nh  = doc_out.new_page(width=h.rect.width, height=h.rect.height)
                    nh.insert_image(nh.rect, stream=pix.tobytes("png"))
                doc_out.save(output, deflate=True)
                doc_out.close()
                msg_f = "✅ PDF dikunci jadi gambar permanen (Flatten aktif)."
            else:
                self.doc.save(output, deflate=True)
                msg_f = "⚠️ Flatten tidak aktif. PDF masih bisa diedit."

            self.lbl_status.config(text=f"✅ Tersimpan: {os.path.basename(output)}")
            messagebox.showinfo("✅ Berhasil!", f"Disimpan ke:\n{output}\n\n{msg_f}")

            self.doc.close()
            self.doc       = fitz.open(output)
            self.path_file = output
            self.ops       = {}
            self._render()

        except Exception as ex:
            messagebox.showerror("Error", f"Gagal menyimpan:\n{ex}")
            self.lbl_status.config(text="❌ Gagal menyimpan.")


# ─── Entry Point ──────────────────────────────────────────────────────────────
if __name__ == "__main__":
    root = tk.Tk()
    EditorRedaksiPDF(root)
    root.mainloop()
