<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Kendaraan;
use App\Models\Tarif;
use App\Models\AreaParkir;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    // Daftar kendaraan aktif dan riwayat kendaraan keluar
    public function index()
    {
        $transaksiAktif = Transaksi::with(['kendaraan', 'area'])
            ->where('status', 'masuk')
            ->latest()
            ->get();

        $riwayatKeluar = Transaksi::with(['kendaraan', 'area'])
            ->where('status', 'keluar')
            ->latest()
            ->get();

        return view(
            'petugas.transaksi.index',
            compact('transaksiAktif', 'riwayatKeluar')
        );
    }

    // Form kendaraan masuk
    public function formMasuk()
    {
        $kendaraans = Kendaraan::orderBy('plat_nomor')->get();

        $tarifs = Tarif::orderBy('id_tarif')->get();

        $areas = AreaParkir::orderBy('id_area')->get();

        return view(
            'petugas.transaksi.formMasuk',
            compact('kendaraans', 'tarifs', 'areas')
        );
    }

    // Proses kendaraan masuk
    public function prosesMasuk(Request $request)
    {
        $request->validate([
            'id_kendaraan' => 'required|exists:tb_kendaraan,id_kendaraan',
            'id_area' => 'required|exists:tb_area_parkir,id_area',
        ]);

        $hasil = DB::transaction(function () use ($request) {

            // Mengunci data kendaraan
            $kendaraan = Kendaraan::where(
                'id_kendaraan',
                $request->id_kendaraan
            )->lockForUpdate()->firstOrFail();

            // Memeriksa kendaraan yang masih parkir
            $sudahMasuk = Transaksi::where(
                'id_kendaraan',
                $kendaraan->id_kendaraan
            )
                ->where('status', 'masuk')
                ->exists();

            if ($sudahMasuk) {
                return 'sudah_masuk';
            }

            // Mencari tarif otomatis sesuai jenis kendaraan
            $jenis = strtolower(trim($kendaraan->jenis_kendaraan));

            $tarif = Tarif::whereRaw(
                'LOWER(TRIM(jenis_kendaraan)) = ?',
                [$jenis]
            )
                ->orderBy('id_tarif')
                ->lockForUpdate()
                ->first();

            if (!$tarif) {
                return 'tarif_tidak_ada';
            }

            // Mengambil area sesuai pilihan petugas
            $area = AreaParkir::where(
                'id_area',
                $request->id_area
            )
                ->lockForUpdate()
                ->first();

            if (!$area) {
                return 'area_tidak_ada';
            }

            // Memeriksa kapasitas area
            if ($area->terisi >= $area->kapasitas) {
                return 'area_penuh';
            }

            // Menyimpan transaksi kendaraan masuk
            Transaksi::create([
                'id_kendaraan' => $kendaraan->id_kendaraan,
                'waktu_masuk' => now(),
                'waktu_keluar' => null,
                'id_tarif' => $tarif->id_tarif,
                'durasi_jam' => 0,
                'biaya_total' => 0,
                'status' => 'masuk',
                'id_user' => auth()->id(),
                'id_area' => $area->id_area,
            ]);

            // Menambah jumlah kendaraan di area parkir
            $area->increment('terisi');

            // Mencatat aktivitas petugas
            LogAktivitas::create([
                'id_user' => auth()->id(),
                'aktivitas' => 'Mencatat kendaraan masuk',
                'waktu_aktivitas' => now(),
            ]);

            return 'berhasil';
        });

        if ($hasil === 'sudah_masuk') {
            return back()
                ->withInput()
                ->with('error', 'Kendaraan ini masih tercatat parkir.');
        }

        if ($hasil === 'tarif_tidak_ada') {
            return back()
                ->withInput()
                ->with('error', 'Tarif untuk jenis kendaraan ini belum tersedia.');
        }

        if ($hasil === 'area_tidak_ada') {
            return back()
                ->withInput()
                ->with('error', 'Area parkir tidak ditemukan.');
        }

        if ($hasil === 'area_penuh') {
            return back()
                ->withInput()
                ->with('error', 'Area parkir yang dipilih sudah penuh.');
        }

        return redirect()
            ->route('petugas.transaksi.index')
            ->with('success', 'Kendaraan berhasil dicatat masuk.');
    }

    // Form konfirmasi kendaraan keluar
    public function formKeluar($id)
    {
        $transaksi = Transaksi::with([
            'kendaraan',
            'tarif',
            'area'
        ])->findOrFail($id);

        if ($transaksi->status !== 'masuk') {
            return redirect()
                ->route('petugas.transaksi.index')
                ->with('error', 'Kendaraan ini sudah keluar.');
        }

        $waktuMasuk = Carbon::parse($transaksi->waktu_masuk);
        $waktuSekarang = now();

        $durasiJam = max(
            1,
            (int) ceil($waktuMasuk->diffInMinutes($waktuSekarang) / 60)
        );

        $biaya = $durasiJam * $transaksi->tarif->tarif_per_jam;

        return view(
            'petugas.transaksi.formKeluar',
            compact('transaksi', 'durasiJam', 'biaya')
        );
    }

    // Proses konfirmasi kendaraan keluar
    public function prosesKeluar(Request $request, $id)
    {
        $hasil = DB::transaction(function () use ($id) {

            $transaksi = Transaksi::with(['tarif', 'area'])
                ->where('id_parkir', $id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($transaksi->status !== 'masuk') {
                return false;
            }

            $waktuMasuk = Carbon::parse($transaksi->waktu_masuk);
            $waktuKeluar = now();

            $durasiJam = max(
                1,
                (int) ceil($waktuMasuk->diffInMinutes($waktuKeluar) / 60)
            );

            $biaya = $durasiJam * $transaksi->tarif->tarif_per_jam;

            $transaksi->update([
                'waktu_keluar' => $waktuKeluar,
                'durasi_jam' => $durasiJam,
                'biaya_total' => $biaya,
                'status' => 'keluar',
            ]);

            // Mengurangi jumlah kendaraan di area parkir
            if ($transaksi->area && $transaksi->area->terisi > 0) {
                $transaksi->area->decrement('terisi');
            }

            // Mencatat aktivitas petugas
            LogAktivitas::create([
                'id_user' => auth()->id(),
                'aktivitas' => 'Mencatat kendaraan keluar',
                'waktu_aktivitas' => now(),
            ]);

            return true;
        });

        if (!$hasil) {
            return redirect()
                ->route('petugas.transaksi.index')
                ->with('error', 'Kendaraan ini sudah diproses keluar.');
        }

        return redirect()
            ->route('petugas.transaksi.index')
            ->with(
                'success',
                'Kendaraan berhasil keluar. Struk dapat dicetak melalui riwayat transaksi.'
            );
    }

    // Halaman cetak struk
    public function cetakStruk($id)
    {
        $transaksi = Transaksi::with([
            'kendaraan',
            'tarif',
            'area',
            'petugas'
        ])->findOrFail($id);

        return view(
            'petugas.transaksi.struk',
            compact('transaksi')
        );
    }
}
