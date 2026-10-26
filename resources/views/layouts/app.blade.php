<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Portal Pameran Aplikasi Karya Siswa') - SMK Muhammadiyah 1 Bantul</title>
    <meta name="description" content="Portal Pameran Aplikasi dan Inovasi Teknologi Karya Siswa SMK Muhammadiyah 1 Bantul (Musaba) - Rekayasa Perangkat Lunak & PPLG.">
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Tailwind CSS CDN Fallback & Config -->
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
                            light: '#F8FAFC',
                            muted: '#94A3B8',
                            accent: '#14B8A6'
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 3s ease-in-out infinite',
                        'pulse-subtle': 'pulse 2.5s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-6px)' },
                        }
                    }
                }
            }
        }
    </script>

    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F8FAFC;
            color: #0F172A;
        }

        .glass-nav {
            background: rgba(10, 25, 47, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
        }

        .gradient-brand {
            background: linear-gradient(135deg, #0A192F 0%, #0F172A 50%, #0D9488 100%);
        }

        .gradient-teal {
            background: linear-gradient(135deg, #06B6D4 0%, #0D9488 100%);
        }

        .text-gradient {
            background: linear-gradient(135deg, #38BDF8 0%, #2DD4BF 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .badge-pulse {
            box-shadow: 0 0 0 0 rgba(6, 182, 212, 0.5);
            animation: pulse-ring 2s infinite;
        }

        @keyframes pulse-ring {
            0% { box-shadow: 0 0 0 0 rgba(6, 182, 212, 0.6); }
            70% { box-shadow: 0 0 0 10px rgba(6, 182, 212, 0); }
            100% { box-shadow: 0 0 0 0 rgba(6, 182, 212, 0); }
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col bg-slate-50 antialiased selection:bg-cyan-500 selection:text-white">

    <!-- Header & Navigation -->
    <header class="fixed top-0 left-0 right-0 z-50 glass-nav border-b border-cyan-900/40 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">
                
                <!-- School & Portal Brand -->
                @php
                    $siteLogo = \App\Models\Setting::logoUrl();
                    $schoolName = \App\Models\Setting::get('school_name', 'SMK Muhammadiyah 1 Bantul');
                    $portalTitle = \App\Models\Setting::get('portal_title', 'Portal Karya Siswa');
                    $eventName = \App\Models\Setting::get('event_name', 'Musaba Expo');
                @endphp
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    @if($siteLogo)
                        <img src="{{ $siteLogo }}" alt="{{ $schoolName }}" class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-slate-900/90 p-1.5 border border-cyan-800/60 shadow-lg shadow-cyan-500/20 object-contain group-hover:scale-105 transition-transform">
                    @else
                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-gradient-to-tr from-cyan-500 to-teal-400 flex items-center justify-center text-slate-950 font-extrabold shadow-lg shadow-cyan-500/20 group-hover:scale-105 transition-transform">
                            <i class="fa-solid fa-graduation-cap text-lg sm:text-xl text-slate-900"></i>
                        </div>
                    @endif
                    <div class="flex flex-col">
                        <span class="text-xs font-semibold uppercase tracking-wider text-cyan-400">{{ $schoolName }}</span>
                        <span class="text-base sm:text-lg font-bold text-white tracking-tight group-hover:text-cyan-200 transition-colors">
                            {{ $portalTitle }} 
                            @if($eventName)
                                <span class="hidden sm:inline-block text-xs bg-cyan-950/80 text-cyan-300 px-2 py-0.5 rounded-full border border-cyan-700/50 ml-1">{{ $eventName }}</span>
                            @endif
                        </span>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden md:flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-sm font-medium {{ request()->routeIs('home') ? 'text-cyan-400 border-b-2 border-cyan-400 pb-1' : 'text-slate-300 hover:text-white transition-colors' }}">
                        <i class="fa-solid fa-cubes mr-1.5 text-xs"></i> Katalog Karya
                    </a>
                    <a href="{{ route('home') }}#tentang-pameran" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">
                        <i class="fa-solid fa-circle-info mr-1.5 text-xs"></i> Tentang Expo
                    </a>
                    <a href="{{ route('guestbook.index') }}" class="text-sm font-medium {{ request()->routeIs('guestbook.*') ? 'text-cyan-400 border-b-2 border-cyan-400 pb-1' : 'text-slate-300 hover:text-white transition-colors' }}">
                        <i class="fa-solid fa-book-bookmark mr-1.5 text-xs"></i> Buku Tamu
                    </a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="text-xs font-bold text-cyan-300 bg-cyan-950/90 border border-cyan-700/60 px-3 py-1.5 rounded-lg hover:bg-cyan-900 transition-colors">
                            <i class="fa-solid fa-gauge-high mr-1 text-cyan-400"></i> Panel Admin
                        </a>
                    @endauth
                </nav>

                <!-- Header CTA Button -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <a href="{{ route('guestbook.index') }}" class="inline-flex items-center gap-2 px-3.5 py-2 sm:px-5 sm:py-2.5 rounded-xl text-xs sm:text-sm font-bold text-slate-950 bg-gradient-to-r from-cyan-400 via-teal-300 to-emerald-400 hover:from-cyan-300 hover:to-teal-200 shadow-md shadow-cyan-500/25 hover:shadow-cyan-400/40 hover:-translate-y-0.5 transition-all active:scale-95">
                        <i class="fa-solid fa-camera-retro text-sm"></i>
                        <span>Isi Buku Tamu</span>
                    </a>

                    <!-- Mobile Menu Hamburger Button -->
                    <button id="mobileMenuBtn" type="button" aria-label="Buka Menu" class="md:hidden p-2 text-slate-300 hover:text-white rounded-lg focus:outline-none">
                        <i class="fa-solid fa-bars text-xl" id="menuIcon"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Navigation -->
        <div id="mobileMenu" class="hidden md:hidden bg-slate-950/95 border-b border-cyan-900/50 px-4 pt-3 pb-5 space-y-2">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('home') ? 'bg-cyan-950 text-cyan-300 font-bold' : 'text-slate-300 hover:bg-slate-900' }}">
                <i class="fa-solid fa-cubes mr-2 text-cyan-400"></i> Katalog Aplikasi
            </a>
            <a href="{{ route('home') }}#tentang-pameran" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-300 hover:bg-slate-900">
                <i class="fa-solid fa-circle-info mr-2 text-cyan-400"></i> Tentang Pameran
            </a>
            <a href="{{ route('guestbook.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('guestbook.*') ? 'bg-cyan-950 text-cyan-300 font-bold' : 'text-slate-300 hover:bg-slate-900' }}">
                <i class="fa-solid fa-book-bookmark mr-2 text-cyan-400"></i> Buku Tamu & Selfie
            </a>
            <a href="{{ route('admin.login') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-cyan-300 hover:bg-slate-900">
                <i class="fa-solid fa-lock mr-2 text-cyan-400"></i> Login Administrator
            </a>
        </div>
    </header>

    <!-- Main Content Body -->
    <main class="flex-grow pt-16 sm:pt-20">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 flex items-start gap-3 shadow-sm">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-xl mt-0.5"></i>
                    <div class="flex-1 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-900 flex items-start gap-3 shadow-sm">
                    <i class="fa-solid fa-triangle-exclamation text-rose-600 text-xl mt-0.5"></i>
                    <div class="flex-1 text-sm font-medium">
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-950 text-slate-400 border-t border-slate-800 mt-20 pt-14 pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-10">
                
                <!-- Col 1: About School -->
                <div class="md:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-cyan-500/20 border border-cyan-500/30 flex items-center justify-center text-cyan-400">
                            <i class="fa-solid fa-school text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-bold text-base sm:text-lg">SMK Muhammadiyah 1 Bantul</h3>
                            <p class="text-xs text-cyan-400 font-medium">Musaba Center of Excellence & Vokasi Juara</p>
                        </div>
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed max-w-md">
                        Portal resmi etalase karya inovasi teknologi digital siswa Jurusan Rekayasa Perangkat Lunak (RPL / PPLG) & Sistem Informasi Jaringan dan Aplikasi (SIJA) SMK Muhammadiyah 1 Bantul.
                    </p>
                    <div class="text-xs text-slate-400 flex flex-col gap-1.5 pt-1">
                        <div><i class="fa-solid fa-location-dot text-cyan-400 w-5"></i> Jl. Parangtritis No.KM. 11, Manding, Sabdodadi, Bantul, DIY 55715</div>
                        <div><i class="fa-solid fa-phone text-cyan-400 w-5"></i> (0274) 367349 / Hotline Humas</div>
                    </div>
                </div>

                <!-- Col 2: Nav Links -->
                <div>
                    <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-4 border-l-2 border-cyan-400 pl-2">Menu Pameran</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-cyan-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px] text-cyan-500"></i> Katalog Aplikasi</a></li>
                        <li><a href="{{ route('guestbook.index') }}" class="hover:text-cyan-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px] text-cyan-500"></i> Buku Tamu & Selfie</a></li>
                        <li><a href="{{ route('home') }}#tentang-pameran" class="hover:text-cyan-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px] text-cyan-500"></i> Tentang Expo IT</a></li>
                        <li><a href="{{ route('admin.login') }}" class="hover:text-cyan-400 transition-colors flex items-center gap-2 text-slate-400"><i class="fa-solid fa-lock text-[10px] text-slate-500"></i> Portal Admin</a></li>
                    </ul>
                </div>

                <!-- Col 3: Jurusan & Socials -->
                <div>
                    <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-4 border-l-2 border-teal-400 pl-2">Program Keahlian (Jurusan)</h4>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <a href="{{ route('home', ['jurusan' => 'TKR']) }}#katalog-karya" class="text-xs bg-slate-900 hover:bg-blue-950 text-blue-300 px-2.5 py-1 rounded-md border border-blue-900/60 font-medium transition-colors">TKR</a>
                        <a href="{{ route('home', ['jurusan' => 'TSM']) }}#katalog-karya" class="text-xs bg-slate-900 hover:bg-amber-950 text-amber-300 px-2.5 py-1 rounded-md border border-amber-900/60 font-medium transition-colors">TSM</a>
                        <a href="{{ route('home', ['jurusan' => 'TPM']) }}#katalog-karya" class="text-xs bg-slate-900 hover:bg-rose-950 text-rose-300 px-2.5 py-1 rounded-md border border-rose-900/60 font-medium transition-colors">TPM</a>
                        <a href="{{ route('home', ['jurusan' => 'TAV']) }}#katalog-karya" class="text-xs bg-slate-900 hover:bg-purple-950 text-purple-300 px-2.5 py-1 rounded-md border border-purple-900/60 font-medium transition-colors">TAV</a>
                        <a href="{{ route('home', ['jurusan' => 'PPLG']) }}#katalog-karya" class="text-xs bg-slate-900 hover:bg-cyan-950 text-cyan-300 px-2.5 py-1 rounded-md border border-cyan-900/60 font-medium transition-colors">PPLG</a>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-cyan-400 hover:border-cyan-500/50 transition-all">
                            <i class="fa-brands fa-instagram text-sm"></i>
                        </a>
                        <a href="https://youtube.com" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-cyan-400 hover:border-cyan-500/50 transition-all">
                            <i class="fa-brands fa-youtube text-sm"></i>
                        </a>
                        <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-cyan-400 hover:border-cyan-500/50 transition-all">
                            <i class="fa-brands fa-facebook-f text-sm"></i>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Bottom Copyright -->
            <div class="pt-8 border-t border-slate-900 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-400 gap-3">
                <p>&copy; {{ date('Y') }} SMK Muhammadiyah 1 Bantul. Dikembangkan dengan Laravel 12 & Tailwind CSS.</p>
                <p class="text-slate-400">Pameran Proyek Kreatif & Kewirausahaan (PKK) / Tugas Akhir Siswa</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Floating Bottom Action Button for fast guestbook access on HP -->
    <div class="sm:hidden fixed bottom-5 right-5 z-40">
        <a href="{{ route('guestbook.index') }}" class="flex items-center gap-2 px-4 py-3 bg-gradient-to-r from-cyan-500 to-teal-500 text-slate-950 font-bold text-sm rounded-full shadow-xl shadow-cyan-500/30 hover:scale-105 active:scale-95 transition-transform">
            <i class="fa-solid fa-camera"></i>
            <span>Buku Tamu</span>
        </a>
    </div>

    <!-- Mobile Navigation Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('mobileMenuBtn');
            const menu = document.getElementById('mobileMenu');
            const icon = document.getElementById('menuIcon');

            if (btn && menu) {
                btn.addEventListener('click', () => {
                    menu.classList.toggle('hidden');
                    if (menu.classList.contains('hidden')) {
                        icon.className = 'fa-solid fa-bars text-xl';
                    } else {
                        icon.className = 'fa-solid fa-xmark text-xl';
                    }
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
