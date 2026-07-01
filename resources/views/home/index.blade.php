@extends('layouts.app')

@section('content')
<!-- ================= NAVBAR ================= -->
<nav class="flex items-center justify-between px-6 md:px-12 py-4 bg-bg-soft/80 backdrop-blur-md sticky top-0 z-50 border-b border-mint-soft">
    <!-- Logo & Nama Aplikasi -->
    <div class="flex items-center gap-2 text-primary-dark font-bold text-xl">
        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
        </svg>
        <span>SIMAK</span>
    </div>

    <!-- Menu Links -->
    <div class="hidden md:flex items-center gap-8 text-sm font-semibold text-ink-soft">
        <a href="#" class="text-primary">Beranda</a>
        <a href="{{ url('/daftar-alat') }}" class="hover:text-primary">Daftar Alat</a>
        <a href="{{ url('/laporan-kondisi') }}" class="hover:text-primary transition-colors">Laporan Kondisi</a>
        <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'text-primary' : 'hover:text-primary' }}">Kontak</a>
    </div>
    <a href="/login" class="bg-primary hover:bg-primary-dark text-white px-6 py-2.5 rounded-full font-semibold transition-all shadow-md hover:shadow-lg flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
        Masuk Admin
    </a>
</nav>

<!-- ================= KONTEN UTAMA SIMAK ================= -->
<section class="py-12 md:py-16 bg-bg-soft min-h-screen font-sans">
    <div class="container mx-auto px-6 md:px-12 max-w-7xl">
        <div class="flex flex-col lg:flex-row items-start gap-12">

            <!-- Bagian Kiri: Teks, Tombol & Statistik -->
            <div class="w-full lg:w-7/12">
                <span class="text-primary-dark font-bold tracking-wider uppercase text-xs mb-3 block">Sistem Informasi Fasilitas Kantor</span>
                <h1 class="text-4xl md:text-5xl font-extrabold text-ink mt-2 mb-6 leading-tight">
                    Data Alat Kebersihan Kantor, <span class="text-primary">tercatat rapi</span> & mudah dipantau.
                </h1>
                <p class="text-ink-soft text-lg mb-8 leading-relaxed max-w-2xl">
                    SIMAK membantu tim fasilitas mencatat inventaris, memantau kondisi, dan menelusuri lokasi penyimpanan setiap alat kebersihan kantor secara transparan dan real-time.
                </p>

                <div class="flex flex-wrap gap-4 mb-10">
                    <a href="{{ url('/daftar-alat') }}" class="bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-lg font-semibold transition-all shadow-md">Lihat Daftar Alat</a>
                </div>

                <!-- Statistik: 3 kartu sejajar dalam satu baris -->
                <div class="grid grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-mint-soft">
                        <div class="text-4xl font-bold text-ink mb-1">{{ $totalAlat }}</div>
                        <div class="text-sm font-medium text-ink-soft">Total Alat Tercatat</div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-mint-soft">
                        <div class="text-4xl font-bold text-ink mb-1">{{ $totalJenis }}</div>
                        <div class="text-sm font-medium text-ink-soft">Kategori Jenis Alat</div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-red-50">
                        <div class="text-4xl font-bold text-red-500 mb-1">{{ $totalPerluPerhatian }}</div>
                        <div class="text-sm font-medium text-ink-soft">Perlu Perhatian</div>
                    </div>
                </div>
            </div>

            <!-- Bagian Kanan: Grafik Status Kondisi Alat -->
            <div class="w-full lg:w-5/12 bg-white rounded-2xl shadow-lg border border-mint-soft p-8 flex flex-col items-center">
                <h3 class="text-xl font-bold text-ink mb-1">Status Kondisi Alat</h3>
                <p class="text-sm text-ink-soft mb-6">Ringkasan kondisi seluruh inventaris</p>

                <div class="relative w-48 h-48 rounded-full border-[16px] border-red-50 flex items-center justify-center">
                    <div class="text-center">
                        <div class="text-3xl font-extrabold text-ink">{{ $persentaseBaik ?? 0 }}%</div>
                        <div class="text-xs font-medium text-ink-soft">Kondisi Baik</div>
                    </div>
                </div>

                <div class="mt-6 flex gap-6 text-sm justify-center">
                    <div class="flex items-center gap-2 font-medium text-ink"><span class="w-3 h-3 bg-green-500 rounded-full"></span> Baik ({{ $totalBaik }})</div>
                    <div class="flex items-center gap-2 font-medium text-ink"><span class="w-3 h-3 bg-red-500 rounded-full"></span> Perlu Perhatian ({{ $totalPerluPerhatian }})</div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection