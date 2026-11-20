<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function dashboard(Request $request)
    {
        // Total seluruh transaksi
        $totalTransaksi = Transaksi::count();

        // Kendaraan yang masih parkir
        $kendaraanParkir = Transaksi::where('status', 'masuk')->count();

        // Pendapatan hari ini
        $pendapatanHariIni = Transaksi::where('status', 'keluar')
            ->whereDate('waktu_keluar', today())
            ->sum('biaya_total');

        // Rekap transaksi yang sudah keluar
        $query = Transaksi::with(['kendaraan', 'area'])
            ->where('status', 'keluar');

        // Filter tanggal
        if ($request->filled('dari')) {
            $query->whereDate('waktu_keluar', '>=', $request->dari);
        }

        if ($request->filled('sampai')) {
            $query->whereDate('waktu_keluar', '<=', $request->sampai);
        }

        // Total pendapatan berdasarkan filter
        $totalPendapatan = (clone $query)->sum('biaya_total');

        // Data transaksi
       // Data transaksi
$transaksis = $query
    ->latest('waktu_keluar')
    ->paginate(15)
    ->withQueryString();

return view('owner.dashboard', compact(
    'totalTransaksi',
    'kendaraanParkir',
    'pendapatanHariIni',
    'totalPendapatan',
    'transaksis'

        ));
    }
}
