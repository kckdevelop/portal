@extends('layouts.admin')

@section('title', 'Moderasi Buku Tamu')
@section('header_title', 'Moderasi Buku Tamu Pameran')
@section('header_subtitle', 'Pantau kesan & pesan pengunjung, moderasi tampilan ulasan, dan unduh rekap data')

@section('content')
<div class="space-y-6">

    <!-- Metric Badges Row -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="p-4 rounded-xl bg-slate-900 border border-slate-800">
            <span class="text-[11px] text-slate-400 font-semibold uppercase">Total Entri</span>
            <p class="text-2xl font-extrabold text-white mt-1">{{ $stats['total'] }}</p>
        </div>
        <div class="p-4 rounded-xl bg-slate-900 border border-slate-800">
            <span class="text-[11px] text-emerald-400 font-semibold uppercase">Disetujui Tampil</span>
            <p class="text-2xl font-extrabold text-emerald-400 mt-1">{{ $stats['approved'] }}</p>
        </div>
        <div class="p-4 rounded-xl bg-slate-900 border border-slate-800">
            <span class="text-[11px] text-amber-400 font-semibold uppercase">Disembunyikan</span>
            <p class="text-2xl font-extrabold text-amber-400 mt-1">{{ $stats['hidden'] }}</p>
        </div>
        <div class="p-4 rounded-xl bg-slate-900 border border-slate-800">
            <span class="text-[11px] text-sky-400 font-semibold uppercase">Rating Rata-rata</span>
            <p class="text-2xl font-extrabold text-sky-400 mt-1 flex items-baseline gap-1">
                {{ $stats['avg_rating'] }} <span class="text-xs text-slate-500">/ 5.0</span>
            </p>
        </div>
    </div>

    <!-- Search, Filter & Export Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-5 rounded-2xl bg-slate-900 border border-slate-800 shadow-md">
        
        <!-- Filter Form -->
        <form action="{{ route('admin.guestbook.index') }}" method="GET" class="flex flex-wrap items-center gap-3 flex-1">
            
            <!-- Search -->
            <div class="relative flex-1 min-w-[200px]">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                </div>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama, instansi, atau isi pesan..."
                    class="w-full pl-9 pr-3 py-2 bg-slate-950 border border-slate-700 rounded-xl text-white placeholder-slate-500 text-xs focus:outline-none focus:ring-2 focus:ring-cyan-500">
            </div>

            <!-- Status Filter -->
            <select name="status" onchange="this.form.submit()"
                class="px-3 py-2 bg-slate-950 border border-slate-700 rounded-xl text-white text-xs focus:outline-none focus:ring-2 focus:ring-cyan-500">
                <option value="">Semua Status</option>
                <option value="1" {{ $status === '1' ? 'selected' : '' }}>Tampil di Web</option>
                <option value="0" {{ $status === '0' ? 'selected' : '' }}>Disembunyikan</option>
            </select>

            <!-- Rating Filter -->
            <select name="rating" onchange="this.form.submit()"
                class="px-3 py-2 bg-slate-950 border border-slate-700 rounded-xl text-white text-xs focus:outline-none focus:ring-2 focus:ring-cyan-500">
                <option value="">Semua Bintang</option>
                <option value="5" {{ $rating === '5' ? 'selected' : '' }}>5 Bintang ⭐⭐⭐⭐⭐</option>
                <option value="4" {{ $rating === '4' ? 'selected' : '' }}>4 Bintang ⭐⭐⭐⭐</option>
                <option value="3" {{ $rating === '3' ? 'selected' : '' }}>3 Bintang ⭐⭐⭐</option>
            </select>

            @if($search || $status !== null && $status !== '' || $rating)
                <a href="{{ route('admin.guestbook.index') }}" class="px-3 py-2 text-xs text-slate-400 hover:text-white bg-slate-800 rounded-xl border border-slate-700 transition-colors">
                    Reset Filter
                </a>
            @endif
        </form>

        <!-- Export CSV Button -->
        <div class="flex-shrink-0">
            <a href="{{ route('admin.guestbook.export') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-semibold text-emerald-300 bg-emerald-500/10 hover:bg-emerald-500/20 border border-emerald-500/30 transition-all">
                <i class="fa-solid fa-file-excel text-sm"></i>
                <span>Unduh Rekap CSV</span>
            </a>
        </div>
    </div>

    <!-- Guestbook Table Card -->
    <div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="border-b border-slate-800 bg-slate-950/60 text-slate-400 uppercase tracking-wider font-semibold">
                        <th class="py-3.5 px-4 w-12 text-center">#</th>
                        <th class="py-3.5 px-4 w-16 text-center">Selfie</th>
                        <th class="py-3.5 px-4">Nama Pengunjung & Instansi</th>
                        <th class="py-3.5 px-4 w-28">Rating</th>
                        <th class="py-3.5 px-4">Pesan & Kesan Pengunjung</th>
                        <th class="py-3.5 px-4 whitespace-nowrap">Waktu</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                        <th class="py-3.5 px-4 text-right w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/70 text-slate-300">
                    @forelse($guestbooks as $index => $item)
                        <tr class="hover:bg-slate-800/40 transition-colors">
                            <td class="py-3.5 px-4 text-center font-mono text-slate-500">
                                {{ $guestbooks->firstItem() + $index }}
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                @if($item->selfie_url)
                                    <button type="button" onclick="openSelfieModal('{{ $item->selfie_url }}', '{{ addslashes($item->name) }}')"
                                        class="group relative inline-block rounded-xl overflow-hidden border border-slate-700 hover:border-cyan-400 focus:outline-none transition-colors">
                                        <img src="{{ $item->selfie_url }}" alt="Selfie {{ $item->name }}" class="w-12 h-12 object-cover group-hover:scale-105 transition-transform bg-slate-950">
                                        <div class="absolute inset-0 bg-slate-950/30 group-hover:bg-transparent transition-colors flex items-center justify-center">
                                            <i class="fa-solid fa-magnifying-glass text-[10px] text-white opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                        </div>
                                    </button>
                                @else
                                    <div class="w-10 h-10 mx-auto rounded-xl bg-slate-800 text-slate-500 flex items-center justify-center border border-slate-700">
                                        <i class="fa-solid fa-user text-xs"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 max-w-[200px]">
                                <h3 class="font-bold text-white text-sm truncate">{{ $item->name }}</h3>
                                <p class="text-cyan-400 text-xs font-medium truncate mt-0.5">
                                    <i class="fa-solid fa-building text-[10px] mr-1"></i>{{ $item->institution }}
                                </p>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <div class="flex items-center text-amber-400 text-xs">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa-solid fa-star {{ $i <= $item->rating ? 'text-amber-400' : 'text-slate-700' }}"></i>
                                    @endfor
                                </div>
                                <span class="text-[10px] text-slate-500">{{ $item->rating }} dari 5</span>
                            </td>
                            <td class="py-3.5 px-4 max-w-[300px]">
                                <p class="text-slate-300 text-xs line-clamp-3 leading-relaxed">
                                    "{{ $item->message }}"
                                </p>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap text-slate-400 text-[11px]">
                                <span>{{ $item->created_at->format('d/m/Y H:i') }}</span>
                                <span class="block text-[10px] text-slate-500">{{ $item->created_at->diffForHumans() }}</span>
                            </td>
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                <form action="{{ route('admin.guestbook.toggle-approval', $item) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" title="{{ $item->is_approved ? 'Klik untuk sembunyikan dari web' : 'Klik untuk tampilkan di web' }}"
                                        class="px-2.5 py-1 rounded-full text-[11px] font-semibold border transition-all {{ $item->is_approved ? 'bg-emerald-950 text-emerald-300 border-emerald-800/80 hover:bg-emerald-900' : 'bg-slate-800 text-slate-400 border-slate-700 hover:bg-slate-700' }}">
                                        <i class="fa-solid {{ $item->is_approved ? 'fa-eye' : 'fa-eye-slash' }} mr-1"></i>
                                        {{ $item->is_approved ? 'Tampil' : 'Sembunyi' }}
                                    </button>
                                </form>
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                <form action="{{ route('admin.guestbook.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan dari \'{{ addslashes($item->name) }}\'?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 transition-colors" title="Hapus Ulasan">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-12 text-slate-500">
                                <i class="fa-solid fa-comment-slash text-3xl mb-2 text-slate-600 block"></i>
                                Belum ada data buku tamu yang sesuai filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        @if($guestbooks->hasPages())
            <div class="p-4 border-t border-slate-800 bg-slate-950/40">
                {{ $guestbooks->links() }}
            </div>
        @endif
    </div>

