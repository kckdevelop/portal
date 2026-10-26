@extends('layouts.admin')

@section('title', $isEdit ? 'Edit Karya Siswa' : 'Tambah Karya Siswa Baru')
@section('header_title', $isEdit ? 'Edit Data Karya Siswa' : 'Tambah Karya Siswa Baru')
@section('header_subtitle', $isEdit ? 'Perbarui informasi, jurusan, dan galeri foto karya siswa' : 'Daftarkan karya baru ke pameran expo vokasi')

@push('styles')
<!-- Quill.js Snow Theme CSS -->
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
<style>
    /* Microsoft Word Ribbon & Paper Document Styling */
    #wordRibbonToolbar {
        border: none !important;
        border-bottom: 1px solid #cbd5e1 !important;
        background-color: #f8fafc;
        padding: 8px 12px;
    }
    #wordRibbonToolbar .ql-formats {
        margin-right: 10px;
        padding-right: 10px;
        border-right: 1px solid #e2e8f0;
    }
    #wordRibbonToolbar button,
    #wordRibbonToolbar .ql-picker-label {
        border-radius: 6px;
        transition: all 0.15s ease;
    }
    #wordRibbonToolbar button:hover,
    #wordRibbonToolbar .ql-picker-label:hover {
        background-color: #e2e8f0;
        color: #185abd;
    }
    #wordRibbonToolbar .ql-active {
        background-color: #dbeafe !important;
        color: #185abd !important;
    }
    #quillEditorContainer.ql-container.ql-snow {
        border: none !important;
        font-family: 'Plus Jakarta Sans', Calibri, 'Segoe UI', Arial, sans-serif;
    }
    #quillEditorContainer .ql-editor {
        min-height: 280px;
        font-size: 14.5px;
        line-height: 1.75;
        color: #0f172a;
        padding: 22px 28px;
    }
    #quillEditorContainer .ql-editor.ql-blank::before {
        color: #94a3b8;
        font-style: italic;
        left: 28px;
    }
