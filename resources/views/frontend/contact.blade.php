@extends('layouts.frontend')

@section('title', 'Kontak Kami - ' . get_setting('division_short_name', 'Divisi'))

@section('content')
<!-- Header -->
<div class="py-14 text-white" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl space-y-2">
            <div class="text-xs uppercase tracking-wider font-semibold text-slate-200">Hubungi Kami</div>
            <h1 class="text-3xl sm:text-4xl font-extrabold">Kontak & Lokasi Kantor</h1>
            <p class="text-sm sm:text-base text-slate-100/90">Sampaikan pertanyaan, permohonan kerjasama, atau konsultasi layanan divisi.</p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Contact Info & Map (5 cols) -->
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-6">
                <h2 class="text-xl font-bold text-slate-900">Informasi Kantor</h2>

                <div class="space-y-4 text-xs sm:text-sm text-slate-600">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 rounded-lg bg-sky-50 text-theme-primary flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <span class="font-bold block text-slate-900">Alamat Kampus:</span>
                            <span>{{ get_setting('contact_address', 'Jl. Yulius Usman No. 62, Kasin, Kec. Klojen, Kota Malang') }}</span>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 rounded-lg bg-sky-50 text-theme-primary flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fa-solid fa-door-open"></i>
                        </div>
                        <div>
                            <span class="font-bold block text-slate-900">Ruangan / Lantai:</span>
                            <span>{{ get_setting('contact_room', 'Gedung Rektorat Lt. 2') }}</span>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 rounded-lg bg-sky-50 text-theme-primary flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <div>
                            <span class="font-bold block text-slate-900">Jam Layanan:</span>
                            <span>{{ get_setting('operating_hours', 'Senin - Jumat: 08.00 - 16.00 WIB') }}</span>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 rounded-lg bg-sky-50 text-theme-primary flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fa-regular fa-envelope"></i>
                        </div>
                        <div>
                            <span class="font-bold block text-slate-900">Email Resmi:</span>
                            <span>{{ get_setting('contact_email', 'info@pantiwaluya.ac.id') }}</span>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 rounded-lg bg-sky-50 text-theme-primary flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div>
                            <span class="font-bold block text-slate-900">Telepon Kantor:</span>
                            <span>{{ get_setting('contact_phone', '(0341) 569275') }}</span>
                        </div>
                    </div>

                    @if(get_setting('contact_whatsapp'))
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div>
                            <span class="font-bold block text-slate-900">WhatsApp Pelayanan:</span>
                            <span>{{ get_setting('contact_whatsapp') }}</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Google Maps Embed -->
            @if(get_setting('google_maps_embed'))
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-200 h-64">
                <iframe src="{{ get_setting('google_maps_embed') }}" class="w-full h-full border-0" allowfullscreen="" loading="lazy"></iframe>
            </div>
            @endif
        </div>

        <!-- Contact Form (7 cols) -->
        <div class="lg:col-span-7">
            <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-6">
                <div>
                    <h2 class="text-xl font-bold text-slate-900">Kirim Pesan / Pengaduan</h2>
                    <p class="text-xs text-slate-500 mt-1">Pesan Anda akan langsung terkirim ke dashboard pengurus divisi.</p>
                </div>

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-slate-700">Nama Lengkap <span class="text-rose-500">*</span></label>
                            <input type="text" name="name" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Contoh: Budi Santoso">
                        </div>

                        <div class="space-y-1">
                            <label class="text-xs font-bold text-slate-700">Email Aktif <span class="text-rose-500">*</span></label>
                            <input type="email" name="email" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="nama@email.com">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-slate-700">No. WhatsApp / HP</label>
                            <input type="text" name="phone" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="08123456789">
                        </div>

                        <div class="space-y-1">
                            <label class="text-xs font-bold text-slate-700">Perihal / Subjek <span class="text-rose-500">*</span></label>
                            <input type="text" name="subject" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Contoh: Konsultasi Layanan Kaji Etik">
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Isi Pesan <span class="text-rose-500">*</span></label>
                        <textarea name="message" rows="5" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Tuliskan pesan, saran, atau pertanyaan Anda secara rinci..."></textarea>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="px-6 py-3 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition flex items-center">
                            <i class="fa-solid fa-paper-plane mr-2"></i> Kirim Pesan Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
