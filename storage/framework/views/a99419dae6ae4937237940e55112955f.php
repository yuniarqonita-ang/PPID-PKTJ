<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-purple-100 p-8">
    <div class="space-y-8 max-w-full">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">
                Edit Profil PPID
            </h1>
            <p class="text-slate-500 mt-1">Kelola informasi profil PPID dengan editor lengkap</p>
        </div>
        <div class="flex items-center space-x-3">
            <button type="button" onclick="window.open('/profil', '_blank')" class="px-6 py-3 rounded-xl bg-gradient-to-r from-green-500 to-green-600 text-white font-bold hover:shadow-lg transition transform hover:scale-105">
                <i class="fas fa-eye mr-2"></i>Lihat Publik
            </button>
            <a href="<?php echo e(route('admin.profil.index')); ?>" class="px-6 py-3 rounded-xl bg-gradient-to-r from-gray-200 to-gray-300 text-gray-700 font-bold hover:shadow-lg transition transform hover:scale-105">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- ==================== FORM SECTION ==================== -->
    <div class="bg-gradient-to-br from-slate-50 to-slate-100 rounded-2xl shadow-xl p-8 border border-slate-200">
        <form action="<?php echo e(route('admin.profil.update', $profil->type)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
                
            <!-- JUDUL SECTION -->
            <div class="mb-8">
                <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                    <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 text-white flex items-center justify-center mr-3">
                        <i class="fas fa-heading text-sm"></i>
                    </span>
                    Judul Profil
                </label>
                <input type="text" name="judul" value="<?php echo e(old('judul', $profil->judul)); ?>" 
                       class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 bg-white shadow-sm"
                       placeholder="Masukkan judul profil" required>
            </div>

            <!-- SAMPUL SECTION -->
            <div class="mb-8">
                <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                    <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-purple-500 to-purple-600 text-white flex items-center justify-center mr-3">
                        <i class="fas fa-image text-sm"></i>
                    </span>
                    Sampul / Cover
                </label>
                <div class="relative group">
                    <div class="border-3 border-dashed border-slate-300 rounded-2xl p-8 text-center bg-white hover:border-blue-400 transition-all duration-300">
                        <?php if($profil->gambar): ?>
                            <div class="relative inline-block">
                                <img src="<?php echo e(asset('storage/profil/' . $profil->gambar)); ?>" alt="Sampul" class="mx-auto h-40 object-cover rounded-xl shadow-lg mb-4">
                                <div class="absolute top-2 right-2 w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                    <i class="fas fa-times text-xs"></i>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="text-slate-400 mb-4">
                                <div class="w-20 h-20 mx-auto rounded-full bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center">
                                    <i class="fas fa-image text-3xl"></i>
                                </div>
                                <p class="mt-3 text-sm font-medium">Belum ada gambar</p>
                                <p class="text-xs">Klik untuk upload</p>
                            </div>
                        <?php endif; ?>
                        <input type="file" name="gambar" accept="image/*" class="hidden" id="gambar" onchange="previewSampul(this)">
                        <button type="button" onclick="document.getElementById('gambar').click()" 
                                class="px-6 py-3 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-upload mr-2"></i>Pilih Gambar
                        </button>
                    </div>
                </div>
            </div>

            <!-- KONTEN UTAMA SECTION -->
            <div class="mb-8">
                <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                    <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-green-500 to-green-600 text-white flex items-center justify-center mr-3">
                        <i class="fas fa-edit text-sm"></i>
                    </span>
                    Konten
                </label>
                <div class="bg-white rounded-xl border-2 border-slate-200 shadow-inner">
                    <textarea id="summernote-editor" name="konten_pembuka" class="summernote-editor"><?php echo e(old('konten_pembuka', $profil->konten_pembuka)); ?></textarea>
                </div>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="flex justify-end space-x-4">
                <a href="<?php echo e(route('admin.profil.index')); ?>" class="px-8 py-4 rounded-xl bg-gradient-to-r from-gray-300 to-gray-400 text-gray-700 font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" class="px-8 py-4 rounded-xl bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- SUMMERNOTE SCRIPTS - 100% FREE -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-id-ID.js"></script>
<link rel="stylesheet" href="<?php echo e(asset('css/summernote-custom.css')); ?>">

<script>
$(document).ready(function() {
    // Initialize Summernote
    $('#summernote-editor').summernote({
        height: 500,
        lang: 'id-ID',
        placeholder: 'Tulis konten profil di sini...',
        toolbar: [
            ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph', 'height']],
            ['insert', ['picture', 'link', 'video', 'table', 'hr']],
            ['misc', ['fullscreen', 'codeview', 'undo', 'redo', 'help']]
        ],
        callbacks: {
            onImageUpload: function(files) {
                for (let i = 0; i < files.length; i++) {
                    uploadImage(files[i]);
                }
            },
            onInit: function() {
                console.log('Summernote initialized!');
            }
        }
    });

    // Image upload function
    function uploadImage(file) {
        const data = new FormData();
        data.append('image', file);
        
        // Show loading
        const loadingImg = $('<img>').attr('src', 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTAiIGhlaWdodD0iNTAiIHZpZXdCb3g9IjAgMCA1MCA1MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMjUiIGN5PSIyNSIgcj0iMjAiIHN0cm9rZT0iIzY2N2VlYSIgc3Ryb2tlLXdpZHRoPSI0IiBzdHJva2UtZGFzaGFycmF5PSI0IDQiPgo8L2NpcmNsZT4KPC9zdmc+').css('width', '50px');
        $('#summernote-editor').summernote('insertNode', loadingImg[0]);
        
        // Simulate upload
        setTimeout(() => {
            $('#summernote-editor').summernote('removeNode', loadingImg[0]);
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = $('<img>').attr('src', e.target.result).css('max-width', '100%');
                $('#summernote-editor').summernote('insertNode', img[0]);
            };
            reader.readAsDataURL(file);
        }, 1000);
    }
});
</script>
                } else {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'mx-auto h-32 object-cover rounded mb-4';
                    input.parentElement.insertBefore(img, input.parentElement.querySelector('.text-gray-400'));
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    console.log('Edit Profil PPID - Custom Editor Loaded');
});
</script>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PPID-PKTJ\resources\views/admin/profil/edit.blade.php ENDPATH**/ ?>