</style>
@endpush

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-xl overflow-hidden p-6 sm:p-8">
        
        <form action="{{ $isEdit ? route('admin.karya.update', $karya) : route('admin.karya.store') }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="space-y-6">
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif

            <!-- Section 1: Informasi Dasar -->
            <div class="border-b border-slate-800 pb-4">
                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-circle-info text-cyan-400"></i> Informasi Utama Karya
                </h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Judul, identitas siswa pembuat, dan program keahlian / jurusan</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Judul Karya -->
                <div class="md:col-span-2">
                    <label for="title" class="block text-xs font-semibold text-slate-300 mb-1.5">
                        Judul Alat / Aplikasi / Karya <span class="text-rose-400">*</span>
                    </label>
                    <input type="text" id="title" name="title" required
                        value="{{ old('title', $karya->title) }}"
                        placeholder="Contoh: Smart EFI Engine Trainer OBD-II / SiBatik Marketplace"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all">
                </div>

                <!-- Program Keahlian / Jurusan -->
                <div>
                    <label for="jurusan" class="block text-xs font-semibold text-slate-300 mb-1.5">
                        Program Keahlian / Jurusan <span class="text-rose-400">*</span>
                    </label>
                    <select id="jurusan" name="jurusan" required
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all">
                        @foreach($jurusanList as $code => $info)
                            <option value="{{ $code }}" {{ old('jurusan', $karya->jurusan) === $code ? 'selected' : '' }}>
                                {{ $code }} &bull; {{ $info['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Kelas Siswa -->
                <div>
                    <label for="student_class" class="block text-xs font-semibold text-slate-300 mb-1.5">
                        Kelas Siswa <span class="text-rose-400">*</span>
                    </label>
                    <input type="text" id="student_class" name="student_class" required
                        value="{{ old('student_class', $karya->student_class ?? 'XII PPLG 1') }}"
                        placeholder="Contoh: XII TKR 1, XII TSM 2, XII TPM, XII TAV, XII PPLG"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all">
                </div>

                <!-- Nama Siswa Pembuat -->
                <div>
                    <label for="student_name" class="block text-xs font-semibold text-slate-300 mb-1.5">
                        Nama Siswa / Tim Pembuat <span class="text-rose-400">*</span>
                    </label>
                    <input type="text" id="student_name" name="student_name" required
                        value="{{ old('student_name', $karya->student_name) }}"
                        placeholder="Contoh: Fajar Santoso & Tim Otomotif"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all">
                </div>

                <!-- Urutan Tampilan (Order) -->
                <div>
                    <label for="order" class="block text-xs font-semibold text-slate-300 mb-1.5">
                        Urutan Tampilan (Angka Kecil Tampil Lebih Dulu)
                    </label>
                    <input type="number" id="order" name="order" min="0"
                        value="{{ old('order', $karya->order ?? 0) }}"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all">
                </div>

                <!-- Deskripsi Lengkap dengan Tampilan Word -->
                <div class="md:col-span-2 space-y-2">
                    <div class="flex items-center justify-between">
                        <label class="block text-xs font-semibold text-slate-300">
                            Deskripsi Lengkap & Inovasi Karya <span class="text-rose-400">*</span>
                        </label>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-blue-950/80 border border-blue-500/40 text-[11px] font-semibold text-blue-300">
                            <i class="fa-solid fa-file-word text-blue-400"></i> Mode Editor Word
                        </span>
                    </div>

                    <!-- Microsoft Word Styled Container -->
                    <div class="rounded-2xl border border-slate-700 bg-slate-900 overflow-hidden shadow-2xl">
                        
                        <!-- 1. Word Header Bar (Classic Word Blue) -->
                        <div class="bg-[#185abd] text-white px-4 py-2.5 flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <div class="w-6 h-6 rounded bg-white/20 flex items-center justify-center font-bold text-xs shadow-inner">
                                    <i class="fa-solid fa-file-word text-white"></i>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-xs tracking-wide">Dokumen Deskripsi Karya</span>
                                    <span class="text-[10px] bg-blue-700/80 px-2 py-0.5 rounded text-blue-100 font-mono">Word Editor</span>
                                </div>
                            </div>

                            <!-- Live Word & Char Statistics -->
                            <div class="flex items-center gap-3 text-xs text-blue-100 font-medium">
                                <span class="flex items-center gap-1">
                                    <i class="fa-solid fa-i-cursor text-[10px] text-blue-300"></i>
                                    <strong id="wordCounter" class="text-white">0</strong> kata
                                </span>
                                <span class="text-blue-300/60">&bull;</span>
                                <span><strong id="charCounter" class="text-white">0</strong> karakter</span>
                            </div>
                        </div>

                        <!-- 2. Word Ribbon Toolbar -->
                        <div id="wordRibbonToolbar" class="flex flex-wrap items-center">
                            <!-- Group 1: Undo / Redo -->
                            <span class="ql-formats">
                                <button type="button" id="btnUndo" title="Urungkan (Undo - Ctrl+Z)">
                                    <i class="fa-solid fa-rotate-left text-xs"></i>
                                </button>
                                <button type="button" id="btnRedo" title="Ulangi (Redo - Ctrl+Y)">
                                    <i class="fa-solid fa-rotate-right text-xs"></i>
                                </button>
                            </span>

                            <!-- Group 2: Headings / Style -->
                            <span class="ql-formats">
                                <select class="ql-header" title="Gaya Teks">
                                    <option value="1">Judul 1 (H1)</option>
                                    <option value="2">Judul 2 (H2)</option>
                                    <option value="3">Judul 3 (H3)</option>
                                    <option selected>Teks Normal</option>
                                </select>
                            </span>

                            <!-- Group 3: Basic Formatting -->
                            <span class="ql-formats">
                                <button class="ql-bold" title="Tebal (Ctrl+B)"></button>
                                <button class="ql-italic" title="Miring (Ctrl+I)"></button>
                                <button class="ql-underline" title="Garis Bawah (Ctrl+U)"></button>
                                <button class="ql-strike" title="Coretan"></button>
                            </span>

                            <!-- Group 4: Colors -->
                            <span class="ql-formats">
                                <select class="ql-color" title="Warna Huruf"></select>
                                <select class="ql-background" title="Warna Sorotan (Highlight)"></select>
                            </span>

                            <!-- Group 5: Alignment -->
                            <span class="ql-formats">
                                <select class="ql-align" title="Perataan Paragraf"></select>
                            </span>

                            <!-- Group 6: Lists & Indent -->
                            <span class="ql-formats">
                                <button class="ql-list" value="ordered" title="Penomoran Angka"></button>
                                <button class="ql-list" value="bullet" title="Daftar Poin"></button>
                                <button class="ql-indent" value="-1" title="Geser Kiri (Outdent)"></button>
                                <button class="ql-indent" value="+1" title="Geser Kanan (Indent)"></button>
                            </span>

                            <!-- Group 7: Blockquote, Code & Clean -->
                            <span class="ql-formats">
                                <button class="ql-blockquote" title="Kutipan"></button>
                                <button class="ql-link" title="Sisipkan Link Web"></button>
                                <button class="ql-clean" title="Hapus Format"></button>
                            </span>
                        </div>

                        <!-- 3. Word Paper Sheet Workspace (Canvas) -->
                        <div class="bg-[#eaeef3] p-4 sm:p-7 flex justify-center">
                            <!-- Paper Page -->
                            <div class="w-full max-w-3xl bg-white text-slate-900 rounded-lg shadow-lg border border-slate-300 min-h-[300px] relative">
                                <!-- Top Paper Ruler Guide -->
                                <div class="h-1 bg-slate-200 border-b border-slate-300 rounded-t-lg"></div>

                                <!-- Quill Edit Container -->
                                <div id="quillEditorContainer">
                                    {!! old('description', $karya->description) !!}
                                </div>
                            </div>
                        </div>

                        <!-- 4. Word Status Bar (Bottom) -->
                        <div class="bg-slate-800 text-slate-400 px-4 py-1.5 flex items-center justify-between text-[11px] border-t border-slate-700">
                            <div class="flex items-center gap-3">
                                <span><i class="fa-solid fa-file-lines text-cyan-400 mr-1"></i> Halaman 1 dari 1</span>
                                <span>&bull;</span>
                                <span>Bahasa Indonesia (PUEBI)</span>
                            </div>
                            <div class="flex items-center gap-2 text-teal-400 font-semibold">
                                <i class="fa-solid fa-circle-check text-xs"></i> Dokumen Siap
                            </div>
                        </div>

                    </div>

                    <!-- Hidden Textarea for Form Submission -->
                    <textarea id="description" name="description" class="hidden" required>{{ old('description', $karya->description) }}</textarea>
                </div>
            </div>

            <!-- Section 2: Thumbnail Utama (Cover) -->
            <div class="border-b border-slate-800 pb-4 pt-3">
                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-image text-cyan-400"></i> Foto Sampul Utama (Cover Thumbnail)
                </h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Gambar utama yang tampil di kartu katalog beranda</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <!-- Thumbnail Live Preview -->
                <div class="md:col-span-1">
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">Pratinjau Cover</label>
                    <div id="thumbPreviewContainer" class="w-full aspect-video rounded-xl bg-slate-950 border border-slate-700 overflow-hidden flex items-center justify-center relative shadow-inner">
                        <img id="thumbPreviewImg" src="{{ $karya->thumbnail_url }}" alt="Preview" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Upload File & URL Option -->
                <div class="md:col-span-2 space-y-3">
                    <div>
                        <label for="thumbnail_file" class="block text-xs font-semibold text-slate-300 mb-1.5">
                            Unggah Cover Gambar Baru (Rasio 16:9)
                        </label>
                        <input type="file" id="thumbnail_file" name="thumbnail_file" accept="image/png,image/jpeg,image/webp"
                            class="block w-full text-xs text-slate-400 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-cyan-500/10 file:text-cyan-300 hover:file:bg-cyan-500/20 file:cursor-pointer cursor-pointer bg-slate-950 rounded-xl border border-slate-700 focus:outline-none">
                    </div>

                    <div class="relative flex py-1 items-center">
                        <div class="flex-grow border-t border-slate-800"></div>
                        <span class="flex-shrink mx-2 text-[10px] text-slate-500 uppercase font-semibold">Atau tautan URL gambar</span>
                        <div class="flex-grow border-t border-slate-800"></div>
                    </div>

                    <div>
                        <input type="url" id="thumbnail_url" name="thumbnail_url"
                            value="{{ old('thumbnail_url', (str_starts_with($karya->thumbnail ?? '', 'http') ? $karya->thumbnail : '')) }}"
                            placeholder="https://images.unsplash.com/photo-..."
                            class="w-full px-3.5 py-2 rounded-xl bg-slate-950 border border-slate-700 text-white text-xs focus:outline-none focus:ring-2 focus:ring-cyan-500">
                    </div>
                </div>
            </div>

            <!-- Section 3: Galeri Foto Tambahan Karya -->
            <div class="border-b border-slate-800 pb-4 pt-3">
                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-images text-teal-400"></i> Galeri Dokumentasi Foto Karya (Bisa Banyak Foto)
                </h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Unggah foto-foto detail alat, proses perakitan, pengujian, atau tangkapan layar untuk halaman detail</p>
            </div>

            <!-- Existing Gallery Photos (if edit) -->
            @if($isEdit && !empty($karya->images) && is_array($karya->images) && count($karya->images) > 0)
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">Foto Galeri Saat Ini (Centang untuk menghapus foto):</label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                        @foreach($karya->images as $idx => $gImg)
                            @php
                                $imgSrc = (str_starts_with($gImg, 'http')) ? $gImg : asset('storage/' . $gImg);
                            @endphp
                            <div class="relative aspect-video rounded-xl overflow-hidden border border-slate-700 bg-slate-950 group">
                                <img src="{{ $imgSrc }}" alt="Galeri {{ $idx }}" class="w-full h-full object-cover">
                                <label class="absolute inset-0 bg-rose-950/80 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center cursor-pointer text-white p-2 text-center">
                                    <input type="checkbox" name="delete_images[]" value="{{ $gImg }}" class="rounded text-rose-600 focus:ring-rose-500 w-4 h-4 mb-1">
                                    <span class="text-[10px] font-bold text-rose-300">Hapus Foto Ini</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="space-y-3">
                <div>
                    <label for="gallery_files" class="block text-xs font-semibold text-slate-300 mb-1.5">
                        Pilih File Gambar Sekaligus (Dapat memilih lebih dari 1 file)
                    </label>
                    <input type="file" id="gallery_files" name="gallery_files[]" multiple accept="image/png,image/jpeg,image/webp"
                        class="block w-full text-xs text-slate-400 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-teal-500/10 file:text-teal-300 hover:file:bg-teal-500/20 file:cursor-pointer cursor-pointer bg-slate-950 rounded-xl border border-slate-700 focus:outline-none">
                </div>

                <div>
                    <label for="gallery_urls" class="block text-xs font-semibold text-slate-300 mb-1.5">
                        Atau Tambahkan URL Foto Galeri Eksternal (Pisahkan per baris baru):
                    </label>
                    <textarea id="gallery_urls" name="gallery_urls" rows="2"
                        placeholder="https://images.unsplash.com/...&#10;https://images.unsplash.com/..."
                        class="w-full px-3.5 py-2 rounded-xl bg-slate-950 border border-slate-700 text-white text-xs focus:outline-none focus:ring-2 focus:ring-cyan-500">{{ old('gallery_urls') }}</textarea>
                </div>
            </div>

            <!-- Section 4: Teknologi, Alat, Bahan & Tautan -->
            <div class="border-b border-slate-800 pb-4 pt-3">
                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-code text-cyan-400"></i> Alat, Spesifikasi & Tautan Presentasi
                </h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Daftar teknologi/peralatan, link slide Canva, demo, dan repository</p>
            </div>

            <div class="space-y-4">
                <!-- Tech Stacks -->
                <div>
                    <label for="tech_stacks" class="block text-xs font-semibold text-slate-300 mb-1.5">
                        Teknologi / Peralatan / Komponen (Pisahkan dengan tanda koma)
                    </label>
                    @php
                        $techVal = old('tech_stacks', is_array($karya->tech_stacks) ? implode(', ', $karya->tech_stacks) : $karya->tech_stacks);
                    @endphp
                    <input type="text" id="tech_stacks" name="tech_stacks"
                        value="{{ $techVal }}"
                        placeholder="Contoh: ESP32, OBD-II Scanner, CNC Router, SolidWorks, Flutter, Laravel"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all">
                    
                    <!-- Quick-add tech badges across all majors -->
                    <div class="flex flex-wrap items-center gap-1.5 mt-2">
                        <span class="text-[11px] text-slate-500 mr-1">Rekomendasi cepat:</span>
                        @foreach(['OBD-II', 'ECU', 'RFID Keyless', 'CNC Milling', 'SolidWorks', 'Class-D DSP', 'Bluetooth 5.0', 'Flutter', 'Laravel 12', 'ESP32', 'Arduino', 'Python', 'Unity 2D'] as $tech)
                            <button type="button" onclick="addTechStack('{{ $tech }}')"
                                class="px-2 py-0.5 rounded-lg bg-slate-800 hover:bg-cyan-950 hover:text-cyan-300 text-slate-400 text-[10px] border border-slate-700 transition-colors">
                                + {{ $tech }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Featured Toggle -->
                <div class="p-4 rounded-xl bg-slate-950/80 border border-slate-800 flex items-center justify-between">
                    <div>
                        <h4 class="text-xs font-bold text-white flex items-center gap-1.5">
                            <i class="fa-solid fa-star text-amber-400"></i> Tandai sebagai Karya Rekomendasi (Featured)
                        </h4>
                        <p class="text-[11px] text-slate-400 mt-0.5">
                            Karya rekomendasi akan tampil di posisi teratas dan mendapat badge bintang emas
                        </p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="featured" value="1" {{ old('featured', $karya->featured) ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-800 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                    </label>
                </div>
            </div>

            <!-- Submit and Cancel Buttons -->
            <div class="pt-4 border-t border-slate-800 flex items-center justify-end gap-3">
                <a href="{{ route('admin.karya.index') }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-slate-400 hover:text-white bg-slate-800 hover:bg-slate-700 transition-colors">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-xs font-bold text-slate-950 bg-gradient-to-r from-cyan-400 to-teal-400 hover:from-cyan-300 hover:to-teal-300 shadow-md shadow-cyan-500/20 active:scale-95 transition-all">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>{{ $isEdit ? 'Perbarui Karya Siswa' : 'Simpan Karya Siswa' }}</span>
                </button>
            </div>

        </form>

    </div>
</div>

@push('scripts')
<!-- Quill.js Library -->
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Quill with MS Word custom ribbon toolbar
        const quill = new Quill('#quillEditorContainer', {
            theme: 'snow',
            modules: {
                toolbar: '#wordRibbonToolbar',
                history: {
                    delay: 1000,
                    maxStack: 100,
                    userOnly: true
                }
            },
            placeholder: 'Tuliskan deskripsi lengkap, latar belakang inovasi, cara kerja, dan tujuan pembuatan karya layaknya mengetik di Microsoft Word...'
        });

        const textareaDesc = document.getElementById('description');
        const wordCounter = document.getElementById('wordCounter');
        const charCounter = document.getElementById('charCounter');

        // Function to update live statistics and sync with hidden textarea
        function syncWordEditor() {
            const text = quill.getText().trim();
            const words = text ? text.split(/\s+/).filter(w => w.length > 0).length : 0;
            const chars = text.length;

            if (wordCounter) wordCounter.textContent = words;
            if (charCounter) charCounter.textContent = chars;

            // If empty text, clear value so required validation works
            if (words === 0 && chars === 0) {
                textareaDesc.value = '';
            } else {
                textareaDesc.value = quill.root.innerHTML;
            }
        }

        // Run on initial load
        syncWordEditor();

        // Listen for changes in editor
        quill.on('text-change', function() {
            syncWordEditor();
        });

        // Undo & Redo buttons
        const btnUndo = document.getElementById('btnUndo');
        const btnRedo = document.getElementById('btnRedo');

        if (btnUndo) {
            btnUndo.addEventListener('click', function(e) {
                e.preventDefault();
                quill.history.undo();
                syncWordEditor();
            });
        }

        if (btnRedo) {
            btnRedo.addEventListener('click', function(e) {
                e.preventDefault();
                quill.history.redo();
                syncWordEditor();
            });
        }

        // Form submit hook
        const formEl = document.querySelector('form');
        if (formEl) {
            formEl.addEventListener('submit', function(e) {
                syncWordEditor();
                if (quill.getText().trim().length === 0) {
                    e.preventDefault();
                    alert('Deskripsi lengkap karya wajib diisi.');
                    quill.focus();
                }
            });
        }
    });

    // Live preview thumbnail file
    const thumbFileInput = document.getElementById('thumbnail_file');
    const thumbUrlInput = document.getElementById('thumbnail_url');
    const thumbPreviewImg = document.getElementById('thumbPreviewImg');

    if (thumbFileInput) {
        thumbFileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    thumbPreviewImg.src = evt.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }

    if (thumbUrlInput) {
        thumbUrlInput.addEventListener('input', function(e) {
            if (e.target.value.trim() && (e.target.value.startsWith('http://') || e.target.value.startsWith('https://'))) {
                thumbPreviewImg.src = e.target.value.trim();
            }
        });
    }

    // Helper for adding tech stacks
    function addTechStack(tech) {
        const input = document.getElementById('tech_stacks');
        let current = input.value.split(',').map(s => s.trim()).filter(s => s.length > 0);
        if (!current.includes(tech)) {
            current.push(tech);
            input.value = current.join(', ');
        }
    }
</script>
@endpush
@endsection
