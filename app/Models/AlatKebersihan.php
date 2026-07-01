<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlatKebersihan extends Model
{
    protected $table = 'alat_kebersihans';
    protected $primaryKey = 'id_alat';

    // TAMBAHAN PENTING: Buka komentar di bawah ini JIKA 'id_alat' di database kamu 
    // berupa teks/kombinasi huruf (misalnya "ALT-001"), bukan angka auto-increment.
    // public $incrementing = false;
    // protected $keyType = 'string';

    protected $fillable = [
        'gambar',
        'nama_alat',
        'jenis',
        'kondisi',
        'lokasi_penyimpanan',
    ];

    /**
     * Pilihan jenis alat - dipakai di form create/edit & filter.
     */
    public const JENIS_OPTIONS = [
        'Alat Kebersihan Lantai',
        'Alat Kebersihan Kaca & Permukaan',
        'Bahan Kimia & Cairan Pembersih',
        'Peralatan Elektronik Kebersihan',
        'Perlengkapan Sanitasi',
        'Lainnya',
    ];

    /**
     * Pilihan kondisi alat - dipakai di form create/edit & badge status.
     */
    public const KONDISI_OPTIONS = [
        'Baik',
        'Rusak Ringan',
        'Rusak Berat',
        'Perlu Perbaikan',
    ];

    /**
     * Warna badge bootstrap berdasarkan kondisi, dipakai di view.
     */
    public static function badgeKondisi(string $kondisi): string
    {
        return match ($kondisi) {
            'Baik' => 'success',
            'Rusak Ringan' => 'warning',
            'Perlu Perbaikan' => 'info',
            'Rusak Berat' => 'danger',
            default => 'secondary',
        };
    }
    public function getRouteKeyName()
   {
       return 'id_alat';
   }
}