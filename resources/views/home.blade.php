@extends('layouts.app')

@section('title', 'Beranda - Pameran Aplikasi Karya Siswa SMK Muhammadiyah 1 Bantul')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-b from-[#0A192F] via-[#0F172A] to-slate-900 text-white pt-12 pb-20 sm:pt-20 sm:pb-28">
    <!-- Decorative Glow & Grid Background -->
    <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: radial-gradient(#06b6d4 1px, transparent 1px); background-size: 28px 28px;"></div>
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 -right-32 w-96 h-96 bg-teal-500/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-4xl mx-auto space-y-6">
            
            <!-- Event Pill Badge -->
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-cyan-950/80 border border-cyan-500/40 text-cyan-300 text-xs sm:text-sm font-semibold tracking-wide shadow-inner">
                <span class="w-2 h-2 rounded-full bg-cyan-400 animate-ping"></span>
                <span>Pameran Karya & Inovasi Teknologi Vokasi 2026</span>
            </div>

            <!-- Main Heading -->
            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight sm:leading-none text-white">
                Portal Aplikasi Karya Siswa <br class="hidden sm:inline" />
                <span class="text-gradient">SMK Muhammadiyah 1 Bantul</span>
            </h1>

            <!-- Subtitle -->
            <p class="text-base sm:text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Jelajahi karya inovasi dan kreativitas siswa Jurusan TKR, TPM, TSM, TAV, dan PPLG Musaba Bantul. Terbuka untuk industri, akademisi, dan publik.
            </p>

            <!-- Call to Actions -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-5 pt-4">
                <!-- Primary CTA: Isi Buku Tamu -->
                <div class="relative group w-full sm:w-auto">
                    <!-- Crisp Ambient Glow Effect -->
                    <div style="background: linear-gradient(135deg, #06b6d4 0%, #14b8a6 50%, #10b981 100%);" class="absolute -inset-1 rounded-2xl blur-lg opacity-85 group-hover:opacity-100 transition duration-300"></div>

                    <a href="{{ route('guestbook.index') }}" 
                       style="background: linear-gradient(135deg, #22d3ee 0%, #2dd4bf 50%, #34d399 100%);"
                       class="relative w-full sm:w-auto inline-flex items-center justify-center gap-3.5 px-8 py-4 sm:py-5 rounded-2xl text-base sm:text-lg font-black text-slate-950 shadow-2xl shadow-cyan-500/50 border-2 border-white hover:scale-[1.03] active:scale-[0.98] transition-all duration-300">
                        <span class="flex items-center justify-center w-11 h-11 rounded-xl bg-slate-950 text-cyan-300 shadow-md border border-cyan-400/40 group-hover:scale-110 transition-transform duration-300 shrink-0">
                            <i class="fa-solid fa-camera-retro text-xl"></i>
                        </span>
                        <div class="text-left">
                            <span class="block text-slate-950 font-black tracking-tight leading-tight text-base sm:text-lg">Isi Buku Tamu & Foto Selfie</span>
                            <span class="block text-[11px] font-black text-teal-950 tracking-wider uppercase">Wajib untuk Pengunjung Pameran</span>
                        </div>
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-slate-950 text-cyan-300 shadow-sm transition-all duration-300 ml-1 shrink-0 group-hover:translate-x-1">
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </span>
                    </a>
                </div>

                <!-- Secondary CTA: Scroll to Catalog -->
                <a href="#katalog-karya" class="w-full sm:w-auto inline-flex items-center justify-center gap-3.5 px-8 py-4 sm:py-5 rounded-2xl text-base sm:text-lg font-black text-white bg-slate-900/95 hover:bg-slate-800 border-2 border-cyan-400/70 hover:border-cyan-300 shadow-2xl shadow-slate-950/60 hover:shadow-cyan-500/30 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 group">
                    <span class="flex items-center justify-center w-11 h-11 rounded-xl bg-cyan-500/20 text-cyan-300 border border-cyan-400/40 group-hover:scale-105 transition-transform shrink-0">
                        <i class="fa-solid fa-cubes text-lg"></i>
                    </span>
                    <span class="tracking-tight">Jelajahi Katalog Aplikasi</span>
                    <i class="fa-solid fa-chevron-down text-xs text-cyan-400 group-hover:translate-y-0.5 transition-transform"></i>
                </a>
            </div>

        </div>
    </div>

    <!-- Bottom Wave Separator -->
    <div class="absolute bottom-0 left-0 right-0 leading-none">
        <svg class="w-full h-8 sm:h-12 text-slate-50 fill-current" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0 C150,90 350,-40 500,50 C650,140 900,10 1200,40 L1200,120 L0,120 Z"></path>
        </svg>
    </div>
</section>

<!-- Section Katalog Aplikasi -->
<section id="katalog-karya" class="py-12 sm:py-20 bg-slate-50 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 sm:mb-12 gap-6">
            <div>
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-cyan-100/70 border border-cyan-200 text-cyan-800 text-xs font-bold tracking-wide uppercase mb-2">
                    <i class="fa-solid fa-graduation-cap text-[11px] text-cyan-600"></i> Galeri Karya per Jurusan
                </div>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    Katalog Karya Siswa Musaba
                </h2>
                <p class="text-sm sm:text-base text-slate-600 mt-1 max-w-xl">
                    Pilih jurusan atau karya untuk melihat detail spesifikasi teknologi, galeri foto karya, pengembang, dan presentasi lengkap dari setiap proyek.
                </p>
            </div>

            <!-- Search and Filter Bar -->
            <form action="{{ route('home') }}#katalog-karya" method="GET" class="w-full md:w-auto flex flex-col sm:flex-row items-center gap-3">
                <div class="relative w-full sm:w-72">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Cari karya / siswa / teknologi..." 
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-300 bg-white text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 shadow-sm transition-all"
                    >
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3.5 text-slate-400 text-sm"></i>
                    @if(request('search'))
                        <a href="{{ route('home') }}#katalog-karya" class="absolute right-3 top-3 text-slate-400 hover:text-slate-600 text-xs">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </a>
                    @endif
                </div>

                @if(request('jurusan'))
                    <input type="hidden" name="jurusan" value="{{ request('jurusan') }}">
                @endif
                <button type="submit" class="w-full sm:w-auto px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold shadow-sm transition-colors">
                    Cari
                </button>
            </form>
        </div>

        <!-- Jurusan Filter Pills -->
        <div class="flex items-center gap-2 overflow-x-auto pb-4 mb-8 no-scrollbar scroll-smooth">
            <a 
                href="{{ route('home', array_merge(request()->except('jurusan', 'category', 'page'), ['jurusan' => 'all'])) }}#katalog-karya" 
                class="px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold whitespace-nowrap transition-all flex items-center gap-2 {{ (!request('jurusan') && !request('category')) || request('jurusan') === 'all' || request('category') === 'all' ? 'bg-cyan-600 text-white shadow-md shadow-cyan-600/30' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}"
            >
                <i class="fa-solid fa-border-all"></i>
                <span>Semua Jurusan</span>
                <span class="px-1.5 py-0.2 rounded-md bg-black/15 text-[11px] font-mono">{{ $apps->count() }}</span>
            </a>
            @foreach($jurusanList as $code => $info)
                @php
                    $isActive = request('jurusan') === $code || request('category') === $code;
                    $count = $jurusanCounts[$code] ?? 0;
                @endphp
                <a 
                    href="{{ route('home', array_merge(request()->except('jurusan', 'category', 'page'), ['jurusan' => $code])) }}#katalog-karya" 
                    title="{{ $info['name'] }}"
                    class="px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold whitespace-nowrap transition-all flex items-center gap-2 {{ $isActive ? $info['pill_active'] : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200 hover:border-slate-300' }}"
                >
                    <i class="{{ $info['icon'] }}"></i>
                    <span>{{ $code }}</span>
                    <span class="hidden md:inline font-normal text-xs opacity-80">({{ $info['short'] }})</span>
                    <span class="px-1.5 py-0.2 rounded-md {{ $isActive ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600' }} text-[11px] font-mono">
                        {{ $count }}
                    </span>
                </a>
            @endforeach
        </div>

        <!-- Applications Grid: 1 col on HP, 2 col on Tablet, 3-4 col on Desktop -->
        @if($apps->isEmpty())
            <div class="text-center py-16 bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">
                <div class="w-16 h-16 rounded-2xl bg-cyan-50 border border-cyan-100 text-cyan-600 flex items-center justify-center mx-auto mb-4 text-2xl">
                    <i class="fa-regular fa-folder-open"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Tidak ada karya yang ditemukan</h3>
                <p class="text-sm text-slate-500 mt-1 max-w-sm mx-auto">Coba gunakan kata kunci pencarian yang lain atau pilih jurusan lainnya.</p>
                <a href="{{ route('home') }}#katalog-karya" class="inline-block mt-4 px-4 py-2 rounded-xl bg-slate-900 text-white text-xs font-semibold">
                    Reset Filter
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6 sm:gap-8">
                @foreach($apps as $app)
                    <!-- Application Card Component -->
                    <div class="group bg-white rounded-3xl overflow-hidden border border-slate-200 hover:border-cyan-300 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col hover:-translate-y-1.5">
                        
                        <!-- Thumbnail & Jurusan Tag -->
                        <a href="{{ route('karya.show', $app) }}" class="relative overflow-hidden aspect-video bg-slate-900 block">
                            <img 
                                src="{{ $app->thumbnail_url }}" 
                                alt="{{ $app->title }}" 
                                loading="lazy"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                            
                            <!-- Badges Top -->
                            <div class="absolute top-3 left-3 flex flex-wrap gap-1.5">
                                <span class="px-2.5 py-1 rounded-lg text-[11px] font-bold {{ $app->jurusan_detail['badge_bg'] }} border shadow-sm flex items-center gap-1.5">
                                    <i class="{{ $app->jurusan_detail['icon'] }} text-[10px]"></i>
                                    <span>{{ $app->jurusan_detail['code'] }}</span>
                                </span>
                                @if($app->featured)
                                    <span class="px-2.5 py-1 rounded-lg text-[11px] font-bold bg-amber-500 text-slate-950 shadow-sm flex items-center gap-1">
                                        <i class="fa-solid fa-star text-[10px]"></i> Unggulan
                                    </span>
                                @endif
                            </div>

                            <!-- Bottom Badges: Multiple Photos & Class -->
                            <div class="absolute bottom-2.5 left-3 right-3 flex items-center justify-between pointer-events-none">
                                @if(!empty($app->gallery_images) && count($app->gallery_images) > 1)
                                    <div class="text-[10px] font-bold text-white bg-slate-950/80 backdrop-blur-sm px-2 py-0.5 rounded-md border border-slate-700 flex items-center gap-1">
                                        <i class="fa-solid fa-camera text-cyan-400"></i>
                                        <span>{{ count($app->gallery_images) }} Foto</span>
                                    </div>
                                @else
                                    <div></div>
                                @endif

                                @if($app->student_class)
                                    <div class="text-[11px] font-semibold text-slate-300 bg-slate-950/80 backdrop-blur-sm px-2 py-0.5 rounded-md border border-slate-700">
                                        {{ $app->student_class }}
                                    </div>
                                @endif
                            </div>
                        </a>

                        <!-- Card Content Body -->
                        <div class="p-5 sm:p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <!-- Author / Team -->
                                <div class="flex items-center gap-2 text-xs text-slate-500 font-medium mb-1.5">
                                    <i class="fa-solid fa-user-graduate text-cyan-600"></i>
                                    <span class="truncate">{{ $app->student_name }}</span>
                                </div>

                                <!-- Title -->
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-cyan-700 transition-colors line-clamp-2 leading-snug">
                                    <a href="{{ route('karya.show', $app) }}">
                                        {{ $app->title }}
                                    </a>
                                </h3>

                                <!-- Description -->
                                <p class="text-xs sm:text-sm text-slate-600 mt-2 line-clamp-3 leading-relaxed">
                                    {{ $app->description }}
                                </p>

                                <!-- Tech Stack / Equipment Badges -->
                                <div class="mt-4 flex flex-wrap gap-1.5">
                                    @if(is_array($app->tech_stacks))
                                        @foreach(array_slice($app->tech_stacks, 0, 4) as $tech)
                                            <span class="text-[11px] font-medium px-2.5 py-0.5 rounded-md bg-slate-100 text-slate-700 border border-slate-200">
                                                {{ $tech }}
                                            </span>
                                        @endforeach
                                        @if(count($app->tech_stacks) > 4)
                                            <span class="text-[10px] font-medium px-1.5 py-0.5 rounded-md bg-slate-50 text-slate-500">
                                                +{{ count($app->tech_stacks) - 4 }}
                                            </span>
                                        @endif
                                    @endif
                                </div>
                            </div>

                            <!-- Card Action Buttons -->
                            <div class="pt-5 mt-4 border-t border-slate-100 flex items-center gap-2">
                                <!-- Detail Karya Page Button -->
                                <a 
                                    href="{{ route('karya.show', $app) }}" 
                                    class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2.5 rounded-xl text-xs font-bold text-slate-900 bg-slate-100 hover:bg-cyan-50 hover:text-cyan-700 border border-slate-200 hover:border-cyan-200 active:scale-95 transition-all"
                                    title="Lihat Detail Karya & Galeri Foto"
                                >
                                    <i class="fa-solid fa-circle-info text-cyan-600"></i>
                                    <span>Detail Karya</span>
                                </a>

                                @if(!empty($app->canva_url))
                                <!-- Canva Presentation Button -->
                                <a 
                                    href="{{ $app->canva_url }}" 
                                    target="_blank" 
                                    rel="noopener noreferrer" 
                                    class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2.5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-teal-500 to-cyan-600 hover:from-teal-600 hover:to-cyan-700 shadow-sm active:scale-95 transition-all"
                                    title="Lihat Presentasi di Canva"
                                >
                                    <i class="fa-solid fa-chalkboard-user"></i>
                                    <span>Lihat Presentasi</span>
                                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                                </a>
                                @endif
                            </div>

                        </div>

                    </div>
                @endforeach
            </div>
        @endif

    </div>
</section>

<!-- Section Tentang Pameran -->
<section id="tentang-pameran" class="py-16 sm:py-20 bg-white border-y border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <div class="lg:col-span-6 space-y-4">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-teal-100 text-teal-800 text-xs font-bold uppercase tracking-wider">
                    <i class="fa-solid fa-trophy text-teal-600"></i> Vokasi Siap Kerja & Berinovasi
                </span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                    Mengasah Kemampuan Teknologi Nyata di SMK Muhammadiyah 1 Bantul
                </h2>
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                    Pameran ini merupakan etalase karya Proyek Kreatif & Kewirausahaan (PKK) serta Tugas Akhir siswa Jurusan <strong>Teknik Kendaraan Ringan (TKR)</strong>, <strong>Teknik Pemesinan (TPM)</strong>, <strong>Teknik Sepeda Motor (TSM)</strong>, <strong>Teknik Audio Video (TAV)</strong>, dan <strong>Pengembangan Perangkat Lunak & Gim (PPLG)</strong>.
                </p>
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                    Melalui kurikulum berbasis industri dan project-based learning, siswa Musaba dilatih membangun solusi perangkat lunak yang menjawab persoalan nyata di sekolah, UMKM lokal Bantul, hingga industri nasional.
                </p>

                <div class="pt-3 grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs sm:text-sm font-semibold text-slate-800">
                    <div class="flex items-center gap-2.5"><i class="fa-solid fa-circle-check text-cyan-600 text-base"></i> Berorientasi Problem Solving</div>
                    <div class="flex items-center gap-2.5"><i class="fa-solid fa-circle-check text-cyan-600 text-base"></i> Standar Clean Code & Git</div>
                    <div class="flex items-center gap-2.5"><i class="fa-solid fa-circle-check text-cyan-600 text-base"></i> Presentasi Mandiri &amp; Dokumentasi</div>
                    <div class="flex items-center gap-2.5"><i class="fa-solid fa-circle-check text-cyan-600 text-base"></i> Bimbingan Guru & Praktisi</div>
                </div>
            </div>

            <!-- Visual Feature Box -->
            <div class="lg:col-span-6">
                <div class="relative p-6 sm:p-8 rounded-3xl bg-gradient-to-br from-slate-900 via-slate-800 to-slate-950 text-white shadow-2xl border border-slate-700/60 overflow-hidden">
                    <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-cyan-500/10 rounded-full blur-2xl"></div>

                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-cyan-500/20 text-cyan-300 flex items-center justify-center font-bold">
                                <i class="fa-solid fa-laptop-code"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm sm:text-base">Musaba Digital Exhibition</h4>
                                <p class="text-xs text-slate-400">SMK Pusat Keunggulan Bantul</p>
                            </div>
                        </div>
                        <span class="px-2.5 py-1 rounded-md text-[11px] font-bold bg-teal-500/20 text-teal-300 border border-teal-500/30">
                            Aktif
                        </span>
                    </div>

                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed mb-6">
                        "Setiap pengunjung pameran diharapkan mengisi Buku Tamu digital untuk memberikan apresiasi, saran, dan kritik membangun bagi pengembangan portofolio siswa."
                    </p>

                    <div class="p-4 rounded-2xl bg-slate-900/80 border border-slate-700/80 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-slate-400">Belum mengisi buku tamu?</span>
                            <h5 class="text-sm font-bold text-cyan-300">Tinggalkan Jejak & Selfie Anda</h5>
                        </div>
                        <a href="{{ route('guestbook.index') }}" class="px-4 py-2 rounded-xl text-xs font-bold bg-cyan-400 hover:bg-cyan-300 text-slate-950 transition-colors">
                            Buka Buku Tamu
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Section Wall of Visitors / Preview Buku Tamu -->
@if($recentGuestbooks->isNotEmpty())
<section class="py-14 sm:py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-teal-600">Apresiasi Pengunjung</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-1">
                    Suara & Kesan Pengunjung Expo
                </h2>
            </div>
            <a href="{{ route('guestbook.index') }}" class="text-xs sm:text-sm font-bold text-cyan-600 hover:text-cyan-700 flex items-center gap-1.5">
                <span>Lihat Semua Buku Tamu ({{ $stats['total_visitors'] }})</span>
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($recentGuestbooks as $item)
                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-3 mb-3">
                            @if($item->selfie_url)
                                <img src="{{ $item->selfie_url }}" alt="{{ $item->name }}" class="w-11 h-11 rounded-full object-cover border-2 border-cyan-400 shadow-sm">
                            @else
                                <div class="w-11 h-11 rounded-full bg-slate-100 border border-slate-200 text-slate-600 flex items-center justify-center font-bold text-sm">
                                    {{ strtoupper(substr($item->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="overflow-hidden">
                                <h4 class="text-xs sm:text-sm font-bold text-slate-900 truncate">{{ $item->name }}</h4>
                                <p class="text-[11px] text-slate-500 truncate">{{ $item->institution }}</p>
                            </div>
                        </div>

                        <!-- Rating Stars -->
                        <div class="flex text-amber-400 text-xs mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fa-solid fa-star {{ $i <= $item->rating ? 'text-amber-400' : 'text-slate-200' }}"></i>
                            @endfor
                        </div>

                        <p class="text-xs text-slate-600 italic line-clamp-3 leading-relaxed">
                            "{{ $item->message }}"
                        </p>
                    </div>

                    <div class="pt-3 mt-3 border-t border-slate-100 text-[10px] text-slate-400 flex items-center justify-between">
                        <span><i class="fa-regular fa-clock mr-1"></i> {{ $item->created_at->diffForHumans() }}</span>
                        <span class="text-teal-600 font-semibold"><i class="fa-solid fa-circle-check"></i> Terverifikasi</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Application Detail Modal -->
<div id="appModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-950/70 backdrop-blur-sm p-4 sm:p-6 flex items-center justify-center">
    <div class="relative w-full max-w-2xl bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-200 transition-all transform animate-in fade-in zoom-in duration-200">
        
        <!-- Modal Header Image -->
        <div class="relative aspect-video bg-slate-950">
            <img id="modalImg" src="" alt="" class="w-full h-full object-cover">
            <button onclick="closeModal()" type="button" class="absolute top-4 right-4 w-9 h-9 rounded-full bg-slate-900/80 text-white hover:bg-slate-900 flex items-center justify-center transition-all">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
            <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between">
                <span id="modalCategory" class="px-3 py-1 rounded-lg text-xs font-bold bg-cyan-900/90 text-cyan-300 border border-cyan-500/30"></span>
                <span id="modalClass" class="px-2.5 py-1 rounded-md text-xs font-semibold bg-slate-900/90 text-slate-300"></span>
            </div>
        </div>

        <!-- Modal Body Content -->
        <div class="p-6 sm:p-8 space-y-4">
            <div>
                <div class="flex items-center gap-2 text-xs text-slate-500 font-medium">
                    <i class="fa-regular fa-user text-cyan-600"></i>
                    <span id="modalAuthor"></span>
                </div>
                <h3 id="modalTitle" class="text-xl sm:text-2xl font-extrabold text-slate-900 mt-1"></h3>
            </div>

            <p id="modalDesc" class="text-sm text-slate-600 leading-relaxed"></p>

            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Teknologi yang Digunakan:</span>
                <div id="modalTech" class="flex flex-wrap gap-1.5 mt-2"></div>
            </div>

            <!-- Modal Action Buttons -->
            <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center gap-3">
                <a 
                    id="modalCanvaBtn" 
                    href="#" 
                    target="_blank" 
                    rel="noopener noreferrer" 
                    class="w-full sm:flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-teal-500 to-cyan-600 hover:from-teal-600 hover:to-cyan-700 shadow-md transition-all"
                >
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <span>Buka Presentasi di Canva</span>
                    <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                </a>
                <button 
                    type="button" 
                    onclick="closeModal()" 
                    class="w-full sm:w-auto px-5 py-3 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-sm font-semibold transition-colors"
                >
                    Tutup
                </button>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
    function openModal(app) {
        document.getElementById('modalTitle').textContent = app.title;
        document.getElementById('modalAuthor').textContent = app.student_name + (app.student_class ? ' (' + app.student_class + ')' : '');
        document.getElementById('modalCategory').textContent = app.category;
        document.getElementById('modalClass').textContent = app.student_class || 'SMK Muhammadiyah 1 Bantul';
        document.getElementById('modalDesc').textContent = app.description;
        document.getElementById('modalImg').src = app.thumbnail_url || app.thumbnail;
        
        const canvaBtn = document.getElementById('modalCanvaBtn');
        if (canvaBtn) {
            if (app.canva_url) {
                canvaBtn.href = app.canva_url;
                canvaBtn.classList.remove('hidden');
            } else {
                canvaBtn.classList.add('hidden');
            }
        }

        // Render tech tags
        const techContainer = document.getElementById('modalTech');
        techContainer.innerHTML = '';
        if (Array.isArray(app.tech_stacks)) {
            app.tech_stacks.forEach(tech => {
                const tag = document.createElement('span');
                tag.className = 'text-xs font-medium px-2.5 py-1 rounded-md bg-cyan-50 text-cyan-800 border border-cyan-200';
                tag.textContent = tech;
                techContainer.appendChild(tag);
            });
        }

        document.getElementById('appModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('appModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modal on click outside
    document.getElementById('appModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Close on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
</script>
@endpush
