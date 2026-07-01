Add-Type -AssemblyName System.IO.Compression
Add-Type -AssemblyName System.IO.Compression.FileSystem

$zipPath = "update.zip"
if (Test-Path $zipPath) { 
    Remove-Item $zipPath -Force 
}

$zip = [System.IO.Compression.ZipFile]::Open($zipPath, [System.IO.Compression.ZipArchiveMode]::Create)

$files = @(
    "app/Http/Controllers/DaftarInformasiController.php",
    "app/Providers/AppServiceProvider.php",
    "app/Http/Controllers/DokumenController.php",
    "app/Http/Controllers/InformasiBerkalaController.php",
    "app/Http/Controllers/InformasiDikecualikanController.php",
    "app/Http/Controllers/InformasiSertaMertaController.php",
    "app/Http/Controllers/InformasiSetiapSaatController.php",
    "app/Http/Controllers/InformasiPublikController.php",
    "app/Http/Controllers/BeritaController.php",
    "app/Http/Controllers/ProfilPublikController.php",
    "app/Http/Controllers/ProfilPpidController.php",
    "app/Http/Controllers/DashboardController.php",
    "app/Http/Controllers/HalamanCustomController.php",
    "app/Exceptions/Handler.php",
    "routes/web.php",
    "resources/views/admin/berita/create.blade.php",
    "resources/views/admin/berita/edit.blade.php",
    "resources/views/admin/agenda/create.blade.php",
    "resources/views/admin/agenda/edit.blade.php",
    "resources/views/admin/faq/create.blade.php",
    "resources/views/admin/faq/edit.blade.php",
    "resources/views/admin/profil/edit.blade.php",
    "resources/views/admin/dashboard/edit.blade.php",
    "resources/views/admin/informasi/berkala/create.blade.php",
    "resources/views/admin/informasi/berkala/edit.blade.php",
    "resources/views/admin/informasi/berkala/index.blade.php",
    "resources/views/admin/informasi/sertamerta/create.blade.php",
    "resources/views/admin/informasi/sertamerta/edit.blade.php",
    "resources/views/admin/informasi/setiapsaat/create.blade.php",
    "resources/views/admin/informasi/setiapsaat/edit.blade.php",
    "resources/views/admin/informasi/dikecualikan/create.blade.php",
    "resources/views/admin/informasi/dikecualikan/edit.blade.php",
    "resources/views/admin/informasi/dikecualikan/index.blade.php",
    "resources/views/admin/layanan/laporan-layanan.blade.php",
    "resources/views/admin/layanan/laporan-akses.blade.php",
    "resources/views/admin/layanan/laporan-survey.blade.php",
    "resources/views/admin/layanan/daftar-informasi-create.blade.php",
    "resources/views/admin/layanan/daftar-informasi-edit.blade.php",
    "resources/views/admin/dokumen/index.blade.php",
    "resources/views/admin/dokumen/create.blade.php",
    "resources/views/admin/dokumen/edit.blade.php",
    "resources/views/admin/dokumen/show.blade.php",
    "resources/views/admin/prosedur/sop-permintaan.blade.php",
    "resources/views/admin/prosedur/sop-keberatan.blade.php",
    "resources/views/admin/prosedur/sop-sengketa.blade.php",
    "resources/views/admin/prosedur/sop-penetapan.blade.php",
    "resources/views/admin/prosedur/sop-pengujian.blade.php",
    "resources/views/admin/prosedur/sop-pendokumentasian.blade.php",
    "database/migrations/2026_06_05_150000_seed_informasi_dikecualikan_data.php",
    "database/migrations/2026_06_05_160000_seed_daftar_informasi_data.php",
    "database/migrations/2026_06_08_000000_add_bisa_download_to_multiple_tables.php",
    "database/migrations/2026_06_08_010000_add_missing_fields_to_dokumens_table.php",
    "database/migrations/2026_06_09_000000_migrate_old_category_data_to_daftar_informasis.php",
    "database/migrations/2026_06_10_020000_update_scraped_links_to_daftar_informasi.php",
    "database/migrations/2026_06_10_030000_restructure_daftar_informasi_categories.php",
    "database/migrations/2026_06_10_040000_restore_original_daftar_informasi_categories.php",
    "database/migrations/2026_06_11_000000_seed_contact_social_media_links.php",
    "database/migrations/2026_06_11_010000_seed_and_deduplicate_scraped_ppid_docs.php",
    "database/migrations/2026_06_11_020000_add_scraped_sops_to_procedure_menu.php",
    "database/migrations/2026_06_11_030000_convert_sop_hardcoded_to_dokumens.php",
    "app/Models/Dokumen.php",
    "app/Models/DaftarInformasi.php",
    "app/Models/InformasiBerkala.php",
    "app/Models/InformasiDikecualikan.php",
    "app/Models/InformasiSertamerta.php",
    "app/Models/InformasiSetiapsaat.php",
    "resources/views/admin/dashboard.blade.php",
    "resources/views/admin/halaman/index.blade.php",
    "resources/views/admin/informasi/sertamerta/index.blade.php",
    "resources/views/admin/informasi/setiapsaat/index.blade.php",
    "resources/views/footer.blade.php",
    "resources/views/layouts/app.blade.php",
    "resources/views/navigation.blade.php",
    "resources/views/preview-dokumen.blade.php",
    "resources/views/components/konten-dinamis.blade.php",
    "resources/views/components/public-page-style.blade.php",
    "resources/views/admin/components/dokumen-list-admin.blade.php",
    "resources/views/laporan-layanan-informasi.blade.php",
    "resources/views/laporan-akses-informasi-publik.blade.php",
    "resources/views/laporan-survey-kepuasan.blade.php",
    "resources/views/sop-generic.blade.php",
    "resources/views/sop-permintaan.blade.php",
    "resources/views/sop-penanganan-keberatan.blade.php",
    "resources/views/sop-sengketa.blade.php",
    "resources/views/sop-pemutakhiran-daftar.blade.php",
    "resources/views/sop-pengujian-konsekuensi.blade.php",
    "resources/views/sop-pendokumentasian.blade.php",
    "resources/views/daftar-informasi-publik.blade.php",
    "resources/views/berita/index.blade.php",
    "resources/views/dokumen.blade.php",
    "resources/views/informasi-berkala.blade.php",
    "resources/views/informasi/berkala.blade.php",
    "resources/views/informasi-dikecualikan.blade.php",
    "resources/views/informasi-serta-merta.blade.php",
    "resources/views/informasi-setiap-saat.blade.php",
    "resources/views/profil-ppid.blade.php",
    "resources/views/profil-tugas-tanggung-jawab.blade.php",
    "resources/views/profil-visi-misi.blade.php",
    "resources/views/profil-struktur-organisasi.blade.php",
    "resources/views/profil-regulasi.blade.php",
    "resources/views/profil-kontak.blade.php",
    "resources/views/welcome.blade.php",
    "resources/views/dokumen/formulir-permohonan-cetak.blade.php",
    "resources/views/dokumen/formulir-keberatan-cetak.blade.php",
    "resources/views/dokumen/formulir-braille-cetak.blade.php",
    "resources/views/dokumen/laporan-braille.blade.php",
    "scratch/B1_B4_extracted.txt"
)

foreach ($file in $files) {
    if (Test-Path $file) {
        $entryName = $file.Replace('\', '/')
        [System.IO.Compression.ZipFileExtensions]::CreateEntryFromFile($zip, (Resolve-Path $file).Path, $entryName)
        Write-Host "Added entry: $entryName"
    } else {
        Write-Host "Warning: File not found: $file"
    }
}

$zip.Dispose()
Write-Host "Successfully built update.zip with forward slashes!"
