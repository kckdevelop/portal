@extends('layouts.admin')

@section('title', 'Data Karya Siswa')
@section('header_title', 'Kelola Data Karya Siswa')
@section('header_subtitle', 'Tambah, edit, hapus, dan atur rekomendasi karya siswa per jurusan')

@section('content')
<div class="space-y-6">

    <!-- Top Action Bar & Filter -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-5 rounded-2xl bg-slate-900 border border-slate-800 shadow-md">
        
        <!-- Search & Filter Form -->
        <form action="{{ route('admin.karya.index') }}" method="GET" class="flex flex-wrap items-center gap-3 flex-1">
            
            <!-- Search Input -->
            <div class="relative flex-1 min-w-[220px]">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                </div>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari judul karya, siswa, kelas..."
                    class="w-full pl-9 pr-3 py-2 bg-slate-950 border border-slate-700 rounded-xl text-white placeholder-slate-500 text-xs focus:outline-none focus:ring-2 focus:ring-cyan-500">
            </div>

            <!-- Jurusan Filter -->
            <select name="jurusan" onchange="this.form.submit()"
                class="px-3 py-2 bg-slate-950 border border-slate-700 rounded-xl text-white text-xs focus:outline-none focus:ring-2 focus:ring-cyan-500">
                <option value="all">Semua Jurusan</option>
                @foreach($jurusanList as $code => $info)
                    <option value="{{ $code }}" {{ $jurusan === $code ? 'selected' : '' }}>
                        {{ $code }} - {{ $info['short'] }}
                    </option>
                @endforeach
            </select>

            <!-- Featured Filter -->
            <select name="featured" onchange="this.form.submit()"
                class="px-3 py-2 bg-slate-950 border border-slate-700 rounded-xl text-white text-xs focus:outline-none focus:ring-2 focus:ring-cyan-500">
                <option value="">Semua Status</option>
                <option value="1" {{ $featured === '1' ? 'selected' : '' }}>Hanya Unggulan</option>
                <option value="0" {{ $featured === '0' ? 'selected' : '' }}>Bukan Unggulan</option>
            </select>

            @if($search || ($jurusan && $jurusan !== 'all') || ($featured !== null && $featured !== ''))
                <a href="{{ route('admin.karya.index') }}" class="px-3 py-2 text-xs text-slate-400 hover:text-white bg-slate-800 rounded-xl border border-slate-700 transition-colors">
                    Reset Filter
                </a>
            @endif
        </form>

        <!-- Add Button -->
        <div class="flex-shrink-0">
            <a href="{{ route('admin.karya.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-slate-950 bg-gradient-to-r from-cyan-400 to-teal-400 hover:from-cyan-300 hover:to-teal-300 shadow-md shadow-cyan-500/20 active:scale-95 transition-all">
                <i class="fa-solid fa-plus text-sm"></i>
                <span>Tambah Karya Siswa</span>
            </a>
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="border-b border-slate-800 bg-slate-950/60 text-slate-400 uppercase tracking-wider font-semibold">
                        <th class="py-3.5 px-4 w-12 text-center">#</th>
                        <th class="py-3.5 px-4 w-20">Thumbnail</th>
                        <th class="py-3.5 px-4">Judul Karya & Siswa</th>
                        <th class="py-3.5 px-4">Jurusan</th>
                        <th class="py-3.5 px-4">Alat / Teknologi</th>
                        <th class="py-3.5 px-4 text-center">Rekomendasi</th>
                        <th class="py-3.5 px-4 text-center">Tautan</th>
                        <th class="py-3.5 px-4 text-right w-36">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/70 text-slate-300">
                    @forelse($apps as $index => $item)
                        <tr class="hover:bg-slate-800/40 transition-colors">
                            <td class="py-3.5 px-4 text-center font-mono text-slate-500">
                                {{ $apps->firstItem() + $index }}
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="relative w-14 h-12 rounded-lg overflow-hidden border border-slate-800 bg-slate-950">
                                    <img src="{{ $item->thumbnail_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                                    @if(!empty($item->images) && count($item->images) > 0)
                                        <span class="absolute bottom-0 right-0 bg-slate-950/90 text-cyan-300 text-[9px] px-1 font-bold rounded-tl">
                                            +{{ count($item->images) }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="py-3.5 px-4 max-w-[240px]">
                                <h3 class="font-bold text-white text-sm truncate" title="{{ $item->title }}">{{ $item->title }}</h3>
                                <p class="text-slate-400 mt-0.5">
                                    <i class="fa-solid fa-user-graduate text-[10px] text-cyan-400 mr-1"></i>
                                    <span class="text-slate-200 font-medium">{{ $item->student_name }}</span>
                                    <span class="text-slate-500">&bull; {{ $item->student_class }}</span>
                                </p>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-bold {{ $item->jurusan_detail['badge_bg'] }} border shadow-sm flex items-center gap-1.5 w-fit">
                                    <i class="{{ $item->jurusan_detail['icon'] }} text-[10px]"></i>
                                    <span>{{ $item->jurusan_detail['code'] }}</span>
                                </span>
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="flex flex-wrap gap-1 max-w-[200px]">
                                    @if(is_array($item->tech_stacks))
                                        @foreach(array_slice($item->tech_stacks, 0, 3) as $tech)
                                            <span class="px-1.5 py-0.5 rounded bg-slate-800 text-[10px] text-slate-300 border border-slate-700">
                                                {{ $tech }}
                                            </span>
                                        @endforeach
                                        @if(count($item->tech_stacks) > 3)
                                            <span class="px-1 text-[9px] text-slate-500">+{{ count($item->tech_stacks) - 3 }}</span>
                                        @endif
                                    @endif
                                </div>
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <form action="{{ route('admin.karya.toggle-featured', $item) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" title="{{ $item->featured ? 'Klik untuk batal jadikan unggulan' : 'Klik untuk jadikan unggulan' }}"
                                        class="p-2 rounded-xl text-sm transition-all {{ $item->featured ? 'text-amber-400 bg-amber-500/15 hover:bg-amber-500/25 border border-amber-500/30' : 'text-slate-600 hover:text-slate-400 bg-slate-800/60 hover:bg-slate-800' }}">
                                        <i class="fa-solid fa-star"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                <div class="inline-flex items-center gap-1.5">
                                    @if($item->canva_url)
                                        <a href="{{ $item->canva_url }}" target="_blank" title="Lihat Canva" class="p-1.5 rounded-lg bg-sky-500/10 text-sky-400 hover:bg-sky-500/20 border border-sky-500/20">
                                            <i class="fa-solid fa-palette text-xs"></i>
                                        </a>
                                    @endif
                                    @if($item->demo_url)
                                        <a href="{{ $item->demo_url }}" target="_blank" title="Lihat Demo" class="p-1.5 rounded-lg bg-teal-500/10 text-teal-400 hover:bg-teal-500/20 border border-teal-500/20">
                                            <i class="fa-solid fa-globe text-xs"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-1.5">
                                    <!-- Public Detail Page Link -->
                                    <a href="{{ route('karya.show', $item) }}" target="_blank" title="Lihat Halaman Detail Publik"
                                        class="p-2 rounded-xl text-slate-400 hover:text-cyan-400 hover:bg-cyan-500/10 border border-slate-800 hover:border-cyan-500/30 transition-all">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>

                                    <a href="{{ route('admin.karya.edit', $item) }}" title="Edit Karya"
                                        class="p-2 rounded-xl text-slate-400 hover:text-amber-400 hover:bg-amber-500/10 border border-slate-800 hover:border-amber-500/30 transition-all">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </a>

                                    <form action="{{ route('admin.karya.destroy', $item) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data karya \'{{ addslashes($item->title) }}\'? Data yang dihapus tidak dapat dikembalikan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus Karya"
                                            class="p-2 rounded-xl text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 border border-slate-800 hover:border-rose-500/30 transition-all">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-12 text-center text-slate-500">
                                <i class="fa-regular fa-folder-open text-3xl mb-2 block"></i>
                                <span>Belum ada data karya siswa untuk jurusan / filter ini.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($apps->hasPages())
            <div class="p-4 border-t border-slate-800 bg-slate-950/40">
                {{ $apps->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
