@extends('layouts.admin')

@section('title', 'Atur Logo & Website')
@section('header_title', 'Pengaturan Logo & Identitas Portal')
@section('header_subtitle', 'Kelola logo resmi sekolah dan informasi branding yang ditampilkan di portal')

@section('content')
<div class="max-w-5xl mx-auto space-y-8">

    <!-- Live Preview Banner -->
    <div class="p-5 rounded-2xl bg-slate-900 border border-slate-800 shadow-lg">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-bold uppercase tracking-wider text-cyan-400 flex items-center gap-1.5">
                <i class="fa-solid fa-eye"></i> Pratinjau Tampilan Navbar Publik
            </span>
            <span class="text-[11px] text-slate-400">Tampilan live di header website</span>
        </div>

        <div class="p-4 rounded-xl bg-slate-950/90 border border-cyan-900/40 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div id="previewLogoContainer" class="w-12 h-12 rounded-xl bg-slate-900 p-1.5 border border-slate-700 flex items-center justify-center overflow-hidden">
                    @if($settings['logo_url'])
                        <img id="navbarLogoPreview" src="{{ $settings['logo_url'] }}" alt="Logo" class="w-full h-full object-contain">
                    @else
                        <div id="navbarLogoIcon" class="w-full h-full rounded-lg bg-gradient-to-tr from-cyan-500 to-teal-400 flex items-center justify-center text-slate-950 font-extrabold">
                            <i class="fa-solid fa-graduation-cap text-xl"></i>
                        </div>
                    @endif
                </div>
                <div>
                    <span id="previewSchoolName" class="block text-xs font-semibold uppercase tracking-wider text-cyan-400">
                        {{ $settings['school_name'] }}
                    </span>
                    <span id="previewPortalTitle" class="block text-base font-bold text-white tracking-tight">
                        {{ $settings['portal_title'] }}
                        <span id="previewEventName" class="text-xs bg-cyan-950 text-cyan-300 px-2 py-0.5 rounded-full border border-cyan-700/50 ml-1">
                            {{ $settings['event_name'] }}
                        </span>
                    </span>
                </div>
            </div>

            <div class="hidden sm:flex items-center gap-2">
                <span class="text-xs bg-slate-800 text-slate-400 px-3 py-1.5 rounded-lg border border-slate-700">
                    <i class="fa-solid fa-globe mr-1 text-cyan-400"></i> Publik
                </span>
            </div>
        </div>
    </div>

    <!-- Main Settings Form -->
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Left: Logo Management Card -->
            <div class="p-6 rounded-2xl bg-slate-900/90 border border-slate-800 shadow-md space-y-5 lg:col-span-1">
                <div class="border-b border-slate-800 pb-3">
                    <h3 class="text-sm font-bold text-white flex items-center gap-2">
                        <i class="fa-solid fa-image text-cyan-400"></i> Logo Sekolah / Portal
                    </h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Unggah logo resmi sekolah Anda</p>
                </div>

                <!-- Logo Display Box -->
                <div class="flex flex-col items-center justify-center p-6 bg-slate-950 rounded-2xl border border-dashed border-slate-700 hover:border-cyan-500/50 transition-colors">
                    <div id="logoPreviewBox" class="w-28 h-28 rounded-2xl bg-slate-900 p-2 border border-slate-700 flex items-center justify-center shadow-lg mb-3 overflow-hidden">
                        @if($settings['logo_url'])
                            <img id="formLogoPreview" src="{{ $settings['logo_url'] }}" alt="Logo Saat Ini" class="w-full h-full object-contain">
                        @else
                            <div id="formLogoFallback" class="w-full h-full rounded-xl bg-gradient-to-tr from-cyan-500 to-teal-400 flex items-center justify-center text-slate-950 font-extrabold text-3xl shadow-md">
                                <i class="fa-solid fa-graduation-cap"></i>
                            </div>
                        @endif
                    </div>

                    <span class="text-xs font-semibold text-slate-300">
                        {{ $settings['logo_url'] ? 'Logo Kustom Aktif' : 'Ikon Bawaan (Default)' }}
                    </span>
                    <span class="text-[10px] text-slate-500 mt-1 text-center">Format: PNG transparan, JPG, SVG, WebP (Maks. 3MB)</span>
                </div>

                <!-- File Input for New Logo -->
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">Pilih File Logo Baru</label>
                    <input type="file" id="logoFileInput" name="logo_file" accept="image/png,image/jpeg,image/svg+xml,image/webp"
                        class="block w-full text-xs text-slate-400 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-cyan-500/10 file:text-cyan-300 hover:file:bg-cyan-500/20 file:cursor-pointer cursor-pointer bg-slate-950 rounded-xl border border-slate-700 focus:outline-none">
                </div>

                <!-- Delete Custom Logo Button if exists -->
                @if($settings['logo_url'])
                    <div class="pt-3 border-t border-slate-800">
                        <button type="button" onclick="confirmDeleteLogo()" class="w-full py-2 px-3 rounded-xl text-xs font-semibold text-rose-400 bg-rose-500/10 hover:bg-rose-500/20 border border-rose-500/20 flex items-center justify-center gap-2 transition-colors">
                            <i class="fa-solid fa-trash-can"></i>
                            <span>Hapus Logo Kustom & Gunakan Default</span>
                        </button>
                    </div>
                @endif
            </div>

            <!-- Right: Identity Settings Card -->
            <div class="p-6 rounded-2xl bg-slate-900/90 border border-slate-800 shadow-md space-y-5 lg:col-span-2">
                <div class="border-b border-slate-800 pb-3">
                    <h3 class="text-sm font-bold text-white flex items-center gap-2">
                        <i class="fa-solid fa-building-columns text-cyan-400"></i> Informasi Identitas Portal
                    </h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Teks branding yang muncul di header, tab browser, dan footer</p>
                </div>

                <!-- Nama Sekolah -->
                <div>
                    <label for="school_name" class="block text-xs font-semibold text-slate-300 mb-1.5">
                        Nama Sekolah / Lembaga <span class="text-rose-400">*</span>
                    </label>
                    <input type="text" id="school_name" name="school_name" required
                        value="{{ old('school_name', $settings['school_name']) }}"
                        placeholder="Contoh: SMK Muhammadiyah 1 Bantul"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all">
                </div>

                <!-- Judul Portal -->
                <div>
                    <label for="portal_title" class="block text-xs font-semibold text-slate-300 mb-1.5">
                        Judul Portal Website <span class="text-rose-400">*</span>
                    </label>
                    <input type="text" id="portal_title" name="portal_title" required
                        value="{{ old('portal_title', $settings['portal_title']) }}"
                        placeholder="Contoh: Portal Karya Siswa"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all">
                </div>

                <!-- Nama Acara / Event -->
                <div>
                    <label for="event_name" class="block text-xs font-semibold text-slate-300 mb-1.5">
                        Nama Acara / Badge Expo
                    </label>
                    <input type="text" id="event_name" name="event_name"
                        value="{{ old('event_name', $settings['event_name']) }}"
                        placeholder="Contoh: Musaba Expo 2026"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all">
                </div>

                <!-- Header Subtitle / Tagline -->
                <div>
                    <label for="header_subtitle" class="block text-xs font-semibold text-slate-300 mb-1.5">
                        Tagline / Sub-judul Pameran
                    </label>
                    <input type="text" id="header_subtitle" name="header_subtitle"
                        value="{{ old('header_subtitle', $settings['header_subtitle']) }}"
                        placeholder="Contoh: Pameran Inovasi Aplikasi & Karya Siswa Rekayasa Perangkat Lunak"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all">
                </div>

                <!-- Submit Button -->
                <div class="pt-4 border-t border-slate-800 flex items-center justify-end gap-3">
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold text-slate-950 bg-gradient-to-r from-cyan-400 to-teal-400 hover:from-cyan-300 hover:to-teal-300 shadow-md shadow-cyan-500/20 active:scale-95 transition-all">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </div>

        </div>
    </form>

    <!-- Hidden Form for Deleting Logo -->
    <form id="deleteLogoForm" action="{{ route('admin.settings.delete-logo') }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

