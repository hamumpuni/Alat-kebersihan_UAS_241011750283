<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AlatKebersihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class AlatKebersihanController extends Controller
{
    /**
     * GET /admin/alat -> admin.alat.index
     */
    public function index()
    {
        $daftarAlat = AlatKebersihan::latest()->get();

        return view('admin.data-alat', compact('daftarAlat'));
    }

    /**
     * GET /admin/alat/create -> admin.alat.create
     */
    public function create()
    {
        return view('admin.data-alat-create');
    }

    /**
     * POST /admin/alat -> admin.alat.store
     * Setelah simpan, kembali ke dashboard supaya data langsung terlihat.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_alat'          => 'required|string|max:255',
            'jenis'              => 'required|string|in:' . implode(',', AlatKebersihan::JENIS_OPTIONS),
            'kondisi'            => 'required|string|in:' . implode(',', AlatKebersihan::KONDISI_OPTIONS),
            'lokasi_penyimpanan' => 'required|string|max:255',
            'gambar'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('alat-kebersihan', 'public');
        }

        AlatKebersihan::create($validated);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Data alat berhasil ditambahkan.');
    }

    /**
     * GET /admin/alat/{alat}/edit -> admin.alat.edit
     */
    public function edit(AlatKebersihan $alat)
    {
        return view('admin.data-alat-edit', compact('alat'));
    }

    /**
     * PUT /admin/alat/{alat} -> admin.alat.update
     */
    public function update(Request $request, AlatKebersihan $alat)
    {
        $validated = $request->validate([
            'nama_alat'          => 'required|string|max:255',
            'jenis'              => 'required|string|in:' . implode(',', AlatKebersihan::JENIS_OPTIONS),
            'kondisi'            => 'required|string|in:' . implode(',', AlatKebersihan::KONDISI_OPTIONS),
            'lokasi_penyimpanan' => 'required|string|max:255',
            'gambar'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($alat->gambar) {
                Storage::disk('public')->delete($alat->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('alat-kebersihan', 'public');
        }

        $alat->update($validated);

        return redirect()
            ->route('admin.alat.index')
            ->with('success', 'Data alat berhasil diperbarui.');
    }

    /**
     * DELETE /admin/alat/{alat} -> admin.alat.destroy
     */
    public function destroy(AlatKebersihan $alat)
    {
        if ($alat->gambar) {
            Storage::disk('public')->delete($alat->gambar);
        }

        $alat->delete();

        return back()->with('success', 'Data alat berhasil dihapus.');
    }

    /**
     * GET /admin/alat/export/pdf -> admin.alat.export
     * Membutuhkan package barryvdh/laravel-dompdf (composer require barryvdh/laravel-dompdf).
     */
    public function exportPdf()
    {
        $daftarAlat = AlatKebersihan::latest()->get();

        $pdf = Pdf::loadView('admin.data-alat-pdf', compact('daftarAlat'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('data-alat-kebersihan-' . now()->format('Y-m-d') . '.pdf');
    }
}