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
        <a href="{{ url('/daftar-alat') }}" class="text-primary">Daftar Alat</a>
        <a href="{{ url('/laporan-kondisi') }}" class="hover:text-primary transition-colors">Laporan Kondisi</a>
        <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'text-primary' : 'hover:text-primary' }}">Kontak</a>
    </div>

    <a href="/login" class="bg-primary hover:bg-primary-dark text-white px-6 py-2.5 rounded-full font-semibold transition-all shadow-md hover:shadow-lg flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
        Masuk Admin
    </a>
</nav>

<!-- ================= KONTEN DAFTAR ALAT ================= -->
<section class="py-12 md:py-16 bg-bg-soft min-h-screen font-sans">
    <div class="container mx-auto px-6 md:px-12 max-w-7xl">

        <h1 class="text-3xl md:text-4xl font-extrabold text-ink mb-2">Daftar Alat Kebersihan</h1>
        <p class="text-ink-soft mb-8">Seluruh inventaris alat kebersihan yang tercatat di sistem.</p>

        <div class="bg-white rounded-2xl shadow-sm border border-mint-soft overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-bg-soft/70 border-b border-mint-soft">
                        <th class="px-8 py-4 text-sm font-bold text-ink-soft uppercase tracking-wide w-16">No</th>
                        <th class="px-8 py-4 text-sm font-bold text-ink-soft uppercase tracking-wide">Nama Alat</th>
                        <th class="px-8 py-4 text-sm font-bold text-ink-soft uppercase tracking-wide">Kategori</th>
                        <th class="px-8 py-4 text-sm font-bold text-ink-soft uppercase tracking-wide">Lokasi</th>
                        <th class="px-8 py-4 text-sm font-bold text-ink-soft uppercase tracking-wide">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($daftarAlat as $index => $alat)
                        <tr class="border-b border-mint-soft last:border-0 hover:bg-bg-soft/40 transition-colors">
                            <td class="px-8 py-5 text-ink-soft">{{ $index + 1 }}</td>
                            <td class="px-8 py-5 font-bold text-ink">{{ $alat->nama_alat }}</td>
                            <td class="px-8 py-5 text-ink-soft">{{ $alat->kategori }}</td>
                            <td class="px-8 py-5 text-ink-soft">{{ $alat->lokasi }}</td>
                            <td class="px-8 py-5">
                                @if($alat->status === 'Baik')
                                    <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1.5 rounded-full">Baik</span>
                                @else
                                    <span class="bg-red-100 text-red-600 text-xs font-bold px-3 py-1.5 rounded-full">Perlu Perhatian</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-10 text-center text-ink-soft">Belum ada data alat yang tercatat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(isset($daftarAlat) && method_exists($daftarAlat, 'links'))
            <div class="mt-8">
                {{ $daftarAlat->links() }}
            </div>
        @endif

    </div>
</section>
@endsection