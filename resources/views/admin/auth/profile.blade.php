@extends('layouts.admin')

@section('title', 'Profil & Keamanan Akun')

@section('content')
<div class="max-w-4xl space-y-6">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Profil & Keamanan Akun</h1>
        <p class="text-xs text-slate-500 mt-1">Perbarui nama administrator, alamat email, dan kata sandi login.</p>
    </div>

    <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200">
        <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-6">
            @csrf
            <div class="space-y-4">
                <h3 class="text-sm font-bold text-slate-900 border-b pb-2">Informasi Akun</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                    </div>
                </div>
            </div>

            <div class="space-y-4 pt-4 border-t border-slate-100">
                <h3 class="text-sm font-bold text-slate-900 border-b pb-2">Ganti Kata Sandi (Opsional)</h3>
                <p class="text-xs text-slate-500">Kosongkan jika tidak ingin mengubah kata sandi.</p>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Kata Sandi Lama</label>
                        <input type="password" name="current_password" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="••••••••">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Kata Sandi Baru</label>
                        <input type="password" name="new_password" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Min. 6 karakter">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" name="new_password_confirmation" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Ulangi sandi baru">
                    </div>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
