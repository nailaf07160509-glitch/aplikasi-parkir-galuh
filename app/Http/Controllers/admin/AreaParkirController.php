<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AreaParkir;


class AreaParkirController extends Controller
{
    public function index()
    {
        $areas = AreaParkir::latest()->paginate(10);

        return view('admin.area-parkir.index', compact('areas'));
    }

    public function create()
    {
        return view('admin.area-parkir.create');
    }

public function store(Request $request)
{
    $request->validate([
        'nama_area' => 'required|string|max:100',
        'kapasitas' => 'required|integer|min:1',
    ]);

    AreaParkir::create([
        'nama_area' => $request->nama_area,
        'kapasitas' => $request->kapasitas,
        'terisi' => 0,
    ]);

    return redirect()
        ->route('admin.area.index')
        ->with('success', 'Area parkir berhasil ditambahkan.');
}
    public function edit(AreaParkir $area)
    {
        return view('admin.area-parkir.edit', compact('area'));
    }

    public function update(Request $request, AreaParkir $area)
{
    $request->validate([
        'nama_area' => 'required|string|max:100',
        'kapasitas' => 'required|integer|min:1',
    ]);

    if ($request->kapasitas < $area->terisi) {
        return back()
            ->withInput()
            ->withErrors([
                'kapasitas' => 'Kapasitas tidak boleh lebih kecil dari jumlah kendaraan yang sedang parkir.',
            ]);
    }

    $area->update([
        'nama_area' => $request->nama_area,
        'kapasitas' => $request->kapasitas,
    ]);

    return redirect()
        ->route('admin.area.index')
        ->with('success', 'Area parkir berhasil diperbarui.');
}
    public function destroy(AreaParkir $area)
    {
        if ($area->terisi > 0) {
            return back()->with('error', 'Area tidak dapat dihapus karena masih ada kendaraan yang parkir.');
        }

        $area->delete();

        return redirect()
            ->route('admin.area.index')
            ->with('success', 'Area parkir berhasil dihapus.');
    }
}
