@extends('layouts.app')

@section('title', $alat->nama_alat)

@section('content')
<section class="container py-5">
    <a href="{{ route('home') }}" class="small text-muted mb-4 d-inline-flex align-items-center gap-1">
        <i class="bi bi-arrow-left"></i> Kembali ke daftar alat
    </a>

    <div class="row g-4 mt-1">
        <div class="col-lg-6">
            <div class="rounded-4 overflow-hidden border" style="aspect-ratio:4/3;background:var(--mint-soft);">
                @if($alat->gambar)
                    <img src="{{ asset('storage/'.$alat->gambar) }}" alt="{{ $alat->nama_alat }}" class="w-100 h-100" style="object-fit:cover;">
                @else
                    <div class="d-flex align-items-center justify-content-center h-100" style="color:var(--primary);font-size:3rem;">
                        <i class="bi bi-image"></i>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-lg-6">
            <span class="badge-jenis d-inline-block mb-2" style="position:static;">{{ $alat->jenis }}</span>
            <h1 class="h3 mb-3">{{ $alat->nama_alat }}</h1>

            <div class="panel-card mb-3">
                <div class="panel-body">
                    <div class="row gy-3">
                        <div class="col-6">
                            <div class="text-muted small">ID Alat</div>
                            <div class="fw-semibold">#{{ str_pad($alat->id_alat, 4, '0', STR_PAD_LEFT) }}</div>
                        </div>
                        <div class="col-6">
                            <div class="text-muted small">Kondisi</div>
                            <span class="badge rounded-pill badge-kondisi-{{ str_replace(' ', '', $alat->kondisi) }} px-3 py-2">{{ $alat->kondisi }}</span>
                        </div>
                        <div class="col-6">
                            <div class="text-muted small">Lokasi Penyimpanan</div>
                            <div class="fw-semibold"><i class="bi bi-geo-alt me-1"></i>{{ $alat->lokasi_penyimpanan }}</div>
                        </div>
                        <div class="col-6">
                            <div class="text-muted small">Diperbarui</div>
                            <div class="fw-semibold">{{ $alat->updated_at->translatedFormat('d M Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('login') }}" class="btn-brand-outline"><i class="bi bi-pencil-square me-1"></i> Kelola data ini (login admin)</a>
        </div>
    </div>

    @if($terkait->count())
        <div class="mt-5">
            <h2 class="h5 mb-3">Alat lain dengan jenis serupa</h2>
            <div class="row g-4">
                @foreach($terkait as $item)
                    <div class="col-sm-6 col-lg-4">
                        <div class="alat-card">
                            <div class="img-wrap">
                                @if($item->gambar)
                                    <img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->nama_alat }}">
                                @else
                                    <div class="img-fallback"><i class="bi bi-image"></i></div>
                                @endif
                            </div>
                            <div class="body">
                                <div class="nama">{{ $item->nama_alat }}</div>
                                <div class="meta"><i class="bi bi-geo-alt"></i> {{ $item->lokasi_penyimpanan }}</div>
                                <a href="{{ route('home.detail', $item->id_alat) }}" class="small fw-semibold mt-2 d-inline-block" style="color:var(--primary);">Lihat detail <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</section>
@endsection