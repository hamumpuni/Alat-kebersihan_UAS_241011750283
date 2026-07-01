<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 24px 28px; }
        body { font-family: 'Helvetica', Arial, sans-serif; color: #0B2B28; font-size: 11px; }
        .header { border-bottom: 2px solid #0F766E; padding-bottom: 10px; margin-bottom: 16px; }
        .header h1 { font-size: 16px; margin: 0 0 2px; color: #0A5450; }
        .header p { margin: 0; font-size: 10px; color: #547571; }
        table { width: 100%; border-collapse: collapse; }
        thead th {
            background: #0F766E; color: #fff; text-align: left;
            padding: 7px 8px; font-size: 9.5px; text-transform: uppercase; letter-spacing: .03em;
        }
        tbody td { padding: 6px 8px; border-bottom: 1px solid #DCEEEA; }
        tbody tr:nth-child(even) { background: #F4FBF9; }
        .badge {
            display: inline-block; padding: 2px 8px; border-radius: 999px; font-size: 9px; font-weight: bold;
        }
        .badge-baik { background:#DCFCE7; color:#15803D; }
        .badge-ringan { background:#FEF3C7; color:#B45309; }
        .badge-perbaikan { background:#DBEAFE; color:#1D4ED8; }
        .badge-berat { background:#FEE2E2; color:#B91C1C; }
        .footer { margin-top: 18px; font-size: 9px; color: #547571; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Data Alat Kebersihan Kantor</h1>
        <p>SIMAK - Sistem Inventaris Alat Kebersihan Kantor &middot; Dicetak pada {{ $tanggal }} &middot; Total {{ $alats->count() }} data</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width:6%;">No</th>
                <th style="width:22%;">Nama Alat</th>
                <th style="width:24%;">Jenis</th>
                <th style="width:14%;">Kondisi</th>
                <th style="width:24%;">Lokasi Penyimpanan</th>
                <th style="width:10%;">Tanggal Input</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alats as $i => $alat)
                @php
                    $badgeClass = match($alat->kondisi) {
                        'Baik' => 'badge-baik',
                        'Rusak Ringan' => 'badge-ringan',
                        'Perlu Perbaikan' => 'badge-perbaikan',
                        'Rusak Berat' => 'badge-berat',
                        default => '',
                    };
                @endphp
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $alat->nama_alat }}</td>
                    <td>{{ $alat->jenis }}</td>
                    <td><span class="badge {{ $badgeClass }}">{{ $alat->kondisi }}</span></td>
                    <td>{{ $alat->lokasi_penyimpanan }}</td>
                    <td>{{ $alat->created_at->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align:center;padding:14px;">Belum ada data.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">Dokumen ini dibuat secara otomatis oleh sistem SIMAK.</div>
</body>
</html>