</div>

<!-- Selfie Preview Modal -->
<div id="selfieModal" class="fixed inset-0 z-50 bg-slate-950/90 backdrop-blur-md hidden flex items-center justify-center p-4">
    <div class="relative bg-slate-900 border border-slate-700 rounded-2xl max-w-lg w-full overflow-hidden shadow-2xl p-4">
        <div class="flex items-center justify-between pb-3 border-b border-slate-800">
            <h4 id="selfieModalTitle" class="text-sm font-bold text-white truncate">Foto Selfie Pengunjung</h4>
            <button onclick="closeSelfieModal()" class="text-slate-400 hover:text-white p-1">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>
        <div class="mt-3 aspect-square sm:aspect-auto max-h-[70vh] flex items-center justify-center rounded-xl overflow-hidden bg-slate-950">
            <img id="selfieModalImg" src="" alt="Selfie" class="max-h-[65vh] w-auto object-contain rounded-lg">
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openSelfieModal(url, name) {
        document.getElementById('selfieModalImg').src = url;
        document.getElementById('selfieModalTitle').textContent = 'Foto Selfie: ' + name;
        document.getElementById('selfieModal').classList.remove('hidden');
    }

    function closeSelfieModal() {
        document.getElementById('selfieModal').classList.add('hidden');
        document.getElementById('selfieModalImg').src = '';
    }

    document.getElementById('selfieModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeSelfieModal();
        }
    });
</script>
@endpush
@endsection
