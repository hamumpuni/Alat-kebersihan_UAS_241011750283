@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

@php
    $r = 70;
    $circumference = 2 * M_PI * $r;
    $persenBaik = $totalAlat > 0 ? round(($totalBaik / $totalAlat) * 100) : 0;
    $dashBaik = $totalAlat > 0 ? ($totalBaik / $totalAlat) * $circumference : 0;
@endphp

<section class="hero-section py-5">
    <div class="container py-4">
        <div class="row align-items-center gy-5">
            <div class="col-lg-7">
                <span class="hero-eyebrow"><i class="bi bi-patch-check-fill"></i> Sistem Informasi Fasilitas Kantor</span>
                <h1 class="hero-title mt-3 mb-3">
                    Data Alat Kebersihan Kantor, <span style="color:var(--primary);">tercatat rapi</span> &amp; mudah dipantau.
                </h1>
                <p class="hero-sub mb-4">
                    SIMAK membantu tim fasilitas mencatat inventaris, memantau kondisi, dan menelusuri lokasi
                    penyimpanan setiap alat kebersihan kantor secara transparan dan real-time.
                </p>
                <div class="d-flex flex-wrap gap-3 mb-4">
                    <a href="#daftar-alat" class="btn-brand"><i class="bi bi-grid-3x3-gap me-1"></i> Lihat Daftar Alat</a>
                    <a href="{{ route('login') }}" class="btn-brand-outline"><i class="bi bi-shield-lock me-1"></i> Masuk sebagai Admin</a>
                </div>

                <div class="row g-3">
                    <div class="col-6 col-md-4">
                        <div class="stat-pill">
                            <div class="stat-num">{{ $totalAlat }}</div>
                            <div class="stat-lbl">Total Alat Tercatat</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="stat-pill">
                            <div class="stat-num">{{ $totalJenis }}</div>
                            <div class="stat-lbl">Kategori Jenis Alat</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="stat-pill">
                            <div class="stat-num">{{ $totalPerluPerhatian }}</div>
                            <div class="stat-lbl">Perlu Perhatian</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="kondisi-ring-wrap">
                    <div class="text-center mb-3">
                        <div class="fw-semibold" style="font-family:'Sora',sans-serif;">Status Kondisi Alat</div>
                        <div class="small text-muted">Ringkasan kondisi seluruh inventaris</div>
                    </div>
                    <div class="ring-figure">
                        <svg width="168" height="168" viewBox="0 0 168 168">
                            <circle cx="84" cy="84" r="{{ $r }}" fill="none" stroke="#FEE2E2" stroke-width="16"/>
                            <circle cx="84" cy="84" r="{{ $r }}" fill="none" stroke="#16A34A" stroke-width="16"
                                    stroke-linecap="round"
                                    stroke-dasharray="{{ $dashBaik }} {{ $circumference }}"
                                    transform="rotate(-90 84 84)"/>
                        </svg>
                        <div class="ring-center">
                            <span class="num">{{ $persenBaik }}%</span>
                            <span class="lbl">Kondisi Baik</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center gap-4 mt-3 small">
                        <span><span class="legend-dot" style="background:#16A34A;"></span>Baik ({{ $totalBaik }})</span>
                        <span><span class="legend-dot" style="background:#FEE2E2;border:1px solid #DC2626;"></span>Perlu Perhatian ({{ $totalPerluPerhatian }})</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container py-5" id="tentang">
    <div class="row g-4 text-center">
        <div class="col-md-4">
            <div class="p-4">
                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:54px;height:54px;border-radius:14px;background:var(--mint-soft);color:var(--primary);font-size:1.4rem;"><i class="bi bi-search"></i></div>
                <h3 class="h6">Transparan</h3>
                <p class="small text-muted mb-0">Setiap data alat, kondisi, dan lokasi penyimpanan dapat ditelusuri publik kapan saja.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4">
                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:54px;height:54px;border-radius:14px;background:var(--mint-soft);color:var(--primary);font-size:1.4rem;"><i class="bi bi-shield-check"></i></div>
                <h3 class="h6">Terkelola Rapi</h3>
                <p class="small text-muted mb-0">Petugas fasilitas memperbarui data melalui panel admin yang aman dengan login.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4">
                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:54px;height:54px;border-radius:14px;background:var(--mint-soft);color:var(--primary);font-size:1.4rem;"><i class="bi bi-file-earmark-pdf"></i></div>
                <h3 class="h6">Laporan Siap Pakai</h3>
                <p class="small text-muted mb-0">Laporan inventaris dapat diekspor ke PDF untuk kebutuhan administrasi.</p>
            </div>
        </div>
    </div>
</section>

<section class="container pb-5" id="daftar-alat">
    <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-4">
        <div>
            <h2 class="h4 mb-1">Daftar Alat Kebersihan</h2>
            <p class="text-muted small mb-0">Telusuri seluruh inventaris alat kebersihan kantor di bawah ini.</p>
        </div>
    </div>

    <form method="GET" action="{{ route('home') }}#daftar-alat" class="filter-bar mb-4">
        <div class="row g-3 align-items-center">
            <div class="col-md-5">
                <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari nama alat...">
            </div>
            <div class="col-md-4">
                <select name="jenis" class="form-select">
                    <option value="">Semua Jenis</option>
                    @foreach($jenisOptions as $jenis)
                        <option value="{{ $jenis }}" {{ request('jenis') == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn-brand flex-fill"><i class="bi bi-funnel me-1"></i> Filter</button>
                @if(request('q') || request('jenis'))
                    <a href="{{ route('home') }}#daftar-alat" class="btn btn-light border"><i class="bi bi-x-lg"></i></a>
                @endif
            </div>
        </div>
    </form>

    @if($alats->count())
        <div class="row g-4">
            @foreach($alats as $alat)
                <div class="col-sm-6 col-lg-3">
                    <div class="alat-card">
                        <div class="img-wrap">
                            @if($alat->gambar)
                                <img src="{{ asset('storage/'.$alat->gambar) }}" alt="{{ $alat->nama_alat }}">
                            @else
                                <div class="img-fallback"><i class="bi bi-image"></i></div>
                            @endif
                            <span class="badge-jenis">{{ $alat->jenis }}</span>
                        </div>
                        <div class="body">
                            <div class="nama">{{ $alat->nama_alat }}</div>
                            <div class="meta"><i class="bi bi-geo-alt"></i> {{ $alat->lokasi_penyimpanan }}</div>
                            <div class="d-flex align-items-center justify-content-between mt-2">
                                <span class="badge rounded-pill badge-kondisi-{{ str_replace(' ', '', $alat->kondisi) }} px-3 py-2">{{ $alat->kondisi }}</span>
                                <a href="{{ route('home.detail', $alat->id_alat) }}" class="small fw-semibold" style="color:var(--primary);">Detail <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $alats->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-inbox" style="font-size:2.5rem;color:var(--primary-light);"></i>
            <p class="text-muted mt-2 mb-0">Belum ada data yang cocok dengan pencarian.</p>
        </div>
    @endif
</section>

@endsection