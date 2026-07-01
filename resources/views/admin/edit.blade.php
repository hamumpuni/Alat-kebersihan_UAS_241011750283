@extends('layouts.admin')

@section('title', 'Edit Data Alat')

@section('content')

<div class="panel-card" style="max-width:760px;">
    <div class="panel-header">
        <h2><i class="bi bi-pencil-square me-1"></i> Edit Data Alat Kebersihan</h2>
        <a href="{{ route('admin.alat.index') }}" class="small text-muted"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
    </div>
    <div class="panel-body">
        <form action="{{ route('admin.alat.update', $alat->id_alat) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-section-label">Foto Alat</div>
            <label class="upload-box d-block mb-4" for="gambar">
                <i class="bi bi-cloud-arrow-up"></i>
                <div class="fw-semibold mt-2">Klik untuk mengganti gambar</div>
                <div class="small text-muted">Kosongkan jika tidak ingin mengganti gambar</div>
                <img id="previewGambar" class="upload-preview mx-auto"
                     src="{{ $alat->gambar ? asset('storage/'.$alat->gambar) : '' }}"
                     style="{{ $alat->gambar ? 'display:block;' : '' }}" alt="Preview">
            </label>
            <input type="file" name="gambar" id="gambar" accept="image/*" class="d-none @error('gambar') is-invalid @enderror">
            @error('gambar')
                <div class="text-danger small mb-3">{{ $message }}</div>
            @enderror

            <div class="form-section-label mt-4">Informasi Alat</div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Alat</label>
                    <input type="text" name="nama_alat" class="form-control @error('nama_alat') is-invalid @enderror" value="{{ old('nama_alat', $alat->nama_alat) }}">
                    @error('nama_alat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jenis Alat</label>
                    <select name="jenis" class="form-select @error('jenis') is-invalid @enderror">
                        @foreach($jenisOptions as $jenis)
                            <option value="{{ $jenis }}" {{ old('jenis', $alat->jenis) == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                        @endforeach
                    </select>
                    @error('jenis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kondisi</label>
                    <select name="kondisi" class="form-select @error('kondisi') is-invalid @enderror">
                        @foreach($kondisiOptions as $kondisi)
                            <option value="{{ $kondisi }}" {{ old('kondisi', $alat->kondisi) == $kondisi ? 'selected' : '' }}>{{ $kondisi }}</option>
                        @endforeach
                    </select>
                    @error('kondisi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Lokasi Penyimpanan</label>
                    <input type="text" name="lokasi_penyimpanan" class="form-control @error('lokasi_penyimpanan') is-invalid @enderror" value="{{ old('lokasi_penyimpanan', $alat->lokasi_penyimpanan) }}">
                    @error('lokasi_penyimpanan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn-brand"><i class="bi bi-check-lg me-1"></i> Update Data</button>
                <a href="{{ route('admin.alat.index') }}" class="btn btn-light border">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.getElementById('gambar').addEventListener('change', function (e) {
        const file = e.target.files[0];
        const preview = document.getElementById('previewGambar');
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    });
</script>
@endpush