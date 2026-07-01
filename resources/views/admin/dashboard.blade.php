@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-heading', 'DASHBOARD')
@section('page-title', 'Dashboard')

@section('content')

    <!-- Stat Cards -->
    <div class="row row-cols-2 row-cols-lg-5 g-3 mb-4">
        <div class="col">
            <div class="stat-card">
                <div class="stat-icon" style="background:#ccfbf1; color:#0f766e;"><i class="bi bi-box-seam-fill"></i></div>
                <div>
                    <h3>{{ $totalAlat ?? 0 }}</h3>
                    <span>Total Alat</span>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="stat-card">
                <div class="stat-icon" style="background:#dcfce7; color:#15803d;"><i class="bi bi-check-circle-fill"></i></div>
                <div>
                    <h3>{{ $kondisiBaik ?? 0 }}</h3>
                    <span>Kondisi Baik</span>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="stat-card">
                <div class="stat-icon" style="background:#fff7ed; color:#c2410c;"><i class="bi bi-tools"></i></div>
                <div>
                    <h3>{{ $rusakRingan ?? 0 }}</h3>
                    <span>Rusak Ringan</span>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="stat-card">
                <div class="stat-icon" style="background:#fef9c3; color:#a16207;"><i class="bi bi-exclamation-triangle-fill"></i></div>
                <div>
                    <h3>{{ $perluPerbaikan ?? 0 }}</h3>
                    <span>Perlu Perbaikan</span>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="stat-card">
                <div class="stat-icon" style="background:#fee2e2; color:#dc2626;"><i class="bi bi-x-circle-fill"></i></div>
                <div>
                    <h3>{{ $rusakBerat ?? 0 }}</h3>
                    <span>Rusak Berat</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Alat Terbaru -->
    <div class="data-card">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
            <h6 class="fw-bold mb-0">Data Alat Terbaru</h6>
            <a href="{{ route('admin.alat.create') }}" class="btn btn-primary-simak btn-sm px-3">
                <i class="bi bi-plus-lg me-1"></i> Add Data
            </a>
        </div>

        <div class="table-responsive">
            <table class="table" id="tabelAlatTerbaru" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama Alat</th>
                        <th>Jenis</th>
                        <th>Lokasi Penyimpanan</th>
                        <th>Kondisi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alatTerbaru ?? [] as $index => $alat)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($alat->gambar)
                                    <img src="{{ asset('storage/' . $alat->gambar) }}" alt="{{ $alat->nama_alat }}"
                                         style="width:44px; height:44px; object-fit:cover; border-radius:10px;">
                                @else
                                    <div class="d-flex align-items-center justify-content-center"
                                         style="width:44px; height:44px; border-radius:10px; background:var(--bg-soft); color:var(--ink-soft);">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $alat->nama_alat }}</td>
                            <td>{{ $alat->jenis }}</td>
                            <td>{{ $alat->lokasi_penyimpanan }}</td>
                            <td>
                                <span class="badge bg-{{ \App\Models\AlatKebersihan::badgeKondisi($alat->kondisi) }} rounded-pill px-3 py-2">
                                    {{ $alat->kondisi }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.alat.edit', $alat->id_alat) }}" class="btn btn-edit btn-sm me-1">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.alat.destroy', $alat->id_alat) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-delete btn-sm">
                                        <i class="bi bi-trash3-fill"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#tabelAlatTerbaru').DataTable({
            dom: "<'row mb-3'<'col-sm-6'B><'col-sm-6'f>>" +
                 "<'row'<'col-sm-12't>>" +
                 "<'row mt-3'<'col-sm-5'i><'col-sm-7'p>>",
            columnDefs: [
                { orderable: false, targets: [1, -1] }
            ],
            buttons: [
                { extend: 'excelHtml5', text: '<i class="bi bi-file-earmark-excel-fill me-1"></i> Excel', className: 'btn btn-sm', exportOptions: { columns: [0, 2, 3, 4, 5] } },
                { extend: 'pdfHtml5', text: '<i class="bi bi-file-earmark-pdf-fill me-1"></i> PDF', className: 'btn btn-sm', exportOptions: { columns: [0, 2, 3, 4, 5] } }
            ],
            language: {
                search: "Search:",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "Belum ada data alat kebersihan.",
                zeroRecords: "Data tidak ditemukan.",
                paginate: { previous: "Previous", next: "Next" }
            }
        });
    });
</script>
@endpush