@extends('layouts.admin')

@section('title', 'Pesan & Pertanyaan Masuk')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Pesan & Pengaduan Masuk</h1>
        <p class="text-xs text-slate-500 mt-1">Daftar pertanyaan dan saran yang dikirimkan pengunjung melalui formulir kontak.</p>
    </div>

    <!-- Messages Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-700 font-bold uppercase text-[10px] tracking-wider">
                    <tr>
                        <th class="p-4">Pengirim</th>
                        <th class="p-4">Perihal / Subjek</th>
                        <th class="p-4">Tanggal Masuk</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($messages as $msg)
                    <tr class="hover:bg-slate-50 transition {{ !$msg->is_read ? 'bg-sky-50/40 font-semibold' : '' }}">
                        <td class="p-4">
                            <div class="font-bold text-slate-900">{{ $msg->name }}</div>
                            <div class="text-[11px] text-slate-400">{{ $msg->email }} @if($msg->phone)• {{ $msg->phone }}@endif</div>
                        </td>
                        <td class="p-4">
                            <div class="text-slate-800 line-clamp-1">{{ $msg->subject }}</div>
                            <div class="text-[11px] text-slate-400 line-clamp-1">{{ $msg->message }}</div>
                        </td>
                        <td class="p-4 text-[11px]">
                            {{ $msg->created_at->translatedFormat('d M Y, H:i') }}
                        </td>
                        <td class="p-4">
                            @if(!$msg->is_read)
                                <span class="px-2.5 py-1 rounded-full bg-rose-100 text-rose-700 text-[10px] font-bold">Baru (Belum Dibaca)</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 text-[10px] font-bold">Sudah Dibaca</span>
                            @endif
                        </td>
                        <td class="p-4 text-right space-x-2">
                            <a href="{{ route('admin.messages.show', $msg->id) }}" class="px-3 py-1.5 rounded-lg bg-sky-600 text-white font-semibold text-xs hover:bg-sky-700 transition">Buka Pesan</a>
                            <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pesan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 rounded-lg text-rose-600 hover:bg-rose-50 transition" title="Hapus"><i class="fa-regular fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-slate-400">Belum ada pesan yang masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $messages->links() }}
    </div>
</div>
@endsection
