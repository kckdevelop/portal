@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header_title', 'Ringkasan Dashboard')
@section('header_subtitle', 'Selamat datang di Panel Manajemen Portal Pameran Aplikasi Siswa')

@section('content')
<div class="space-y-8">

    <!-- Stat Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        
        <!-- Total Karya -->
        <div class="p-5 rounded-2xl bg-slate-900/80 border border-slate-800 shadow-lg relative overflow-hidden group hover:border-cyan-500/50 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Karya Siswa</p>
                    <p class="text-3xl font-extrabold text-white mt-1 group-hover:text-cyan-400 transition-colors">
                        {{ $stats['total_apps'] }}
                    </p>
                    <p class="text-[11px] text-cyan-400 mt-1 flex items-center gap-1">
                        <i class="fa-solid fa-layer-group"></i> Terdaftar di katalog
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-cyan-500/10 text-cyan-400 flex items-center justify-center text-xl border border-cyan-500/20 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-cubes"></i>
                </div>
            </div>
            <a href="{{ route('admin.karya.index') }}" class="mt-4 pt-3 border-t border-slate-800 flex items-center justify-between text-xs font-medium text-slate-400 hover:text-cyan-400">
                <span>Kelola karya</span>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
            </a>
        </div>

        <!-- Featured Karya -->
        <div class="p-5 rounded-2xl bg-slate-900/80 border border-slate-800 shadow-lg relative overflow-hidden group hover:border-amber-500/50 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Karya Rekomendasi</p>
                    <p class="text-3xl font-extrabold text-white mt-1 group-hover:text-amber-400 transition-colors">
                        {{ $stats['total_featured'] }}
                    </p>
                    <p class="text-[11px] text-amber-400 mt-1 flex items-center gap-1">
                        <i class="fa-solid fa-star"></i> Unggulan di header
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-400 flex items-center justify-center text-xl border border-amber-500/20 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-award"></i>
                </div>
            </div>
            <a href="{{ route('admin.karya.index', ['featured' => '1']) }}" class="mt-4 pt-3 border-t border-slate-800 flex items-center justify-between text-xs font-medium text-slate-400 hover:text-amber-400">
                <span>Lihat unggulan</span>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
            </a>
        </div>

        <!-- Total Buku Tamu -->
        <div class="p-5 rounded-2xl bg-slate-900/80 border border-slate-800 shadow-lg relative overflow-hidden group hover:border-teal-500/50 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Pengunjung Buku Tamu</p>
                    <p class="text-3xl font-extrabold text-white mt-1 group-hover:text-teal-400 transition-colors">
                        {{ $stats['total_guestbooks'] }}
                    </p>
                    <p class="text-[11px] text-emerald-400 mt-1 flex items-center gap-1">
                        <i class="fa-solid fa-check-double"></i> {{ $stats['approved_guestbooks'] }} disetujui tampil
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-teal-500/10 text-teal-400 flex items-center justify-center text-xl border border-teal-500/20 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-book-bookmark"></i>
                </div>
            </div>
            <a href="{{ route('admin.guestbook.index') }}" class="mt-4 pt-3 border-t border-slate-800 flex items-center justify-between text-xs font-medium text-slate-400 hover:text-teal-400">
                <span>Moderasi buku tamu</span>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
            </a>
        </div>

        <!-- Rata-rata Rating -->
        <div class="p-5 rounded-2xl bg-slate-900/80 border border-slate-800 shadow-lg relative overflow-hidden group hover:border-sky-500/50 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Rating Kepuasan</p>
                    <div class="flex items-baseline gap-1 mt-1">
                        <span class="text-3xl font-extrabold text-white group-hover:text-sky-400 transition-colors">{{ $stats['average_rating'] }}</span>
                        <span class="text-xs text-slate-500">/ 5.0</span>
                    </div>
                    <div class="flex items-center gap-1 text-amber-400 text-xs mt-1">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fa-solid fa-star {{ $i <= round($stats['average_rating']) ? 'text-amber-400' : 'text-slate-700' }}"></i>
                        @endfor
                    </div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-sky-500/10 text-sky-400 flex items-center justify-center text-xl border border-sky-500/20 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-face-smile"></i>
                </div>
            </div>
            <a href="{{ route('admin.guestbook.index') }}" class="mt-4 pt-3 border-t border-slate-800 flex items-center justify-between text-xs font-medium text-slate-400 hover:text-sky-400">
                <span>Ulasan pengunjung</span>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
            </a>
        </div>
    </div>

    <!-- Quick Action Banner -->
    <div class="p-6 rounded-2xl bg-gradient-to-r from-slate-900 via-slate-900 to-cyan-950/60 border border-cyan-900/50 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h2 class="text-base font-bold text-white flex items-center gap-2">
                <i class="fa-solid fa-bolt text-cyan-400"></i> Aksi Cepat Pengaturan
            </h2>
            <p class="text-xs text-slate-400 mt-0.5">
                Pilih tindakan cepat untuk memperbarui karya siswa, mengubah logo sekolah, atau memeriksa ulasan buku tamu terbaru.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-2.5">
            <a href="{{ route('admin.karya.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-slate-950 bg-gradient-to-r from-cyan-400 to-teal-400 hover:from-cyan-300 hover:to-teal-300 shadow-md shadow-cyan-500/20 transition-all">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Karya Baru</span>
            </a>
            <a href="{{ route('admin.settings.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-200 bg-slate-800 hover:bg-slate-700 border border-slate-700 transition-all">
                <i class="fa-solid fa-image text-cyan-400"></i>
                <span>Atur Logo Sekolah</span>
            </a>
            <a href="{{ route('admin.guestbook.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-200 bg-slate-800 hover:bg-slate-700 border border-slate-700 transition-all">
                <i class="fa-solid fa-comments text-teal-400"></i>
                <span>Lihat Buku Tamu</span>
            </a>
        </div>
    </div>

    <!-- Dual Grid: Latest Karya & Latest Guestbook -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Karya Siswa Terbaru -->
        <div class="p-6 rounded-2xl bg-slate-900/80 border border-slate-800 shadow-md">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-cyan-500/10 text-cyan-400 flex items-center justify-center text-sm border border-cyan-500/20">
                        <i class="fa-solid fa-laptop-code"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-white">Karya Siswa Terbaru</h2>
                        <p class="text-[11px] text-slate-400">Karya yang baru ditambahkan ke galeri</p>
                    </div>
                </div>
                <a href="{{ route('admin.karya.index') }}" class="text-xs font-semibold text-cyan-400 hover:underline">
                    Lihat Semua &rarr;
                </a>
            </div>

            <div class="space-y-3">
                @forelse($latestApps as $item)
                    <div class="p-3 rounded-xl bg-slate-950/60 border border-slate-800/80 flex items-center gap-3 hover:border-slate-700 transition-all">
                        <img src="{{ $item->thumbnail_url }}" alt="{{ $item->title }}" class="w-14 h-14 object-cover rounded-lg border border-slate-800 flex-shrink-0 bg-slate-900">
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center gap-2">
                                <h3 class="text-xs font-bold text-white truncate">{{ $item->title }}</h3>
                                @if($item->featured)
                                    <span class="text-[10px] bg-amber-500/20 text-amber-300 px-1.5 py-0.5 rounded border border-amber-500/30 flex items-center gap-1">
                                        <i class="fa-solid fa-star text-[9px]"></i> Unggulan
                                    </span>
                                @endif
                            </div>
                            <p class="text-[11px] text-slate-400 mt-0.5">
                                Oleh: <span class="text-slate-300 font-medium">{{ $item->student_name }}</span> ({{ $item->student_class }})
                            </p>
                            <span class="inline-block mt-1 text-[10px] text-cyan-400 font-semibold bg-cyan-950/60 px-2 py-0.5 rounded border border-cyan-800/50">
                                {{ $item->category }}
                            </span>
                        </div>
                        <div class="flex items-center gap-1.5 flex-shrink-0">
                            <a href="{{ route('admin.karya.edit', $item) }}" class="p-2 text-slate-400 hover:text-white hover:bg-slate-800 rounded-lg transition-colors" title="Edit Karya">
                                <i class="fa-solid fa-pen-to-square text-xs"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-xs text-slate-500">
                        Belum ada data karya siswa yang tersimpan.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Buku Tamu Terbaru -->
        <div class="p-6 rounded-2xl bg-slate-900/80 border border-slate-800 shadow-md">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-teal-500/10 text-teal-400 flex items-center justify-center text-sm border border-teal-500/20">
                        <i class="fa-solid fa-book-bookmark"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-white">Buku Tamu Terbaru</h2>
                        <p class="text-[11px] text-slate-400">Ulasan & kesan pengunjung expo</p>
                    </div>
                </div>
                <a href="{{ route('admin.guestbook.index') }}" class="text-xs font-semibold text-cyan-400 hover:underline">
                    Lihat Semua &rarr;
                </a>
            </div>

            <div class="space-y-3">
                @forelse($latestGuestbooks as $guest)
                    <div class="p-3.5 rounded-xl bg-slate-950/60 border border-slate-800/80 flex items-start gap-3 hover:border-slate-700 transition-all">
                        @if($guest->selfie_url)
                            <img src="{{ $guest->selfie_url }}" alt="{{ $guest->name }}" class="w-12 h-12 object-cover rounded-lg border border-slate-800 flex-shrink-0 bg-slate-900">
                        @else
                            <div class="w-12 h-12 rounded-lg bg-slate-800 text-slate-400 flex items-center justify-center flex-shrink-0 text-sm border border-slate-700">
                                <i class="fa-solid fa-user"></i>
                            </div>
                        @endif
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center justify-between gap-2">
                                <h3 class="text-xs font-bold text-white truncate">{{ $guest->name }}</h3>
                                <div class="flex items-center text-amber-400 text-[10px]">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa-solid fa-star {{ $i <= $guest->rating ? 'text-amber-400' : 'text-slate-700' }}"></i>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-[10px] text-cyan-400 font-medium truncate">{{ $guest->institution }}</p>
                            <p class="text-xs text-slate-300 mt-1 line-clamp-2 italic">
                                "{{ $guest->message }}"
                            </p>
                            <div class="flex items-center justify-between mt-2 pt-1.5 border-t border-slate-800/60 text-[10px] text-slate-400">
                                <span>{{ $guest->created_at->diffForHumans() }}</span>
                                <span class="px-2 py-0.5 rounded-full {{ $guest->is_approved ? 'bg-emerald-950 text-emerald-300 border border-emerald-800/60' : 'bg-slate-800 text-slate-400 border border-slate-700' }}">
                                    {{ $guest->is_approved ? 'Disetujui' : 'Disembunyikan' }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-xs text-slate-500">
                        Belum ada ulasan buku tamu yang masuk.
                    </div>
                @endforelse
            </div>
        </div>

    </div>

</div>
@endsection
