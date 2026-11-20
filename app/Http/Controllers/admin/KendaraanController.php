<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kendaraan;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraan = Kendaraan::orderBy('id_kendaraan', 'desc')->paginate(10);

        return view('admin.kendaraan.index', compact('kendaraan'));
    }

    public function create()
    {
        return view('admin.kendaraan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'plat_nomor' => 'required|string|max:15',
            'jenis_kendaraan' => 'required|string',
            'warna' => 'required|string|max:20',
            'pemilik' => 'required|string|max:100',
        ]);

        Kendaraan::create([
            'plat_nomor' => strtoupper(trim($request->plat_nomor)),
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'warna' => $request->warna,
            'pemilik' => $request->pemilik,
            'id_user' => auth()->user()->id_user,
        ]);

        return redirect()
            ->route('admin.kendaraan.index')
            ->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function edit(Kendaraan $kendaraan)
    {
        return view('admin.kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, Kendaraan $kendaraan)
    {
        $request->validate([
            'plat_nomor' => 'required|string|max:15|unique:tb_kendaraan,plat_nomor,' . $kendaraan->id_kendaraan . ',id_kendaraan',
            'jenis_kendaraan' => 'required|in:motor,mobil,lainnya',
            'warna' => 'nullable|string|max:20',
            'pemilik' => 'required|string|max:100',
        ]);

        $kendaraan->update([
            'plat_nomor' => strtoupper(trim($request->plat_nomor)),
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'warna' => $request->warna,
            'pemilik' => $request->pemilik,
        ]);

        return redirect()
            ->route('admin.kendaraan.index')
            ->with('success', 'Data kendaraan berhasil diperbarui.');
    }

    public function destroy(Kendaraan $kendaraan)
    {
        $kendaraan->delete();

        return redirect()
            ->route('admin.kendaraan.index')
            ->with('success', 'Data kendaraan berhasil dihapus.');
    }
}
