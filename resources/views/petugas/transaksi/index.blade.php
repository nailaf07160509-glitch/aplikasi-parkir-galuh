
@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h3>Transaksi Parkir</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <a href="{{ route('petugas.transaksi.formMasuk') }}"
       class="btn btn-primary mb-3">
        + Catat Kendaraan Masuk
    </a>

    <h5>Kendaraan Sedang Parkir</h5>

    <div class="table-responsive mb-4">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Plat Nomor</th>
                    <th>Area</th>
                    <th>Waktu Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($transaksiAktif as $t)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ $t->kendaraan->plat_nomor ?? '-' }}
                        </td>

                        <td>
                            {{ $t->area->nama_area ?? 'Belum ditentukan' }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($t->waktu_masuk)->format('d-m-Y H:i') }}
                        </td>

                        <td>
                            <a href="{{ route('petugas.transaksi.formKeluar', $t->id_parkir) }}"
                               class="btn btn-warning btn-sm">
                                Keluar
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            Tidak ada kendaraan yang sedang parkir.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <hr>

    <h5>Riwayat Kendaraan Keluar</h5>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Plat Nomor</th>
                    <th>Area</th>
                    <th>Waktu Keluar</th>
                    <th>Total Biaya</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($riwayatKeluar as $t)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ $t->kendaraan->plat_nomor ?? '-' }}
                        </td>

                        <td>
                            {{ $t->area->nama_area ?? 'Belum ditentukan' }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($t->waktu_keluar)->format('d-m-Y H:i') }}
                        </td>

                        <td>
                            Rp{{ number_format($t->biaya_total, 0, ',', '.') }}
                        </td>

                        <td>
                            <span class="badge bg-success">
                                Sudah Keluar
                            </span>
                        </td>

                        <td>
                            <a href="{{ route('petugas.transaksi.struk', $t->id_parkir) }}"
                               class="btn btn-primary btn-sm">
                                Cetak Struk
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            Belum ada riwayat kendaraan keluar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <a class="back" href="{{ route('petugas.dashboard') }}">
            ← Kembali ke Dashboard
        </a>
    </div>

</div>

@endsection
