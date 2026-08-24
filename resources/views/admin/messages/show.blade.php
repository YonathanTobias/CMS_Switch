@extends('layouts.admin')

@section('title', 'Detail Pesan - ' . $message->subject)

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.messages.index') }}" class="p-2 rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition text-xs">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Detail Pesan Masuk</h1>
            <p class="text-xs text-slate-500">Diterima pada {{ $message->created_at->translatedFormat('l, d F Y - H:i') }} WIB</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-6">
        <!-- Sender info box -->
        <div class="p-4 bg-slate-50 rounded-xl border border-slate-100 grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
            <div>
                <span class="text-slate-400 block font-medium">Nama Pengirim:</span>
                <span class="font-bold text-slate-900 text-sm">{{ $message->name }}</span>
            </div>
            <div>
                <span class="text-slate-400 block font-medium">Email:</span>
                <a href="mailto:{{ $message->email }}" class="font-bold text-sky-600 hover:underline">{{ $message->email }}</a>
            </div>
            <div>
                <span class="text-slate-400 block font-medium">No. Telepon / WA:</span>
                <span class="font-bold text-slate-900">{{ $message->phone ?: '-' }}</span>
            </div>
        </div>

        <!-- Subject & Message -->
        <div class="space-y-3">
            <h3 class="text-lg font-bold text-slate-900">{{ $message->subject }}</h3>
            <div class="p-5 rounded-xl bg-white border border-slate-200 text-slate-700 text-sm leading-relaxed whitespace-pre-line">
                {{ $message->message }}
            </div>
        </div>

        <!-- Actions -->
        <div class="pt-4 border-t flex items-center justify-between">
            <a href="mailto:{{ $message->email }}?subject=Balasan: {{ urlencode($message->subject) }}" class="px-5 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition flex items-center">
                <i class="fa-solid fa-reply mr-2"></i> Balas Lewat Email
            </a>
            
            <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2.5 rounded-xl bg-rose-50 text-rose-700 hover:bg-rose-100 font-bold text-xs transition flex items-center">
                    <i class="fa-regular fa-trash-can mr-1.5"></i> Hapus Pesan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
