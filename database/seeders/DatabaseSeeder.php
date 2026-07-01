<?php

namespace Database\Seeders;

use App\Models\AlatKebersihan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
       
        User::firstOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
            ]
        );

        // Beberapa data contoh agar tampilan publik & dashboard tidak kosong saat pertama dibuka
        $contoh = [
            ['nama_alat' => 'Vacuum Cleaner Karpet', 'jenis' => 'Peralatan Elektronik Kebersihan', 'kondisi' => 'Baik', 'lokasi_penyimpanan' => 'Gudang Lantai 1'],
            ['nama_alat' => 'Mop Pel Putar', 'jenis' => 'Alat Kebersihan Lantai', 'kondisi' => 'Baik', 'lokasi_penyimpanan' => 'Pantry Lantai 2'],
            ['nama_alat' => 'Cairan Pembersih Kaca', 'jenis' => 'Bahan Kimia & Cairan Pembersih', 'kondisi' => 'Baik', 'lokasi_penyimpanan' => 'Gudang Lantai 1'],
            ['nama_alat' => 'Sapu Lidi', 'jenis' => 'Alat Kebersihan Lantai', 'kondisi' => 'Rusak Ringan', 'lokasi_penyimpanan' => 'Ruang OB Lantai 3'],
            ['nama_alat' => 'Kain Microfiber', 'jenis' => 'Alat Kebersihan Kaca & Permukaan', 'kondisi' => 'Baik', 'lokasi_penyimpanan' => 'Gudang Lantai 2'],
            ['nama_alat' => 'Tempat Sampah Pedal', 'jenis' => 'Perlengkapan Sanitasi', 'kondisi' => 'Perlu Perbaikan', 'lokasi_penyimpanan' => 'Lobi Utama'],
        ];

        foreach ($contoh as $item) {
            AlatKebersihan::firstOrCreate(
                ['nama_alat' => $item['nama_alat']],
                $item
            );
        }
    }
}