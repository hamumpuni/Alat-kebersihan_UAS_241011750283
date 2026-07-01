<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AlatKebersihan;

class DashboardController extends Controller
{
    /**
     * GET /admin/dashboard -> admin.dashboard
     */
    public function index()
    {
        $totalAlat      = AlatKebersihan::count();
        $kondisiBaik    = AlatKebersihan::where('kondisi', 'Baik')->count();
        $rusakRingan    = AlatKebersihan::where('kondisi', 'Rusak Ringan')->count();
        $perluPerbaikan = AlatKebersihan::where('kondisi', 'Perlu Perbaikan')->count();
        $rusakBerat     = AlatKebersihan::where('kondisi', 'Rusak Berat')->count();

        $alatTerbaru = AlatKebersihan::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalAlat', 'kondisiBaik', 'rusakRingan', 'perluPerbaikan', 'rusakBerat', 'alatTerbaru'
        ));
    }
}