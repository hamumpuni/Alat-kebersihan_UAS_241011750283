@extends('layouts.admin')

@section('title', 'Tambah Alat')
@section('page-heading', 'TAMBAH ALAT')
@section('page-title', 'Tambah Alat')

@section('content')

    <div class="data-card" style="max-width: 720px;">
        <h6 class="fw-bold mb-4">Tambah Data Alat Kebersihan</h6>

        @if($errors->any())
            <div class="alert alert-danger rounded-3">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.alat.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Alat</label>
                <input type="text" name="nama_alat" value="{{ old('nama_alat') }}"
                       class="form-control" placeholder="Contoh: Vacuum Cleaner" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Jenis</label>
                <select name="jenis" class="form-select" required>
                    <option value="" disabled {{ old('jenis') ? '' : 'selected' }}>Pilih jenis alat</option>
                    @foreach(\App\Models\AlatKebersihan::JENIS_OPTIONS as $jenis)
                        <option value="{{ $jenis }}" {{ old('jenis') === $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Kondisi</label>
                <select name="kondisi" class="form-select" required>
                    <option value="" disabled {{ old('kondisi') ? '' : 'selected' }}>Pilih kondisi alat</option>
                    @foreach(\App\Models\AlatKebersihan::KONDISI_OPTIONS as $kondisi)
                        <option value="{{ $kondisi }}" {{ old('kondisi') === $kondisi ? 'selected' : '' }}>{{ $kondisi }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Lokasi Penyimpanan</label>
                <input type="text" name="lokasi_penyimpanan" value="{{ old('lokasi_penyimpanan') }}"
                       class="form-control" placeholder="Contoh: Gudang A" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Gambar Alat</label>
                <input type="file" name="gambar" accept="image/*" class="form-control">
                <div class="form-text">Opsional. Format JPG/PNG, maksimal 2MB.</div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary-simak px-4">
                    <i class="bi bi-save2-fill me-1"></i> Simpan
                </button>
                <a href="{{ route('admin.alat.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
            </div>
        </form>
    </div>

@endsection