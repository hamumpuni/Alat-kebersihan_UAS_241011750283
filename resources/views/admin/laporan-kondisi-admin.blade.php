@extends('layouts.admin')

@section('title', 'Laporan Kondisi')
@section('page-heading', 'LAPORAN KONDISI')
@section('page-title', 'Laporan Kondisi')

@section('content')

    <!-- Ringkasan singkat -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#dcfce7; color:#15803d;"><i class="bi bi-check-circle-fill"></i></div>
                <div>
                    <h3>{{ $totalBaik ?? 0 }}</h3>
                    <span>Kondisi Baik</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#fef9c3; color:#a16207;"><i class="bi bi-exclamation-triangle-fill"></i></div>
                <div>
                    <h3>{{ $totalPerbaikan ?? 0 }}</h3>
                    <span>Perlu Perbaikan</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#fee2e2; color:#dc2626;"><i class="bi bi-x-circle-fill"></i></div>
                <div>
                    <h3>{{ $totalRusak ?? 0 }}</h3>
                    <span>Rusak Berat</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#ccfbf1; color:#0f766e;"><i class="bi bi-clipboard2-pulse-fill"></i></div>
                <div>
                    <h3>{{ $totalLaporan ?? 0 }}</h3>
                    <span>Total Laporan</span>
                </div>
            </div>
        </div>
    </div>

    <div class="data-card">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
            <h6 class="fw-bold mb-0">Rekapitulasi Kondisi Inventaris</h6>
            <a href="{{ url('/admin/laporan-kondisi/create') }}" class="btn btn-primary-simak btn-sm px-3">
                <i class="bi bi-plus-lg me-1"></i> Tambah Cek Kondisi
            </a>
        </div>

        <div class="table-responsive">
            <table class="table" id="tabelLaporan" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Alat</th>
                        <th>Kondisi Terakhir</th>
                        <th>Tanggal Cek</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporanKondisi ?? [] as $index => $laporan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="fw-semibold">{{ $laporan->nama_alat }}</td>
                            <td>{{ $laporan->kondisi_terakhir }}</td>
                            <td>{{ \Carbon\Carbon::parse($laporan->tanggal_cek)->format('d-m-Y') }}</td>
                            <td>
                                @if($laporan->status === 'Baik')
                                    <span class="badge-baik">Baik</span>
                                @elseif($laporan->status === 'Perlu Perbaikan')
                                    <span class="badge-perbaikan">Perlu Perbaikan</span>
                                @else
                                    <span class="badge-rusak">Rusak Berat</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('/admin/laporan-kondisi/' . $laporan->id . '/edit') }}" class="btn btn-edit btn-sm me-1">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ url('/admin/laporan-kondisi/' . $laporan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus laporan ini?')">
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
        $('#tabelLaporan').DataTable({
            dom: "<'row mb-3'<'col-sm-6'B><'col-sm-6'f>>" +
                 "<'row'<'col-sm-12't>>" +
                 "<'row mt-3'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                { extend: 'excelHtml5', text: '<i class="bi bi-file-earmark-excel-fill me-1"></i> Excel', className: 'btn btn-sm' },
                { extend: 'pdfHtml5', text: '<i class="bi bi-file-earmark-pdf-fill me-1"></i> PDF', className: 'btn btn-sm' }
            ],
            language: {
                search: "Search:",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "Belum ada laporan kondisi.",
                zeroRecords: "Data tidak ditemukan.",
                paginate: { previous: "Previous", next: "Next" }
            }
        });
    });
</script>
@endpush