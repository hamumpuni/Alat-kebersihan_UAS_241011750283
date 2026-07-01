@extends('layouts.app')

@section('content')
<!-- ================= NAVBAR ================= -->
<nav class="flex items-center justify-between px-6 md:px-12 py-4 bg-bg-soft/80 backdrop-blur-md sticky top-0 z-50 border-b border-mint-soft">
    <div class="flex items-center gap-2 text-primary-dark font-bold text-xl">
        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
        </svg>
        <span>SIMAK</span>
    </div>

    <div class="hidden md:flex items-center gap-8 text-sm font-semibold text-ink-soft">
        <a href="{{ url('/') }}" class="hover:text-primary">Beranda</a>
        <a href="{{ url('/daftar-alat') }}" class="hover:text-primary">Daftar Alat</a>
        <a href="{{ url('/laporan-kondisi') }}" class="hover:text-primary transition-colors">Laporan Kondisi</a>
        <a href="{{ route('kontak') }}" class="text-primary">Kontak</a>
    </div>

    <a href="/login" class="bg-primary hover:bg-primary-dark text-white px-6 py-2.5 rounded-full font-semibold transition-all shadow-md hover:shadow-lg flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
        Masuk Admin
    </a>
</nav>

<!-- ================= KONTEN HUBUNGI KAMI ================= -->
<section class="py-12 md:py-16 bg-bg-soft min-h-screen font-sans">
    <div class="container mx-auto px-6 md:px-12 max-w-4xl text-center">

        <h1 class="text-3xl md:text-4xl font-extrabold text-ink mb-3">Hubungi Kami</h1>
        <p class="text-ink-soft mb-10">Punya pertanyaan atau kendala seputar inventaris? Silakan hubungi tim fasilitas.</p>

        @if(session('success'))
            <div class="mb-6 bg-green-100 text-green-700 text-sm font-semibold px-5 py-3 rounded-xl text-left">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-lg border border-mint-soft p-8 md:p-10 text-left">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                <!-- Info Kontak -->
                <div class="space-y-6">
                    <div>
                        <h3 class="font-bold text-ink mb-1">Alamat Kantor</h3>
                        <p class="text-ink-soft">Jl. Fasilitas No. 123, Jakarta Selatan</p>
                    </div>
                    <div>
                        <h3 class="font-bold text-ink mb-1">Email</h3>
                        <p class="text-ink-soft">support@simak-kantor.id</p>
                    </div>
                    <div>
                        <h3 class="font-bold text-ink mb-1">WhatsApp</h3>
                        <p class="text-ink-soft">+62 812-3456-7890</p>
                    </div>
                </div>

                <!-- Form Pesan -->
                <form action="{{ route('kontak.kirim') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <input
                            type="text"
                            name="nama"
                            placeholder="Nama Anda"
                            value="{{ old('nama') }}"
                            required
                            class="w-full border border-mint-soft rounded-xl px-4 py-3 text-ink placeholder-ink-soft/60 focus:outline-none focus:ring-2 focus:ring-primary"
                        >
                        @error('nama')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <textarea
                            name="pesan"
                            placeholder="Pesan Anda"
                            rows="5"
                            required
                            class="w-full border border-mint-soft rounded-xl px-4 py-3 text-ink placeholder-ink-soft/60 focus:outline-none focus:ring-2 focus:ring-primary resize-y"
                        >{{ old('pesan') }}</textarea>
                        @error('pesan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-3 rounded-xl transition-all shadow-md hover:shadow-lg"
                    >
                        Kirim Pesan
                    </button>
                </form>

            </div>
        </div>

    </div>
</section>
@endsection