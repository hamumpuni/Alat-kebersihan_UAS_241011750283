@extends('layouts.admin')

@section('title', 'Pesan Masuk')
@section('page-heading', 'PESAN MASUK')
@section('page-title', 'Pesan Masuk')

@section('content')

    <div class="data-card">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
            <h6 class="fw-bold mb-0">Pesan dari Formulir Kontak</h6>
        </div>

        <div class="table-responsive">
            <table class="table" id="tabelPesan" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Pesan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesanMasuk ?? [] as $index => $pesan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="fw-semibold">{{ $pesan->nama }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($pesan->pesan, 60) }}</td>
                            <td>{{ \Carbon\Carbon::parse($pesan->created_at)->format('d-m-Y H:i') }}</td>
                            <td>
                                @if($pesan->status === 'Dibaca')
                                    <span class="badge-baik">Dibaca</span>
                                @else
                                    <span class="badge-belum">Belum Dibaca</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-view btn-sm me-1"
                                        data-bs-toggle="modal" data-bs-target="#modalPesan{{ $pesan->id }}">
                                    <i class="bi bi-eye-fill"></i> Lihat
                                </button>
                                <form action="{{ url('/admin/pesan-masuk/' . $pesan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus pesan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-delete btn-sm">
                                        <i class="bi bi-trash3-fill"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Detail Pesan -->
                        <div class="modal fade" id="modalPesan{{ $pesan->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content rounded-4">
                                    <div class="modal-header border-0">
                                        <h6 class="modal-title fw-bold">Pesan dari {{ $pesan->nama }}</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-muted small mb-1"><i class="bi bi-envelope me-1"></i>{{ $pesan->email ?? '-' }}</p>
                                        <p class="text-muted small mb-3"><i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($pesan->created_at)->format('d-m-Y H:i') }}</p>
                                        <p class="mb-0">{{ $pesan->pesan }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        $('#tabelPesan').DataTable({
            dom: "<'row mb-3'<'col-sm-6'B><'col-sm-6'f>>" +
                 "<'row'<'col-sm-12't>>" +
                 "<'row mt-3'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                { extend: 'excelHtml5', text: '<i class="bi bi-file-earmark-excel-fill me-1"></i> Excel', className: 'btn btn-sm' },
                { extend: 'pdfHtml5', text: '<i class="bi bi-file-earmark-pdf-fill me-1"></i> PDF', className: 'btn btn-sm' }
            ],
            columnDefs: [
                { orderable: false, targets: -1 }
            ],
            language: {
                search: "Search:",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "Belum ada pesan masuk.",
                zeroRecords: "Data tidak ditemukan.",
                paginate: { previous: "Previous", next: "Next" }
            }
        });
    });
</script>
@endpush