</div>

@push('scripts')
<script>
    // Live input listeners for preview banner
    const schoolInput = document.getElementById('school_name');
    const portalInput = document.getElementById('portal_title');
    const eventInput = document.getElementById('event_name');

    const previewSchool = document.getElementById('previewSchoolName');
    const previewPortal = document.getElementById('previewPortalTitle');
    const previewEvent = document.getElementById('previewEventName');

    if (schoolInput) {
        schoolInput.addEventListener('input', (e) => {
            previewSchool.textContent = e.target.value || 'SMK Muhammadiyah 1 Bantul';
        });
    }

    if (portalInput) {
        portalInput.addEventListener('input', (e) => {
            previewPortal.childNodes[0].nodeValue = (e.target.value || 'Portal Karya Siswa') + ' ';
        });
    }

    if (eventInput) {
        eventInput.addEventListener('input', (e) => {
            previewEvent.textContent = e.target.value;
            previewEvent.style.display = e.target.value.trim() ? 'inline-block' : 'none';
        });
    }

    // Live preview for Logo file selection
    const logoInput = document.getElementById('logoFileInput');
    const formLogoBox = document.getElementById('logoPreviewBox');
    const previewLogoContainer = document.getElementById('previewLogoContainer');

    if (logoInput) {
        logoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    const imgUrl = evt.target.result;
                    // Update form preview box
                    formLogoBox.innerHTML = `<img src="${imgUrl}" alt="Preview" class="w-full h-full object-contain">`;
                    // Update navbar preview banner
                    previewLogoContainer.innerHTML = `<img src="${imgUrl}" alt="Preview" class="w-full h-full object-contain">`;
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Confirmation for deleting custom logo
    function confirmDeleteLogo() {
        if (confirm('Apakah Anda yakin ingin menghapus logo kustom dan kembali menggunakan ikon default?')) {
            document.getElementById('deleteLogoForm').submit();
        }
    }
</script>
@endpush
@endsection
