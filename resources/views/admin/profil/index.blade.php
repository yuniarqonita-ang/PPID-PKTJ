<x-app-layout>
    <div class="min-h-screen bg-gray-100 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header Halaman -->
            <div class="mb-8 flex justify-between items-center">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-800">Kelola Halaman Profil</h2>
                    <p class="text-gray-600 mt-1">Atur konten Profil, Tugas, dan Visi Misi dalam satu halaman.</p>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- BAGIAN 1: PROFIL UTAMA -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden mb-10 border-t-4 border-blue-600">
                    <div class="bg-blue-50 px-6 py-4 border-b border-blue-100 flex justify-between items-center">
                        <h3 class="text-white font-bold text-lg flex items-center">
                            <span class="bg-blue-600 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3 text-sm font-bold">1</span>
                            <span class="text-blue-800">Profil PPID (Utama)</span>
                        </h3>
                    </div>
                    <div class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-2 space-y-6">
                            <div>
                                <label class="block font-bold text-gray-700 mb-2">Judul Halaman</label>
                                <input type="text" name="judul" value="{{ old('judul', $profil->judul) }}" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" placeholder="Contoh: Profil PPID PKTJ">
                            </div>
                            <div>
                                <label class="block font-bold text-gray-700 mb-2">Deskripsi Profil</label>
                                <textarea id="editor1" name="konten_pembuka" rows="10" class="w-full border-gray-300 rounded-lg shadow-sm">{{ old('konten_pembuka', $profil->konten_pembuka) }}</textarea>
                            </div>
                        </div>
                        
                        <!-- Upload Gambar Profil -->
                        <div class="lg:col-span-1">
                            <label class="block font-bold text-gray-700 mb-2">Gambar Profil / Sampul</label>
                            <div class="border-2 border-dashed border-blue-300 rounded-xl p-4 text-center bg-blue-50 hover:bg-blue-100 transition cursor-pointer relative">
                                <input type="file" name="gambar" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="previewImage(event, 'preview-gambar')">
                                <div class="space-y-2">
                                    <img id="preview-gambar" src="{{ $profil->gambar ? asset('storage/profil/'.$profil->gambar) : 'https://via.placeholder.com/400x300?text=Upload+Gambar' }}" class="mx-auto h-48 object-cover rounded-lg shadow-md">
                                    <p class="text-sm text-blue-600 font-semibold">Klik untuk ganti gambar</p>
                                    <p class="text-xs text-gray-500">Format: JPG, PNG (Max 2MB)</p>
                                </div>
                            </div>
                            @if($profil->gambar)
                                <div class="mt-2 flex items-center justify-center">
                                    <input type="checkbox" name="hapus_gambar" value="1" id="hapus_gambar" class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                                    <label for="hapus_gambar" class="ml-2 text-sm text-red-600 font-medium">Hapus gambar saat ini?</label>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- BAGIAN 2: TUGAS & TANGGUNG JAWAB -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden mb-10 border-t-4 border-yellow-500">
                    <div class="bg-yellow-50 px-6 py-4 border-b border-yellow-100 flex justify-between items-center">
                        <h3 class="text-white font-bold text-lg flex items-center">
                            <span class="bg-yellow-500 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3 text-sm font-bold">2</span>
                            <span class="text-yellow-800">Tugas & Tanggung Jawab</span>
                        </h3>
                    </div>
                    <div class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-2 space-y-6">
                            <div>
                                <label class="block font-bold text-gray-700 mb-2">Judul Sub-Bagian</label>
                                <input type="text" name="judul_sub" value="{{ old('judul_sub', $profil->judul_sub) }}" class="w-full border-gray-300 rounded-lg focus:ring-yellow-500 focus:border-yellow-500 shadow-sm" placeholder="Contoh: Tugas dan Wewenang">
                            </div>
                            <div>
                                <label class="block font-bold text-gray-700 mb-2">Rincian Tugas (Tabel / Teks)</label>
                                <p class="text-xs text-gray-500 mb-2">Gunakan fitur tabel pada editor di bawah ini untuk membuat daftar tugas yang rapi.</p>
                                <textarea id="editor2" name="konten_detail" rows="10" class="w-full border-gray-300 rounded-lg shadow-sm">{{ old('konten_detail', $profil->konten_detail) }}</textarea>
                            </div>
                        </div>

                        <!-- Upload Gambar Tugas -->
                        <div class="lg:col-span-1">
                            <label class="block font-bold text-gray-700 mb-2">Gambar Struktur / Ilustrasi</label>
                            <div class="border-2 border-dashed border-yellow-300 rounded-xl p-4 text-center bg-yellow-50 hover:bg-yellow-100 transition cursor-pointer relative">
                                <input type="file" name="gambar_sub" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="previewImage(event, 'preview-gambar-sub')">
                                <div class="space-y-2">
                                    <img id="preview-gambar-sub" src="{{ $profil->gambar_sub ? asset('storage/profil/'.$profil->gambar_sub) : 'https://via.placeholder.com/400x300?text=Upload+Gambar' }}" class="mx-auto h-48 object-cover rounded-lg shadow-md">
                                    <p class="text-sm text-yellow-600 font-semibold">Klik untuk ganti gambar</p>
                                    <p class="text-xs text-gray-500">Format: JPG, PNG (Max 2MB)</p>
                                </div>
                            </div>
                            @if($profil->gambar_sub)
                                <div class="mt-2 flex items-center justify-center">
                                    <input type="checkbox" name="hapus_gambar_sub" value="1" id="hapus_gambar_sub" class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                                    <label for="hapus_gambar_sub" class="ml-2 text-sm text-red-600 font-medium">Hapus gambar saat ini?</label>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- BAGIAN 3: VISI & MISI -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden mb-10 border-t-4 border-green-600">
                    <div class="bg-green-50 px-6 py-4 border-b border-green-100 flex justify-between items-center">
                        <h3 class="text-white font-bold text-lg flex items-center">
                            <span class="bg-green-600 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3 text-sm font-bold">3</span>
                            <span class="text-green-800">Visi & Misi</span>
                        </h3>
                    </div>
                    <div class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-2 space-y-6">
                            <div>
                                <label class="block font-bold text-gray-700 mb-2">Judul Bagian</label>
                                <input type="text" name="judul_visi" value="{{ old('judul_visi', $profil->judul_visi) }}" class="w-full border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm" placeholder="Contoh: Visi dan Misi PPID">
                            </div>
                            <div>
                                <label class="block font-bold text-gray-700 mb-2">Konten Visi Misi (Poin-poin)</label>
                                <p class="text-xs text-gray-500 mb-2">Gunakan fitur <b>Bulleted List</b> atau <b>Numbered List</b> untuk membuat poin-poin visi misi.</p>
                                <textarea id="editor3" name="konten_visi" rows="10" class="w-full border-gray-300 rounded-lg shadow-sm">{{ old('konten_visi', $profil->konten_visi) }}</textarea>
                            </div>
                        </div>

                        <!-- Upload Gambar Visi -->
                        <div class="lg:col-span-1">
                            <label class="block font-bold text-gray-700 mb-2">Gambar Ilustrasi Visi</label>
                            <div class="border-2 border-dashed border-green-300 rounded-xl p-4 text-center bg-green-50 hover:bg-green-100 transition cursor-pointer relative">
                                <input type="file" name="gambar_visi" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="previewImage(event, 'preview-gambar-visi')">
                                <div class="space-y-2">
                                    <img id="preview-gambar-visi" src="{{ $profil->gambar_visi ? asset('storage/profil/'.$profil->gambar_visi) : 'https://via.placeholder.com/400x300?text=Upload+Gambar' }}" class="mx-auto h-48 object-cover rounded-lg shadow-md">
                                    <p class="text-sm text-green-600 font-semibold">Klik untuk ganti gambar</p>
                                    <p class="text-xs text-gray-500">Format: JPG, PNG (Max 2MB)</p>
                                </div>
                            </div>
                            @if($profil->gambar_visi)
                                <div class="mt-2 flex items-center justify-center">
                                    <input type="checkbox" name="hapus_gambar_visi" value="1" id="hapus_gambar_visi" class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                                    <label for="hapus_gambar_visi" class="ml-2 text-sm text-red-600 font-medium">Hapus gambar saat ini?</label>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-end pb-12">
                    <button type="submit" class="bg-gray-900 hover:bg-black text-white px-8 py-4 rounded-lg font-bold shadow-xl transform hover:-translate-y-1 transition duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        SIMPAN PERUBAHAN
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#editor1')).catch(error => { console.error(error); });
        ClassicEditor.create(document.querySelector('#editor2')).catch(error => { console.error(error); });
        ClassicEditor.create(document.querySelector('#editor3')).catch(error => { console.error(error); });

        function previewImage(event, targetId) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById(targetId);
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-app-layout>