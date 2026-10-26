<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator - {{ \App\Models\Setting::get('school_name', 'SMK Muhammadiyah 1 Bantul') }}</title>

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
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-slate-950 flex flex-col justify-center py-12 sm:px-6 lg:px-8 relative overflow-hidden selection:bg-cyan-500 selection:text-slate-950">

    <!-- Background glowing orbs -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-teal-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="sm:mx-auto sm:w-full sm:max-w-md relative z-10">
        <!-- Logo & Title -->
        <div class="text-center">
            @php $currentLogo = \App\Models\Setting::logoUrl(); @endphp
            <div class="inline-flex justify-center mb-3">
                @if($currentLogo)
                    <img src="{{ $currentLogo }}" alt="Logo" class="w-16 h-16 object-contain rounded-2xl bg-slate-900 p-2.5 border border-slate-800 shadow-xl shadow-cyan-500/10">
                @else
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-cyan-500 to-teal-400 flex items-center justify-center text-slate-950 font-extrabold shadow-xl shadow-cyan-500/20">
                        <i class="fa-solid fa-graduation-cap text-3xl"></i>
                    </div>
                @endif
            </div>

            <h1 class="text-xs font-bold uppercase tracking-widest text-cyan-400 mb-1">
                {{ \App\Models\Setting::get('school_name', 'SMK Muhammadiyah 1 Bantul') }}
            </h1>
            <h2 class="text-2xl font-extrabold text-white tracking-tight">
                Portal Admin Expo
            </h2>
            <p class="text-xs text-slate-400 mt-1">
                Masuk untuk mengelola logo, karya siswa, dan buku tamu
            </p>
        </div>

        <!-- Login Card -->
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-slate-900/90 backdrop-blur-xl py-8 px-6 sm:px-10 shadow-2xl rounded-2xl border border-slate-800 relative">
                
                @if(session('success'))
                    <div class="mb-5 p-3 rounded-xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 text-xs flex items-center gap-2">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-5 p-3 rounded-xl bg-rose-500/15 border border-rose-500/30 text-rose-300 text-xs flex items-start gap-2">
                        <i class="fa-solid fa-triangle-exclamation mt-0.5"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form class="space-y-5" action="{{ route('admin.login.submit') }}" method="POST">
                    @csrf

                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-xs font-semibold text-slate-300 mb-1.5">
                            Alamat Email Admin
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                <i class="fa-solid fa-envelope text-sm"></i>
                            </div>
                            <input id="email" name="email" type="email" autocomplete="email" required
                                value="{{ old('email', 'admin@musaba.sch.id') }}"
                                placeholder="admin@musaba.sch.id"
                                class="block w-full pl-10 pr-3 py-2.5 bg-slate-950 border border-slate-700 rounded-xl text-white placeholder-slate-500 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all">
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-xs font-semibold text-slate-300 mb-1.5">
                            Kata Sandi (Password)
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                <i class="fa-solid fa-lock text-sm"></i>
                            </div>
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                value="admin123"
                                placeholder="••••••••"
                                class="block w-full pl-10 pr-10 py-2.5 bg-slate-950 border border-slate-700 rounded-xl text-white placeholder-slate-500 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all">
                            <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-500 hover:text-slate-300">
                                <i id="eyeIcon" class="fa-solid fa-eye text-sm"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me Checkbox -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input id="remember" name="remember" type="checkbox" checked class="w-4 h-4 rounded bg-slate-950 border-slate-700 text-cyan-500 focus:ring-cyan-500">
                            <span class="text-xs text-slate-400">Ingat saya di perangkat ini</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="w-full flex justify-center items-center gap-2 py-3 px-4 border border-transparent rounded-xl shadow-lg shadow-cyan-500/20 text-sm font-bold text-slate-950 bg-gradient-to-r from-cyan-400 to-teal-400 hover:from-cyan-300 hover:to-teal-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition-all active:scale-[0.98]">
                            <i class="fa-solid fa-right-to-bracket text-base"></i>
                            <span>Masuk ke Panel Admin</span>
                        </button>
                    </div>
                </form>

                <!-- Quick Fill Test Account Box -->
                <div class="mt-6 pt-5 border-t border-slate-800 text-center">
                    <p class="text-[11px] text-slate-400 mb-2">Akun Default Administrator:</p>
                    <div class="inline-flex items-center gap-2 bg-slate-950/80 px-3 py-1.5 rounded-lg border border-slate-800 text-xs text-slate-300 font-mono">
                        <span class="text-cyan-400">admin@musaba.sch.id</span> &bull; <span>admin123</span>
                    </div>
                </div>
            </div>

            <!-- Back to website link -->
            <div class="text-center mt-6">
                <a href="{{ route('home') }}" class="text-xs font-medium text-slate-400 hover:text-cyan-400 transition-colors inline-flex items-center gap-1.5">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Kembali ke Halaman Utama Portal Pameran</span>
                </a>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const pwdInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (pwdInput.type === 'password') {
                pwdInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                pwdInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
