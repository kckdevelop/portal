@extends('layouts.app')

@section('title', 'Buku Tamu & Foto Selfie Pengunjung Expo - SMK Muhammadiyah 1 Bantul')

@section('content')
<!-- Header Page Banner -->
<section class="bg-gradient-to-r from-slate-950 via-[#0A192F] to-slate-900 text-white py-12 sm:py-16 border-b border-cyan-900/40 relative overflow-hidden">
    <div class="absolute -top-20 -right-20 w-80 h-80 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-950/80 border border-cyan-500/40 text-cyan-300 text-xs font-semibold uppercase tracking-wider mb-3">
                <i class="fa-solid fa-camera"></i> Kehadiran Pengunjung Pameran
            </div>
            <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight leading-tight">
                Buku Tamu & <span class="text-gradient">Selfie Pengunjung</span>
            </h1>
            <p class="text-sm sm:text-base text-slate-300 mt-2 leading-relaxed">
                Terima kasih telah mengunjungi Pameran Aplikasi Karya Siswa SMK Muhammadiyah 1 Bantul. Silakan isi form dan abadikan momen kehadiran Anda dengan foto selfie!
            </p>
        </div>
    </div>
</section>

<!-- Main Container -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
        
        <!-- Left Column: Form & Camera Integration (7 Cols on LG) -->
        <div class="lg:col-span-7 bg-white rounded-3xl border border-slate-200/90 shadow-xl shadow-slate-200/50 p-6 sm:p-8 relative overflow-hidden">
            
            <div class="flex items-center justify-between pb-6 mb-6 border-b border-slate-100">
                <div>
                    <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900">Formulir Buku Tamu</h2>
                    <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Lengkapi data Anda & berikan dukungan apresiasi untuk siswa</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center font-bold text-lg">
                    <i class="fa-solid fa-pen-nib"></i>
                </div>
            </div>

            <!-- Form Buku Tamu -->
            <form id="guestbookForm" action="{{ route('guestbook.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Nama Lengkap -->
                <div>
                    <label for="name" class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">
                        Nama Lengkap <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-regular fa-user text-sm"></i>
                        </div>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            required 
                            placeholder="Contoh: Budi Prasetyo, S.Kom." 
                            value="{{ old('name') }}"
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-300 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 text-slate-800 text-sm placeholder-slate-400 transition-all"
                        >
                    </div>
                    @error('name')
                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Instansi / Asal Sekolah / Umum -->
                <div>
                    <label for="institution" class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">
                        Instansi / Asal Sekolah / Umum <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-building-columns text-sm"></i>
                        </div>
                        <input 
                            type="text" 
                            name="institution" 
                            id="institution" 
                            required 
                            placeholder="Contoh: PT Telkom Indonesia / SMPN 1 Bantul / Umum" 
                            value="{{ old('institution') }}"
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-300 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 text-slate-800 text-sm placeholder-slate-400 transition-all"
                        >
                    </div>
                    @error('institution')
                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Rating Pengalaman Pameran -->
                <div>
                    <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">
                        Rating Pengalaman Pameran & Karya Siswa
                    </label>
                    <div class="flex items-center gap-2">
                        <input type="hidden" name="rating" id="ratingInput" value="5">
                        <div id="starContainer" class="flex items-center gap-1.5 cursor-pointer text-2xl text-amber-400">
                            <i class="fa-solid fa-star star-btn" data-value="1"></i>
                            <i class="fa-solid fa-star star-btn" data-value="2"></i>
                            <i class="fa-solid fa-star star-btn" data-value="3"></i>
                            <i class="fa-solid fa-star star-btn" data-value="4"></i>
                            <i class="fa-solid fa-star star-btn" data-value="5"></i>
                        </div>
                        <span id="ratingLabel" class="text-xs font-semibold text-slate-500 ml-2">Sangat Puas (5/5)</span>
                    </div>
                </div>

                <!-- Pesan / Kesan & Saran -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="message" class="block text-xs sm:text-sm font-bold text-slate-700">
                            Pesan / Kesan & Saran <span class="text-rose-500">*</span>
                        </label>
                        <span id="charCount" class="text-[11px] text-slate-400">0/1000 karakter</span>
                    </div>
                    <textarea 
                        name="message" 
                        id="message" 
                        rows="3" 
                        required 
                        maxlength="1000"
                        placeholder="Tuliskan apresiasi, saran, kritik, atau dukungan Anda untuk karya siswa SMK Muhammadiyah 1 Bantul..." 
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 text-slate-800 text-sm placeholder-slate-400 transition-all resize-none"
                    >{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- FITUR KAMERA / SELFIE INTEGRATION (WebRTC MediaStream) -->
                <div class="p-4 sm:p-5 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-xs font-bold text-slate-800 uppercase tracking-wide flex items-center gap-2">
                                <i class="fa-solid fa-camera text-cyan-600"></i>
                                Foto Selfie di Lokasi Pameran
                            </span>
                            <p class="text-[11px] text-slate-500">Ambil selfie langsung dari kamera HP/laptop atau pilih dari galeri.</p>
                        </div>

                        <!-- Toggle Camera / Upload Mode Tab -->
                        <div class="flex rounded-lg bg-slate-200 p-0.5 text-xs font-semibold">
                            <button type="button" id="tabCameraBtn" class="px-2.5 py-1 rounded-md bg-white text-slate-900 shadow-sm transition-all">
                                <i class="fa-solid fa-video mr-1"></i> Kamera
                            </button>
                            <button type="button" id="tabUploadBtn" class="px-2.5 py-1 rounded-md text-slate-600 hover:text-slate-900 transition-all">
                                <i class="fa-solid fa-upload mr-1"></i> Galeri
                            </button>
                        </div>
                    </div>

                    <!-- Hidden Inputs for Storing Image Data -->
                    <input type="hidden" name="selfie_image" id="selfieImageBase64" value="">

                    <!-- 1. LIVE CAMERA CONTAINER -->
                    <div id="cameraSection" class="space-y-3">
                        
                        <!-- Video Viewfinder & Canvas & Snapshot Preview Box (Portrait 3:4) -->
                        <div class="relative mx-auto bg-slate-900 rounded-2xl overflow-hidden flex items-center justify-center border border-slate-800 shadow-inner" style="width: 100%; max-width: 320px; aspect-ratio: 3/4;">
                            
                            <!-- Placeholder when camera is inactive -->
                            <div id="cameraPlaceholder" class="text-center p-6 space-y-3">
                                <div class="w-14 h-14 rounded-full bg-slate-800 border border-slate-700 text-cyan-400 flex items-center justify-center mx-auto text-2xl">
                                    <i class="fa-solid fa-camera"></i>
                                </div>
                                <p class="text-xs text-slate-300 font-medium">Klik tombol di bawah untuk mengaktifkan kamera</p>
                            </div>

                            <!-- Live Video Stream -->
                            <video id="webcam" autoplay playsinline class="hidden w-full h-full object-cover transform -scale-x-100"></video>
                            
                            <!-- Hidden Canvas for capturing snapshot -->
                            <canvas id="photoCanvas" class="hidden"></canvas>

                            <!-- Snapshot Image Preview (Captured) -->
                            <div id="previewContainer" class="hidden w-full h-full relative">
                                <img id="selfiePreviewImg" src="" alt="Pratinjau Selfie" class="w-full h-full object-cover">
                                <div class="absolute top-2 left-2 px-2.5 py-1 rounded-md bg-emerald-600/90 text-white text-[10px] font-bold shadow-md flex items-center gap-1">
                                    <i class="fa-solid fa-check"></i> Foto Berhasil Diambil
                                </div>
                            </div>

                        </div>

                        <!-- Start Camera Button: Visible below viewfinder when inactive -->
                        <div id="startCameraWrapper" class="flex items-center justify-center mt-3">
                            <button type="button" id="startCameraBtn" class="inline-flex items-center gap-2.5 px-7 py-3.5 rounded-2xl bg-gradient-to-r from-orange-500 via-rose-500 to-pink-500 hover:from-orange-400 hover:to-pink-400 text-white font-black text-sm sm:text-base shadow-xl shadow-rose-500/40 ring-4 ring-white/80 border-2 border-white/90 hover:scale-105 active:scale-95 transition-all cursor-pointer">
                                <i class="fa-solid fa-camera text-white text-lg"></i>
                                <span>Buka Kamera Selfie</span>
                            </button>
                        </div>

                        <!-- Camera Controls: Below the viewfinder (not overlapping) -->
                        <div id="cameraControls" class="hidden flex items-center justify-center gap-4 px-4 mt-3">
                            <!-- Switch Camera (Front/Back) -->
                            <button type="button" id="switchCameraBtn" title="Ganti Kamera Depan/Belakang" class="w-12 h-12 rounded-full bg-slate-700 hover:bg-slate-600 text-white border-2 border-slate-500 hover:border-cyan-400 shadow-xl flex items-center justify-center text-sm transition-all hover:scale-105 active:scale-95 cursor-pointer">
                                <i class="fa-solid fa-camera-rotate"></i>
                            </button>

                            <!-- Shutter Snap Button: Ambil Foto Selfie -->
                            <button type="button" id="snapBtn" class="group px-7 sm:px-9 py-3.5 rounded-full bg-gradient-to-r from-orange-500 via-rose-500 to-pink-500 hover:from-orange-400 hover:via-rose-400 hover:to-pink-400 text-white font-black text-sm sm:text-base shadow-2xl shadow-rose-500/60 ring-4 ring-white/90 border-2 border-white hover:scale-105 active:scale-95 transition-all flex items-center gap-3 cursor-pointer">
                                <span class="w-3.5 h-3.5 rounded-full bg-white animate-ping"></span>
                                <i class="fa-solid fa-camera text-base sm:text-lg text-white"></i>
                                <span class="tracking-tight uppercase font-black text-xs sm:text-sm">Ambil Foto</span>
                            </button>

                            <!-- Stop Camera Button -->
                            <button type="button" id="stopCameraBtn" title="Matikan Kamera" class="w-12 h-12 rounded-full bg-slate-700 hover:bg-rose-950 text-white hover:text-rose-300 border-2 border-slate-500 hover:border-rose-400 shadow-xl flex items-center justify-center text-sm transition-all hover:scale-105 active:scale-95 cursor-pointer">
                                <i class="fa-solid fa-xmark text-base"></i>
                            </button>
                        </div>

                        <!-- Retake Controls (When snapshot is already taken) -->
                        <div id="retakeControls" class="hidden flex items-center justify-center gap-3 mt-3 px-4">
                            <button type="button" id="retakeBtn" class="px-6 py-3 rounded-full bg-slate-800 hover:bg-slate-700 text-white border-2 border-cyan-400 hover:border-cyan-300 text-xs sm:text-sm font-black shadow-xl hover:scale-105 active:scale-95 transition-all flex items-center gap-2 cursor-pointer">
                                <i class="fa-solid fa-rotate-left text-cyan-400 text-sm"></i>
                                <span>Foto Ulang (Ambil Ulang Selfie)</span>
                            </button>
                        </div>

                        <!-- Camera Error / Permission Notice -->
                        <div id="cameraError" class="hidden p-3 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 text-xs">
                            <i class="fa-solid fa-triangle-exclamation mr-1 text-amber-600"></i>
                            <span id="cameraErrorMessage">Tidak dapat mengakses kamera. Silakan izinkan akses browser atau gunakan opsi "Galeri" di samping.</span>
                        </div>
                    </div>

                    <!-- 2. FILE UPLOAD CONTAINER (ALTERNATIVE FALLBACK) -->
                    <div id="uploadSection" class="hidden space-y-3">
                        <div class="border-2 border-dashed border-slate-300 hover:border-cyan-500 rounded-2xl p-6 text-center cursor-pointer transition-colors relative bg-white" onclick="document.getElementById('selfieFileInput').click()">
                            <input 
                                type="file" 
                                name="selfie_file" 
                                id="selfieFileInput" 
                                accept="image/*" 
                                class="hidden"
                            >
                            <div class="space-y-2">
                                <div class="w-12 h-12 rounded-full bg-cyan-50 text-cyan-600 flex items-center justify-center mx-auto text-xl">
                                    <i class="fa-solid fa-image"></i>
                                </div>
                                <p class="text-xs font-bold text-slate-700">Pilih foto dari penyimpanan galeri perangkat</p>
                                <p class="text-[11px] text-slate-400">Format JPG, PNG, atau WebP (Maksimal 5MB)</p>
                            </div>
                        </div>

                        <!-- File Upload Preview Box -->
                        <div id="fileUploadPreviewBox" class="hidden flex items-center gap-3 p-3 rounded-xl bg-white border border-slate-200">
                            <img id="filePreviewImg" src="" alt="Pratinjau File" class="w-12 h-12 rounded-lg object-cover border border-slate-200">
                            <div class="flex-1 overflow-hidden">
                                <p id="filePreviewName" class="text-xs font-bold text-slate-800 truncate"></p>
                                <span class="text-[10px] text-teal-600 font-semibold"><i class="fa-solid fa-check"></i> Siap diupload</span>
                            </div>
                            <button type="button" id="removeFileBtn" class="text-slate-400 hover:text-rose-500 p-2 text-xs">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </div>

                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    id="submitBtn" 
                    class="w-full py-4.5 px-6 rounded-2xl bg-gradient-to-r from-cyan-400 via-teal-300 to-emerald-400 hover:from-cyan-300 hover:via-teal-200 hover:to-emerald-300 text-slate-950 font-black text-base sm:text-lg shadow-2xl shadow-cyan-500/40 hover:shadow-cyan-400/60 hover:-translate-y-0.5 active:scale-98 border-2 border-white/80 transition-all flex items-center justify-center gap-3 group cursor-pointer"
                >
                    <i class="fa-solid fa-paper-plane text-lg text-slate-950 group-hover:translate-x-1 transition-transform"></i>
                    <span id="btnText" class="tracking-tight">Simpan Buku Tamu & Kirim Selfie</span>
                </button>

                <p class="text-[11px] text-center text-slate-400">
                    <i class="fa-solid fa-shield-halved text-cyan-600 mr-1"></i> Data dan foto Anda akan ditampilkan di wall of fame pameran karya siswa.
                </p>
            </form>

        </div>

        <!-- Right Column: Recent Visitors Feed / Wall of Fame (5 Cols on LG) -->
        <div class="lg:col-span-5 space-y-6">
            
            <div class="p-6 rounded-3xl bg-gradient-to-br from-slate-900 to-slate-950 text-white shadow-xl border border-slate-800">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2.5">
                        <div class="w-3 h-3 rounded-full bg-emerald-400 animate-ping"></div>
                        <h3 class="text-base font-bold text-white">Live Feed Pengunjung</h3>
                    </div>
                    <span class="text-xs bg-cyan-950 text-cyan-300 font-bold px-3 py-1 rounded-full border border-cyan-800/60">
                        {{ $totalEntries }} Pengunjung
                    </span>
                </div>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Lihat apresiasi dan swafoto selfie yang diabadikan oleh para tamu undangan, guru, siswa, dan industri mitra selama pameran berlangsung.
                </p>
            </div>

            <!-- Visitors Cards Stream -->
            <div id="visitorList" class="space-y-4">
                @if($guestbooks->isEmpty())
                    <div class="p-8 bg-white rounded-2xl border border-slate-200 text-center text-slate-400">
                        <i class="fa-regular fa-comments text-3xl mb-2 text-slate-300"></i>
                        <p class="text-xs font-semibold">Belum ada data buku tamu.</p>
                        <p class="text-[11px] text-slate-400">Jadilah orang pertama yang mengisi buku tamu pameran ini!</p>
                    </div>
                @else
                    @foreach($guestbooks as $entry)
                        <div class="p-4 sm:p-5 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:shadow-md transition-shadow flex items-start gap-4">
                            <!-- Selfie Thumbnail -->
                            <div class="flex-shrink-0">
                                @if($entry->selfie_url)
                                    <img 
                                        src="{{ $entry->selfie_url }}" 
                                        alt="{{ $entry->name }}" 
                                        class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl object-cover border-2 border-cyan-400 shadow-sm"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-gradient-to-br from-cyan-100 to-teal-100 text-cyan-800 font-bold text-lg flex items-center justify-center border border-cyan-200">
                                        {{ strtoupper(substr($entry->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>

                            <!-- Visitor Information & Message -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2">
                                    <h4 class="text-xs sm:text-sm font-bold text-slate-900 truncate">{{ $entry->name }}</h4>
                                    <!-- Stars -->
                                    <div class="flex text-amber-400 text-[10px]">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fa-solid fa-star {{ $i <= $entry->rating ? 'text-amber-400' : 'text-slate-200' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                                
                                <p class="text-[11px] text-cyan-700 font-medium truncate mt-0.5">
                                    <i class="fa-solid fa-building-columns text-[10px] mr-1"></i> {{ $entry->institution }}
                                </p>

                                <p class="text-xs text-slate-600 mt-2 italic leading-relaxed break-words">
                                    "{{ $entry->message }}"
                                </p>

                                <div class="mt-2.5 text-[10px] text-slate-400 flex items-center justify-between">
                                    <span><i class="fa-regular fa-clock mr-1"></i> {{ $entry->created_at->diffForHumans() }}</span>
                                    <span class="text-emerald-600 font-semibold"><i class="fa-solid fa-check-double"></i> Hadir</span>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Pagination -->
                    <div class="pt-2">
                        {{ $guestbooks->links() }}
                    </div>
                @endif
            </div>

        </div>

    </div>
</div>

<!-- Success Modal Dialog -->
<div id="successModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-950/70 backdrop-blur-sm p-4 flex items-center justify-center">
    <div class="relative w-full max-w-md bg-white rounded-3xl shadow-2xl p-6 sm:p-8 text-center space-y-4 border border-slate-100 animate-in fade-in zoom-in duration-200">
        <div class="w-16 h-16 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto text-3xl shadow-inner">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <h3 class="text-xl font-extrabold text-slate-900">Buku Tamu Berhasil Disimpan!</h3>
        <p id="successModalMsg" class="text-xs sm:text-sm text-slate-600 leading-relaxed">
            Terima kasih atas kehadiran dan apresiasi Anda terhadap karya siswa SMK Muhammadiyah 1 Bantul.
        </p>
        <div class="pt-2">
            <button type="button" onclick="closeSuccessModal()" class="w-full py-3 px-6 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-sm transition-colors">
                Tutup & Lihat di Feed
            </button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // --- Rating Stars Selector ---
    const starBtns = document.querySelectorAll('.star-btn');
    const ratingInput = document.getElementById('ratingInput');
    const ratingLabel = document.getElementById('ratingLabel');
    const labels = {
        1: 'Kurang (1/5)',
        2: 'Cukup (2/5)',
        3: 'Bagus (3/5)',
        4: 'Sangat Baik (4/5)',
        5: 'Sangat Puas & Kagum (5/5)'
    };

    starBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const val = parseInt(btn.getAttribute('data-value'));
            ratingInput.value = val;
            ratingLabel.textContent = labels[val] || (val + '/5');
            updateStars(val);
        });
    });

    function updateStars(val) {
        starBtns.forEach(b => {
            const bVal = parseInt(b.getAttribute('data-value'));
            if (bVal <= val) {
                b.className = 'fa-solid fa-star star-btn text-amber-400';
            } else {
                b.className = 'fa-solid fa-star star-btn text-slate-200';
            }
        });
    }

    // --- Message Character Counter ---
    const messageInput = document.getElementById('message');
    const charCount = document.getElementById('charCount');
    if (messageInput && charCount) {
        messageInput.addEventListener('input', () => {
            charCount.textContent = `${messageInput.value.length}/1000 karakter`;
        });
    }

    // --- Tab Switching (Camera vs Upload) ---
    const tabCameraBtn = document.getElementById('tabCameraBtn');
    const tabUploadBtn = document.getElementById('tabUploadBtn');
    const cameraSection = document.getElementById('cameraSection');
    const uploadSection = document.getElementById('uploadSection');

    tabCameraBtn.addEventListener('click', () => {
        tabCameraBtn.className = 'px-2.5 py-1 rounded-md bg-white text-slate-900 shadow-sm transition-all';
        tabUploadBtn.className = 'px-2.5 py-1 rounded-md text-slate-600 hover:text-slate-900 transition-all';
        cameraSection.classList.remove('hidden');
        uploadSection.classList.add('hidden');
    });

    tabUploadBtn.addEventListener('click', () => {
        tabUploadBtn.className = 'px-2.5 py-1 rounded-md bg-white text-slate-900 shadow-sm transition-all';
        tabCameraBtn.className = 'px-2.5 py-1 rounded-md text-slate-600 hover:text-slate-900 transition-all';
        uploadSection.classList.remove('hidden');
        cameraSection.classList.add('hidden');
        // Stop camera stream if active
        stopCamera();
    });

    // --- WEBRTC CAMERA & SELFIE INTEGRATION ---
    const webcam = document.getElementById('webcam');
    const photoCanvas = document.getElementById('photoCanvas');
    const cameraPlaceholder = document.getElementById('cameraPlaceholder');
    const cameraControls = document.getElementById('cameraControls');
    const previewContainer = document.getElementById('previewContainer');
    const selfiePreviewImg = document.getElementById('selfiePreviewImg');
    const retakeControls = document.getElementById('retakeControls');
    const cameraError = document.getElementById('cameraError');
    const cameraErrorMessage = document.getElementById('cameraErrorMessage');
    const selfieImageBase64 = document.getElementById('selfieImageBase64');
    const startCameraWrapper = document.getElementById('startCameraWrapper');

    let currentStream = null;
    let currentFacingMode = 'user'; // 'user' for selfie / front camera, 'environment' for back

    document.getElementById('startCameraBtn').addEventListener('click', () => startCamera());
    document.getElementById('snapBtn').addEventListener('click', () => takeSnapshot());
    document.getElementById('stopCameraBtn').addEventListener('click', () => stopCamera());
    document.getElementById('retakeBtn').addEventListener('click', () => retakeSnapshot());
    document.getElementById('switchCameraBtn').addEventListener('click', () => {
        currentFacingMode = currentFacingMode === 'user' ? 'environment' : 'user';
        startCamera();
    });

    async function startCamera() {
        stopCamera();
        cameraError.classList.add('hidden');

        try {
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                throw new Error('Browser Anda tidak mendukung WebRTC Camera API.');
            }

            const constraints = {
                video: {
                    facingMode: currentFacingMode,
                    width: { ideal: 1280 },
                    height: { ideal: 960 }
                },
                audio: false
            };

            currentStream = await navigator.mediaDevices.getUserMedia(constraints);
            webcam.srcObject = currentStream;

            // Mirror video if selfie camera
            if (currentFacingMode === 'user') {
                webcam.style.transform = 'scaleX(-1)';
            } else {
                webcam.style.transform = 'scaleX(1)';
            }

            webcam.classList.remove('hidden');
            cameraPlaceholder.classList.add('hidden');
            cameraControls.classList.remove('hidden');
            if (startCameraWrapper) startCameraWrapper.classList.add('hidden');
            previewContainer.classList.add('hidden');
            retakeControls.classList.add('hidden');
        } catch (err) {
            console.error('Camera error:', err);
            cameraError.classList.remove('hidden');
            cameraErrorMessage.textContent = 'Gagal mengakses kamera: ' + (err.message || 'Izin kamera ditolak.');
            cameraPlaceholder.classList.remove('hidden');
            if (startCameraWrapper) startCameraWrapper.classList.remove('hidden');
            webcam.classList.add('hidden');
            cameraControls.classList.add('hidden');
        }
    }

    function stopCamera() {
        if (currentStream) {
            currentStream.getTracks().forEach(track => track.stop());
            currentStream = null;
        }
        webcam.classList.add('hidden');
        cameraControls.classList.add('hidden');
        if (previewContainer.classList.contains('hidden')) {
            cameraPlaceholder.classList.remove('hidden');
            if (startCameraWrapper) startCameraWrapper.classList.remove('hidden');
        }
    }

    function takeSnapshot() {
        if (!webcam.videoWidth) return;

        photoCanvas.width = webcam.videoWidth;
        photoCanvas.height = webcam.videoHeight;
        const ctx = photoCanvas.getContext('2d');

        // If front camera, mirror canvas back to natural
        if (currentFacingMode === 'user') {
            ctx.translate(photoCanvas.width, 0);
            ctx.scale(-1, 1);
        }

        ctx.drawImage(webcam, 0, 0, photoCanvas.width, photoCanvas.height);

        // Convert to high-quality JPEG base64
        const dataUrl = photoCanvas.toDataURL('image/jpeg', 0.85);
        selfieImageBase64.value = dataUrl;
        selfiePreviewImg.src = dataUrl;

        // Display preview
        previewContainer.classList.remove('hidden');
        retakeControls.classList.remove('hidden');
        webcam.classList.add('hidden');
        cameraControls.classList.add('hidden');

        // Stop live stream to conserve battery
        stopCamera();
        previewContainer.classList.remove('hidden');
    }

    function retakeSnapshot() {
        selfieImageBase64.value = '';
        selfiePreviewImg.src = '';
        previewContainer.classList.add('hidden');
        retakeControls.classList.add('hidden');
        startCamera();
    }

    // --- FILE UPLOAD ALTERNATIVE PREVIEW ---
    const selfieFileInput = document.getElementById('selfieFileInput');
    const fileUploadPreviewBox = document.getElementById('fileUploadPreviewBox');
    const filePreviewImg = document.getElementById('filePreviewImg');
    const filePreviewName = document.getElementById('filePreviewName');
    const removeFileBtn = document.getElementById('removeFileBtn');

    selfieFileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            filePreviewName.textContent = file.name;
            const reader = new FileReader();
            reader.onload = (re) => {
                filePreviewImg.src = re.target.result;
                fileUploadPreviewBox.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    removeFileBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        selfieFileInput.value = '';
        fileUploadPreviewBox.classList.add('hidden');
        filePreviewImg.src = '';
    });

    // --- AJAX FORM SUBMISSION & REALTIME WALL PREPEND ---
    const guestbookForm = document.getElementById('guestbookForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const successModal = document.getElementById('successModal');
    const successModalMsg = document.getElementById('successModalMsg');
    const visitorList = document.getElementById('visitorList');

    guestbookForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Validation check
        const name = document.getElementById('name').value.trim();
        const institution = document.getElementById('institution').value.trim();
        const message = document.getElementById('message').value.trim();

        if (!name || !institution || !message) {
            alert('Mohon lengkapi nama, instansi, dan pesan Anda.');
            return;
        }

        // Loading state
        submitBtn.disabled = true;
        btnText.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i> Menyimpan...';

        const formData = new FormData(guestbookForm);

        try {
            const response = await fetch(guestbookForm.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            });

            const result = await response.json();

            if (response.ok && result.success) {
                // Prepend new visitor card dynamically
                if (result.data) {
                    const card = createVisitorCard(result.data);
                    if (visitorList.querySelector('.text-center')) {
                        visitorList.innerHTML = ''; // Clear empty state
                    }
                    visitorList.insertAdjacentHTML('afterbegin', card);
                }

                // Reset form
                guestbookForm.reset();
                selfieImageBase64.value = '';
                previewContainer.classList.add('hidden');
                retakeControls.classList.add('hidden');
                cameraPlaceholder.classList.remove('hidden');
                fileUploadPreviewBox.classList.add('hidden');
                updateStars(5);
                ratingInput.value = 5;
                ratingLabel.textContent = labels[5];
                charCount.textContent = '0/1000 karakter';

                // Show success modal
                successModalMsg.textContent = result.message || 'Terima kasih atas partisipasi Anda di Pameran Karya Siswa SMK Muhammadiyah 1 Bantul!';
                successModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                alert(result.message || 'Terjadi kesalahan saat menyimpan data buku tamu.');
            }
        } catch (err) {
            console.error('Submit error:', err);
            // Fallback standard submit if AJAX failed
            guestbookForm.submit();
        } finally {
            submitBtn.disabled = false;
            btnText.innerHTML = 'Simpan Buku Tamu & Kirim Selfie';
        }
    });

    function createVisitorCard(item) {
        let starsHtml = '';
        for (let i = 1; i <= 5; i++) {
            starsHtml += `<i class="fa-solid fa-star ${i <= (item.rating || 5) ? 'text-amber-400' : 'text-slate-200'}"></i>`;
        }

        const avatar = item.selfie_url 
            ? `<img src="${item.selfie_url}" alt="${item.name}" class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl object-cover border-2 border-cyan-400 shadow-sm">`
            : `<div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-gradient-to-br from-cyan-100 to-teal-100 text-cyan-800 font-bold text-lg flex items-center justify-center border border-cyan-200">${item.name.charAt(0).toUpperCase()}</div>`;

        return `
            <div class="p-4 sm:p-5 rounded-2xl bg-white border border-cyan-300 shadow-md ring-2 ring-cyan-400/20 flex items-start gap-4 animate-in fade-in slide-in-from-top-4 duration-300">
                <div class="flex-shrink-0">
                    ${avatar}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between gap-2">
                        <h4 class="text-xs sm:text-sm font-bold text-slate-900 truncate">${item.name}</h4>
                        <div class="flex text-amber-400 text-[10px]">
                            ${starsHtml}
                        </div>
                    </div>
                    <p class="text-[11px] text-cyan-700 font-medium truncate mt-0.5">
                        <i class="fa-solid fa-building-columns text-[10px] mr-1"></i> ${item.institution}
                    </p>
                    <p class="text-xs text-slate-600 mt-2 italic leading-relaxed break-words">
                        "${item.message}"
                    </p>
                    <div class="mt-2.5 text-[10px] text-slate-400 flex items-center justify-between">
                        <span><i class="fa-regular fa-clock mr-1"></i> Baru saja</span>
                        <span class="text-emerald-600 font-semibold"><i class="fa-solid fa-check-double"></i> Hadir</span>
                    </div>
                </div>
            </div>
        `;
    }

    function closeSuccessModal() {
        successModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        // Smooth scroll to visitor list
        visitorList.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
</script>
@endpush
