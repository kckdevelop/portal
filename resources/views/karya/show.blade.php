@extends('layouts.app')

@section('title', $karya->title . ' - Karya Siswa ' . $karya->jurusan_detail['name'])

@push('styles')
<style>
    .karya-rich-description h1 { font-size: 1.5rem; font-weight: 800; color: #0f172a; margin-top: 1rem; margin-bottom: 0.5rem; }
    .karya-rich-description h2 { font-size: 1.25rem; font-weight: 700; color: #0f172a; margin-top: 0.875rem; margin-bottom: 0.375rem; }
    .karya-rich-description h3 { font-size: 1.1rem; font-weight: 700; color: #0f172a; margin-top: 0.75rem; margin-bottom: 0.25rem; }
    .karya-rich-description ul { list-style-type: disc; padding-left: 1.4rem; margin: 0.5rem 0; }
    .karya-rich-description ol { list-style-type: decimal; padding-left: 1.4rem; margin: 0.5rem 0; }
    .karya-rich-description li { margin-bottom: 0.25rem; }
    .karya-rich-description blockquote { border-left: 4px solid #06b6d4; padding-left: 0.85rem; font-style: italic; color: #475569; margin: 0.75rem 0; background: #f0fdfa; padding-top: 0.25rem; padding-bottom: 0.25rem; border-radius: 0 8px 8px 0; }
    .karya-rich-description a { color: #0891b2; text-decoration: underline; font-weight: 600; }
    .karya-rich-description a:hover { color: #0e7490; }
    .karya-rich-description p { margin-bottom: 0.65rem; }
</style>
@endpush

@section('content')
<!-- Detail Header & Breadcrumb -->
<div class="bg-[#0A192F] text-white pt-8 pb-14 sm:pt-12 sm:pb-20 relative overflow-hidden border-b border-slate-700">
    <!-- Ambient Glow Background -->
    <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(#06b6d4 1px, transparent 1px); background-size: 28px 28px;"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-[#0A192F] via-[#0A192F]/95 to-[#0A192F]/90 pointer-events-none"></div>
    <div class="absolute -top-32 -left-32 w-80 h-80 bg-cyan-500/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/3 -right-32 w-80 h-80 bg-teal-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-slate-300 mb-6 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-cyan-400 transition-colors flex items-center gap-1.5 font-medium">
                <i class="fa-solid fa-house text-[11px]"></i>
                <span>Beranda</span>
            </a>
            <span class="text-slate-500">/</span>
            <a href="{{ route('home') }}#katalog-karya" class="hover:text-cyan-400 transition-colors font-medium">
                Katalog Karya
            </a>
            <span class="text-slate-500">/</span>
            <a href="{{ route('home', ['jurusan' => $karya->jurusan]) }}#katalog-karya" class="hover:text-cyan-400 transition-colors font-medium">
                {{ $karya->jurusan_detail['code'] }}
            </a>
            <span class="text-slate-500">/</span>
            <span class="text-white font-semibold truncate max-w-[200px] sm:max-w-xs">{{ $karya->title }}</span>
        </nav>

        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="space-y-3 max-w-3xl">
                <!-- Badges -->
                <div class="flex flex-wrap items-center gap-2.5">
                    <!-- Jurusan Badge -->
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl text-xs font-bold {{ $karya->jurusan_detail['badge_bg'] }} border shadow-sm">
                        <i class="{{ $karya->jurusan_detail['icon'] }} text-xs"></i>
                        <span>Jurusan {{ $karya->jurusan_detail['code'] }} &bull; {{ $karya->jurusan_detail['name'] }}</span>
                    </span>

                    @if($karya->featured)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-extrabold bg-amber-400 text-slate-950 shadow-md">
                            <i class="fa-solid fa-star text-[11px]"></i>
                            <span>Karya Rekomendasi</span>
                        </span>
                    @endif
                </div>

                <!-- Judul Karya -->
                <h1 class="text-2xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight leading-tight">
                    {{ $karya->title }}
                </h1>

                <!-- Author & Class Info -->
                <div class="flex flex-wrap items-center gap-4 text-xs sm:text-sm text-slate-300 pt-1">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-cyan-950 border border-cyan-500/40 text-cyan-300 flex items-center justify-center font-bold">
                            <i class="fa-solid fa-user-graduate text-xs"></i>
                        </div>
                        <div>
                            <span class="text-slate-400 text-[11px] block leading-none">Pengembang / Tim:</span>
                            <span class="font-bold text-cyan-100">{{ $karya->student_name }}</span>
                        </div>
                    </div>

                    <div class="hidden sm:block text-slate-500">&bull;</div>

                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-slate-800 border border-slate-700 text-slate-300 flex items-center justify-center font-bold">
                            <i class="fa-solid fa-school text-xs"></i>
                        </div>
                        <div>
                            <span class="text-slate-400 text-[11px] block leading-none">Kelas:</span>
                            <span class="font-bold text-cyan-100">{{ $karya->student_class }}</span>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<!-- Main Body: Gallery & Project Details -->
<div class="py-10 sm:py-16 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
            
            <!-- Left Column: Interactive Image Gallery (7 cols on lg) -->
            <div class="lg:col-span-7 space-y-4">
                
                @php
                    $gallery = $karya->gallery_images;
                @endphp

                <!-- Main Active Image Viewer -->
                <div class="relative bg-slate-950 rounded-3xl overflow-hidden border border-slate-300/80 shadow-xl aspect-video group">
                    <img id="mainGalleryImg" 
                         src="{{ $gallery[0] ?? $karya->thumbnail_url }}" 
                         alt="{{ $karya->title }}" 
                         class="w-full h-full object-cover transition-all duration-500 cursor-pointer"
                         onclick="openImageLightbox(this.src)">

                    <!-- Overlay Gradient -->
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>

                    <!-- Click to Enlarge Badge -->
                    <button type="button" 
                            onclick="openImageLightbox(document.getElementById('mainGalleryImg').src)"
                            class="absolute top-4 right-4 px-3 py-1.5 rounded-xl bg-slate-900/80 backdrop-blur-md text-white border border-white/20 text-xs font-semibold flex items-center gap-1.5 opacity-90 hover:opacity-100 transition-all hover:scale-105 shadow-md">
                        <i class="fa-solid fa-expand text-cyan-400"></i>
                        <span>Perbesar Foto</span>
                    </button>

                    <!-- Gallery Counter Badge -->
                    @if(count($gallery) > 1)
                        <div class="absolute bottom-4 left-4 px-3 py-1.5 rounded-xl bg-slate-900/80 backdrop-blur-md text-slate-200 border border-slate-700 text-xs font-semibold flex items-center gap-1.5 shadow-md">
                            <i class="fa-solid fa-images text-cyan-400"></i>
                            <span id="galleryCounter">Foto 1 dari {{ count($gallery) }}</span>
                        </div>
                    @endif

                    <!-- Prev/Next Controls for Main Viewport -->
                    @if(count($gallery) > 1)
                        <button type="button" onclick="navigateGallery(-1)" 
                                class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-slate-900/80 hover:bg-cyan-500 hover:text-slate-950 text-white flex items-center justify-center backdrop-blur-md transition-all shadow-lg border border-white/10 active:scale-90">
                            <i class="fa-solid fa-chevron-left text-sm"></i>
                        </button>
                        <button type="button" onclick="navigateGallery(1)" 
                                class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-slate-900/80 hover:bg-cyan-500 hover:text-slate-950 text-white flex items-center justify-center backdrop-blur-md transition-all shadow-lg border border-white/10 active:scale-90">
                            <i class="fa-solid fa-chevron-right text-sm"></i>
                        </button>
                    @endif
                </div>

                <!-- Thumbnails Strip -->
                @if(count($gallery) > 1)
                    <div class="p-3 bg-white rounded-2xl border border-slate-200 shadow-sm">
                        <div class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2 flex items-center justify-between">
                            <span>Koleksi Foto & Dokumentasi Karya ({{ count($gallery) }} Foto)</span>
                            <span class="text-cyan-600 font-semibold lowercase">klik untuk melihat</span>
                        </div>
                        <div class="grid grid-cols-4 sm:grid-cols-5 gap-2.5">
                            @foreach($gallery as $index => $img)
                                <button type="button" 
                                        onclick="setGalleryIndex({{ $index }})" 
                                        class="gallery-thumb-btn relative aspect-video rounded-xl overflow-hidden border-2 transition-all duration-300 {{ $index === 0 ? 'border-cyan-500 ring-2 ring-cyan-500/30' : 'border-slate-200 hover:border-cyan-400 opacity-70 hover:opacity-100' }}">
                                    <img src="{{ $img }}" alt="Foto {{ $index + 1 }}" class="w-full h-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Jurusan Info Card -->
                <div class="p-5 sm:p-6 bg-white rounded-3xl border border-slate-200 shadow-sm flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl {{ $karya->jurusan_detail['badge_bg'] }} border flex items-center justify-center text-xl shrink-0 shadow-sm">
                        <i class="{{ $karya->jurusan_detail['icon'] }}"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900">
                            Program Keahlian {{ $karya->jurusan_detail['name'] }} ({{ $karya->jurusan_detail['code'] }})
                        </h3>
                        <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                            Karya ini dirancang dan dikembangkan secara mandiri oleh siswa SMK Muhammadiyah 1 Bantul sebagai wujud implementasi kurikulum vokasi berbasis proyek nyata (Project Based Learning).
                        </p>
                    </div>
                </div>

            </div>

            <!-- Right Column: Description, Specs, Action Box (5 cols on lg) -->
            <div class="lg:col-span-5 space-y-6">
                
                <!-- Main Details Card -->
                <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
                    
                    <!-- Section: Deskripsi -->
                    <div>
                        <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-2 flex items-center gap-2">
                            <i class="fa-solid fa-align-left text-cyan-600"></i>
                            <span>Deskripsi & Inovasi Karya</span>
                        </h2>
                        <div class="karya-rich-description text-sm sm:text-base text-slate-700 leading-relaxed space-y-2">
                            {!! str_contains($karya->description, '<') ? $karya->description : nl2br(e($karya->description)) !!}
                        </div>
                    </div>

                    <hr class="border-slate-100">

                    <!-- Section: Alat, Bahan & Stack Teknologi -->
                    <div>
                        <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-3 flex items-center gap-2">
                            <i class="fa-solid fa-microchip text-teal-600"></i>
                            <span>Teknologi, Alat & Spesifikasi</span>
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            @if(is_array($karya->tech_stacks))
                                @foreach($karya->tech_stacks as $tech)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold bg-cyan-50 text-cyan-900 border border-cyan-200 shadow-sm">
                                        <i class="fa-solid fa-check text-[10px] text-cyan-600"></i>
                                        <span>{{ $tech }}</span>
                                    </span>
                                @endforeach
                            @endif
                        </div>
                    </div>



                </div>

                <!-- Callout: Guestbook Appreciation -->
                <div class="p-6 rounded-3xl bg-gradient-to-br from-cyan-50 to-teal-50 border border-cyan-200 shadow-sm space-y-3">
                    <div class="flex items-center gap-2 text-cyan-700 text-xs font-bold uppercase tracking-wider">
                        <i class="fa-solid fa-comments"></i>
                        <span>Beri Ulasan & Apresiasi</span>
                    </div>
                    <h3 class="text-base font-extrabold text-slate-900">
                        Tertarik dengan karya ini? Tulis kesan dan pesan Anda di Buku Tamu!
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Apresiasi dari pengunjung pameran menjadi motivasi besar bagi siswa SMK Muhammadiyah 1 Bantul untuk terus berinovasi.
                    </p>
                    <a href="{{ route('guestbook.index') }}" 
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs font-bold text-slate-950 bg-gradient-to-r from-cyan-400 to-teal-300 hover:from-cyan-300 hover:to-teal-200 shadow-md transition-all active:scale-95">
                        <i class="fa-solid fa-camera-retro"></i>
                        <span>Isi Buku Tamu & Selfie Sekarang</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

            </div>

        </div>

        <!-- Section: Related Works from Same Major -->
        @if($relatedApps->isNotEmpty())
            <div class="mt-16 pt-12 border-t border-slate-200">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <span class="text-xs font-bold text-cyan-600 uppercase tracking-wider">Karya Terkait</span>
                        <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 mt-0.5">
                            Karya Lainnya dari Jurusan {{ $karya->jurusan_detail['code'] }}
                        </h2>
                    </div>
                    <a href="{{ route('home', ['jurusan' => $karya->jurusan]) }}#katalog-karya" class="text-xs font-bold text-cyan-600 hover:text-cyan-700 flex items-center gap-1">
                        <span>Lihat Semua</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedApps as $item)
                        <div class="bg-white rounded-3xl overflow-hidden border border-slate-200 hover:border-cyan-300 shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col group">
                            <div class="relative aspect-video bg-slate-900 overflow-hidden">
                                <img src="{{ $item->thumbnail_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute top-3 left-3">
                                    <span class="px-2.5 py-1 rounded-lg text-[10px] font-bold {{ $item->jurusan_detail['badge_bg'] }} border shadow-sm">
                                        {{ $item->jurusan_detail['code'] }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <p class="text-[11px] text-slate-500 font-medium mb-1">{{ $item->student_name }} &bull; {{ $item->student_class }}</p>
                                    <h3 class="font-bold text-slate-900 text-sm group-hover:text-cyan-700 transition-colors line-clamp-2">
                                        {{ $item->title }}
                                    </h3>
                                    <p class="text-xs text-slate-600 mt-1.5 line-clamp-2">
                                        {{ $item->description }}
                                    </p>
                                </div>
                                <div class="pt-4 mt-3 border-t border-slate-100 flex items-center gap-2">
                                    <a href="{{ route('karya.show', $item) }}" class="flex-1 text-center py-2 rounded-xl text-xs font-bold text-slate-800 bg-slate-100 hover:bg-cyan-50 hover:text-cyan-700 transition-colors">
                                        Lihat Detail
                                    </a>
                                    @if(!empty($item->canva_url))
                                    <a href="{{ $item->canva_url }}" target="_blank" class="p-2 rounded-xl bg-teal-50 hover:bg-teal-100 text-teal-700 text-xs font-bold" title="Slide Canva">
                                        <i class="fa-solid fa-chalkboard-user"></i>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>

<!-- Lightbox Modal for Images -->
<div id="imageLightboxModal" class="fixed inset-0 z-50 bg-slate-950/95 backdrop-blur-md hidden items-center justify-center p-4 sm:p-8" onclick="closeImageLightbox()">
    <div class="relative max-w-5xl w-full max-h-[90vh] flex flex-col items-center" onclick="event.stopPropagation()">
        <!-- Close Button -->
        <button type="button" onclick="closeImageLightbox()" class="absolute -top-12 right-0 text-white hover:text-cyan-400 text-2xl transition-colors">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <!-- Enlarged Image -->
        <img id="lightboxImg" src="" alt="Enlarged" class="max-w-full max-h-[82vh] object-contain rounded-2xl shadow-2xl border border-white/10">
        
        <p class="text-xs text-slate-400 mt-3 text-center">{{ $karya->title }} &bull; SMK Muhammadiyah 1 Bantul</p>
    </div>
</div>

@push('scripts')
<script>
    const galleryImages = @json($gallery);
    let currentGalleryIndex = 0;

    function setGalleryIndex(index) {
        if (!galleryImages || galleryImages.length === 0) return;
        currentGalleryIndex = index;
        const mainImg = document.getElementById('mainGalleryImg');
        if (mainImg) {
            mainImg.src = galleryImages[index];
        }

        // Update counter
        const counter = document.getElementById('galleryCounter');
        if (counter) {
            counter.innerText = `Foto ${index + 1} dari ${galleryImages.length}`;
        }

        // Update active thumbnail border
        const thumbBtns = document.querySelectorAll('.gallery-thumb-btn');
        thumbBtns.forEach((btn, idx) => {
            if (idx === index) {
                btn.classList.add('border-cyan-500', 'ring-2', 'ring-cyan-500/30');
                btn.classList.remove('border-slate-200', 'opacity-70');
            } else {
                btn.classList.remove('border-cyan-500', 'ring-2', 'ring-cyan-500/30');
                btn.classList.add('border-slate-200', 'opacity-70');
            }
        });
    }

    function navigateGallery(direction) {
        if (!galleryImages || galleryImages.length === 0) return;
        let newIndex = currentGalleryIndex + direction;
        if (newIndex < 0) newIndex = galleryImages.length - 1;
        if (newIndex >= galleryImages.length) newIndex = 0;
        setGalleryIndex(newIndex);
    }

    function openImageLightbox(src) {
        const modal = document.getElementById('imageLightboxModal');
        const img = document.getElementById('lightboxImg');
        if (modal && img) {
            img.src = src;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }
    }

    function closeImageLightbox() {
        const modal = document.getElementById('imageLightboxModal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeImageLightbox();
        } else if (e.key === 'ArrowLeft') {
            navigateGallery(-1);
        } else if (e.key === 'ArrowRight') {
            navigateGallery(1);
        }
    });

    function copyProjectLink() {
        navigator.clipboard.writeText(window.location.href).then(() => {
            const textEl = document.getElementById('copyLinkText');
            if (textEl) {
                textEl.innerText = 'Tautan Berhasil Disalin!';
                setTimeout(() => {
                    textEl.innerText = 'Bagikan Tautan Karya Ini';
                }, 2500);
            }
        });
    }
</script>
@endpush
@endsection
