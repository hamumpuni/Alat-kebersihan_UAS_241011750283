<?php

namespace App\Http\Controllers;

use App\Models\AlatKebersihan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Halaman depan publik - menampilkan data alat kebersihan.
     */
    public function index(Request $request)
    {
        // Gunakan query builder untuk fleksibilitas filter
        $query = AlatKebersihan::query()->latest('id_alat');

        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        if ($request->filled('q')) {
            $query->where('nama_alat', 'like', '%' . $request->q . '%');
        }

        $alats = $query->paginate(8)->withQueryString();

        // Optimasi Statistik: Menggunakan satu query untuk performa lebih baik (jika datanya banyak)
        $stats = [
            'totalAlat'            => AlatKebersihan::count(),
            'totalBaik'            => AlatKebersihan::where('kondisi', 'Baik')->count(),
            'totalPerluPerhatian'  => AlatKebersihan::whereIn('kondisi', ['Rusak Ringan', 'Rusak Berat', 'Perlu Perbaikan'])->count(),
            'totalJenis'           => AlatKebersihan::distinct()->count('jenis'),
        ];

        return view('home.index', array_merge([
            'alats' => $alats,
            'jenisOptions' => AlatKebersihan::JENIS_OPTIONS,
        ], $stats));
    }

    /**
     * Halaman detail satu alat (publik).
     */
    public function detail($id)
    {
        // Menggunakan findOrFail sudah tepat jika route model binding tidak digunakan
        $alat = AlatKebersihan::findOrFail($id);

        // Mengambil produk terkait dengan filter yang tepat
        $terkait = AlatKebersihan::where('jenis', $alat->jenis)
            ->where('id_alat', '!=', $alat->id_alat)
            ->latest('id_alat')
            ->take(3)
            ->get();

        return view('home.detail', compact('alat', 'terkait'));
    }

    /**
     * Halaman Daftar Alat.
     */
   public function alat()
{
    $daftarAlat = AlatKebersihan::latest('id_alat')->get();

    return view('home.alat', compact('daftarAlat'));
}
    /**
     * Halaman Laporan Kondisi.
     */
    public function kondisi()
{
    $laporanKondisi = AlatKebersihan::latest('id_alat')->get();

    return view('home.kondisi', compact('laporanKondisi'));
}
public function kirimKontak(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'pesan' => 'required|string',
    ]);

    // Nanti bisa disimpan ke database atau dikirim email

    return back()->with('success', 'Pesan berhasil dikirim.');
}
}