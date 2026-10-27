<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - {{ \App\Models\Setting::get('school_name', 'SMK Muhammadiyah 1 Bantul') }}</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            navy: '#0A192F',
                            deep: '#0F172A',
                            surface: '#1E293B',
                            teal: '#0D9488',
                            cyan: '#06B6D4',
                            sky: '#0EA5E9',
                            accent: '#14B8A6'
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #0f172a;
        }
        ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #06b6d4;
        }
    </style>
    @stack('styles')
</head>
<body class="h-full text-slate-100 flex flex-col md:flex-row antialiased bg-slate-950">

    <!-- Mobile Top Navigation Header -->
    <header class="md:hidden flex items-center justify-between px-4 py-3 bg-slate-900 border-b border-slate-800 z-40">
        <div class="flex items-center gap-3">
            @php $currentLogo = \App\Models\Setting::logoUrl(); @endphp
            @if($currentLogo)
                <img src="{{ $currentLogo }}" alt="Logo" class="w-9 h-9 object-contain rounded-lg bg-slate-800 p-1 border border-slate-700">
            @else
                <div class="w-9 h-9 rounded-lg bg-gradient-to-tr from-cyan-500 to-teal-400 flex items-center justify-center text-slate-950 font-bold shadow-md shadow-cyan-500/20">
                    <i class="fa-solid fa-graduation-cap text-base"></i>
                </div>
            @endif
            <div class="leading-tight">
                <span class="block text-xs font-semibold text-cyan-400">Panel Admin</span>
                <span class="block text-sm font-bold text-white truncate max-w-[180px]">{{ \App\Models\Setting::get('school_name', 'SMK Muh 1 Bantul') }}</span>
            </div>
        </div>

        <button id="sidebarToggle" type="button" aria-label="Toggle Menu" class="p-2 text-slate-400 hover:text-white rounded-lg focus:outline-none focus:bg-slate-800">
            <i class="fa-solid fa-bars text-xl"></i>
        </button>
    </header>

    <!-- Sidebar Overlay for Mobile -->
    <div id="sidebarBackdrop" class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm z-40 hidden md:hidden"></div>

    <!-- Admin Sidebar Navigation -->
    <aside id="adminSidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 border-r border-slate-800 flex flex-col transition-transform duration-300 transform -translate-x-full md:translate-x-0 md:static md:inset-auto">
        
        <!-- Brand & School Info -->
        <div class="px-5 py-5 border-b border-slate-800 flex items-center justify-between">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                @if($currentLogo)
                    <img src="{{ $currentLogo }}" alt="Logo" class="w-10 h-10 object-contain rounded-xl bg-slate-800/80 p-1.5 border border-slate-700 shadow-md">
                @else
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-cyan-500 to-teal-400 flex items-center justify-center text-slate-950 font-extrabold shadow-lg shadow-cyan-500/20">
                        <i class="fa-solid fa-graduation-cap text-lg"></i>
                    </div>
                @endif
                <div class="leading-tight">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-cyan-400">Admin Portal</span>
                    <h1 class="text-sm font-bold text-white tracking-tight truncate max-w-[140px]" title="{{ \App\Models\Setting::get('school_name', 'SMK Muh 1 Bantul') }}">
                        {{ \App\Models\Setting::get('school_name', 'SMK Muh 1 Bantul') }}
                    </h1>
                </div>
            </a>
            <button id="sidebarClose" class="md:hidden text-slate-400 hover:text-white p-1">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
            <div class="px-3 pb-2 text-[11px] font-semibold tracking-wider text-slate-400 uppercase">
                Menu Utama
            </div>

            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') || request()->routeIs('admin.index') ? 'bg-cyan-500/15 text-cyan-300 font-semibold border-l-4 border-cyan-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-gauge-high text-base {{ request()->routeIs('admin.dashboard') ? 'text-cyan-400' : 'text-slate-400' }}"></i>
                <span>Dashboard</span>
            </a>

            <!-- Atur Logo & Identitas Website -->
            <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-cyan-500/15 text-cyan-300 font-semibold border-l-4 border-cyan-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-sliders text-base {{ request()->routeIs('admin.settings.*') ? 'text-cyan-400' : 'text-slate-400' }}"></i>
                <span>Atur Logo & Website</span>
            </a>

            <!-- Kelola Karya Siswa -->
            <a href="{{ route('admin.karya.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.karya.*') ? 'bg-cyan-500/15 text-cyan-300 font-semibold border-l-4 border-cyan-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-laptop-code text-base {{ request()->routeIs('admin.karya.*') ? 'text-cyan-400' : 'text-slate-400' }}"></i>
                <div class="flex-1 flex items-center justify-between">
                    <span>Karya Siswa</span>
                    <span class="text-xs bg-slate-800 text-slate-300 px-2 py-0.5 rounded-full border border-slate-700">
                        {{ \App\Models\AppGallery::count() }}
                    </span>
                </div>
            </a>

            <!-- Moderasi Buku Tamu -->
            <a href="{{ route('admin.guestbook.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.guestbook.*') ? 'bg-cyan-500/15 text-cyan-300 font-semibold border-l-4 border-cyan-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-book-bookmark text-base {{ request()->routeIs('admin.guestbook.*') ? 'text-cyan-400' : 'text-slate-400' }}"></i>
                <div class="flex-1 flex items-center justify-between">
                    <span>Buku Tamu</span>
                    <span class="text-xs bg-cyan-950 text-cyan-400 px-2 py-0.5 rounded-full border border-cyan-800">
                        {{ \App\Models\Guestbook::count() }}
                    </span>
                </div>
            </a>

            <div class="pt-5 px-3 pb-2 text-[11px] font-semibold tracking-wider text-slate-400 uppercase">
                Akses Publik
            </div>

            <!-- Lihat Website Publik -->
            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-3.5 py-2 rounded-xl text-xs font-medium text-slate-400 hover:bg-slate-800/80 hover:text-cyan-300 transition-colors">
                <i class="fa-solid fa-arrow-up-right-from-square text-xs text-slate-400"></i>
                <span>Lihat Web Pameran</span>
            </a>
            <a href="{{ route('guestbook.index') }}" target="_blank" class="flex items-center gap-3 px-3.5 py-2 rounded-xl text-xs font-medium text-slate-400 hover:bg-slate-800/80 hover:text-cyan-300 transition-colors">
                <i class="fa-solid fa-camera-retro text-xs text-slate-400"></i>
                <span>Buku Tamu Publik</span>
            </a>
        </nav>

        <!-- User Profile & Logout -->
        <div class="p-3 border-t border-slate-800 bg-slate-900/60">
            <div class="flex items-center justify-between gap-3 p-2 rounded-xl bg-slate-800/70 border border-slate-700/60">
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-8 h-8 rounded-lg bg-cyan-500/20 text-cyan-300 font-bold flex items-center justify-center text-xs border border-cyan-500/30">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-semibold text-white truncate">{{ auth()->user()->name ?? 'Administrator' }}</p>
                        <p class="text-[10px] text-slate-400 truncate">{{ auth()->user()->email ?? 'admin@musaba.sch.id' }}</p>
                    </div>
                </div>

                <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" title="Keluar / Logout" class="p-1.5 text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 rounded-lg transition-colors">
                        <i class="fa-solid fa-arrow-right-from-bracket text-sm"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
        
        <!-- Desktop Topbar -->
        <div class="hidden md:flex items-center justify-between px-8 py-4 bg-slate-900/50 backdrop-blur-md border-b border-slate-800/80 sticky top-0 z-30">
            <div>
                <h2 class="text-lg font-bold text-white flex items-center gap-2">
                    @yield('header_title', 'Dashboard')
                </h2>
                <p class="text-xs text-slate-400">
                    @yield('header_subtitle', 'Sistem Manajemen Portal Pameran Aplikasi Siswa')
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-lg text-xs font-medium text-slate-300 bg-slate-800 hover:bg-slate-700 hover:text-white transition-colors border border-slate-700">
                    <i class="fa-solid fa-globe text-cyan-400"></i>
                    <span>Buka Portal Publik</span>
                </a>

                <div class="h-4 w-px bg-slate-700"></div>

                <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium text-rose-300 bg-rose-500/10 hover:bg-rose-500/20 transition-colors border border-rose-500/20">
                        <i class="fa-solid fa-power-off text-xs"></i>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Body Wrapper -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8">
            
            <!-- Flash Message Alerts -->
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 flex items-start gap-3 shadow-sm animate-fade-in">
                    <i class="fa-solid fa-circle-check text-emerald-400 text-lg mt-0.5"></i>
                    <div class="flex-1 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-300 flex items-start gap-3 shadow-sm animate-fade-in">
                    <i class="fa-solid fa-triangle-exclamation text-rose-400 text-lg mt-0.5"></i>
                    <div class="flex-1 text-sm font-medium">
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-amber-500/10 border border-amber-500/30 text-amber-300 flex items-start gap-3 shadow-sm animate-fade-in">
                    <i class="fa-solid fa-circle-exclamation text-amber-400 text-lg mt-0.5"></i>
                    <div class="flex-1 text-sm">
                        <p class="font-semibold mb-1">Terdapat beberapa kesalahan pengisian form:</p>
                        <ul class="list-disc list-inside space-y-0.5 text-xs text-amber-200">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Admin Footer -->
        <footer class="px-6 py-4 border-t border-slate-800 text-xs text-slate-400 flex flex-col sm:flex-row items-center justify-between gap-2">
            <span>&copy; {{ date('Y') }} {{ \App\Models\Setting::get('school_name', 'SMK Muhammadiyah 1 Bantul') }}. Seluruh hak cipta dilindungi.</span>
            <span>Versi Portal Expo 1.0 &bull; TKR, TPM, TSM, TAV & PPLG</span>
        </footer>
    </div>

    <!-- Mobile Sidebar JavaScript Toggle -->
    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarClose = document.getElementById('sidebarClose');
        const adminSidebar = document.getElementById('adminSidebar');
        const sidebarBackdrop = document.getElementById('sidebarBackdrop');

        function openSidebar() {
            adminSidebar.classList.remove('-translate-x-full');
            sidebarBackdrop.classList.remove('hidden');
        }

        function closeSidebar() {
            adminSidebar.classList.add('-translate-x-full');
            sidebarBackdrop.classList.add('hidden');
        }

        if (sidebarToggle) sidebarToggle.addEventListener('click', openSidebar);
        if (sidebarClose) sidebarClose.addEventListener('click', closeSidebar);
        if (sidebarBackdrop) sidebarBackdrop.addEventListener('click', closeSidebar);
    </script>

    @stack('scripts')
</body>
</html>
