<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator - CMS {{ get_setting('division_acronym', 'Divisi') }} STIKES Panti Waluya</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --color-primary: {{ get_setting('theme_primary_color', '#0e7490') }};
            --color-secondary: {{ get_setting('theme_secondary_color', '#0369a1') }};
        }
        .bg-theme-primary { background-color: var(--color-primary); }
    </style>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4 font-sans text-slate-800 antialiased relative overflow-hidden">

    <!-- Background Glow -->
    <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full opacity-30 blur-3xl" style="background-color: var(--color-primary);"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 rounded-full opacity-20 blur-3xl" style="background-color: var(--color-secondary);"></div>

    <div class="max-w-md w-full relative z-10 space-y-6">
        <!-- Logo & Header -->
        <div class="text-center space-y-2">
            <div class="w-16 h-16 rounded-2xl mx-auto flex items-center justify-center text-white text-3xl shadow-xl" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
                <i class="fa-solid fa-hospital-user"></i>
            </div>
            <h1 class="text-xl font-bold text-white tracking-tight">Panel Administrator CMS</h1>
            <p class="text-xs text-slate-400 font-medium">{{ get_setting('division_name', 'Divisi STIKES Panti Waluya') }}</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-3xl p-8 shadow-2xl space-y-6">
            @if(session('error'))
                <div class="p-3 bg-rose-50 border border-rose-200 rounded-xl text-rose-700 text-xs font-semibold flex items-center">
                    <i class="fa-solid fa-circle-exclamation mr-2 text-rose-500"></i> {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="p-3 bg-rose-50 border border-rose-200 rounded-xl text-rose-700 text-xs font-semibold">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
                @csrf
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Email Administrator</label>
                    <div class="relative">
                        <input type="email" name="email" value="{{ old('email', 'admin@pantiwaluya.ac.id') }}" required autofocus class="w-full pl-10 pr-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white transition" placeholder="admin@pantiwaluya.ac.id">
                        <i class="fa-regular fa-envelope absolute left-3.5 top-3 text-slate-400 text-xs"></i>
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Kata Sandi</label>
                    <div class="relative">
                        <input type="password" name="password" required class="w-full pl-10 pr-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white transition" placeholder="••••••••">
                        <i class="fa-solid fa-lock absolute left-3.5 top-3 text-slate-400 text-xs"></i>
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center space-x-2 cursor-pointer text-slate-600">
                        <input type="checkbox" name="remember" class="rounded text-theme-primary focus:ring-sky-500">
                        <span>Ingat saya</span>
                    </label>
                    <span class="text-slate-400 text-[11px]">Default: password123</span>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow-lg hover:opacity-90 transition">
                        Masuk ke Dashboard
                    </button>
                </div>
            </form>

            <div class="pt-2 border-t border-slate-100 text-center">
                <a href="{{ route('home') }}" class="text-xs text-slate-500 hover:text-theme-primary font-semibold transition">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Website Utama
                </a>
            </div>
        </div>

        <div class="text-center text-[11px] text-slate-500">
            &copy; {{ date('Y') }} {{ get_setting('parent_institution', 'STIKES Panti Waluya Malang') }}
        </div>
    </div>
</body>
</html>
