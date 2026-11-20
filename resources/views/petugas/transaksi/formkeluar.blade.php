
@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h3>Konfirmasi Kendaraan Keluar</h3>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <table class="table table-bordered w-50">
        <tr>
            <th>Plat Nomor</th>
            <td>{{ $transaksi->kendaraan->plat_nomor }}</td>
        </tr>

        <tr>
            <th>Waktu Masuk</th>
            <td>
                {{ \Carbon\Carbon::parse($transaksi->waktu_masuk)->format('d-m-Y H:i') }}
            </td>
        </tr>

        <tr>
            <th>Durasi Parkir</th>
            <td>{{ $durasiJam }} jam</td>
        </tr>

        <tr>
            <th>Total Biaya</th>
            <td>
                <strong>
                    Rp{{ number_format($biaya, 0, ',', '.') }}
                </strong>
            </td>
        </tr>
    </table>

    <div class="mt-3">
        <p>Apakah Anda yakin ingin mengonfirmasi kendaraan keluar?</p>

        <form method="POST"
              action="{{ route('petugas.transaksi.prosesKeluar', $transaksi->id_parkir) }}">

            @csrf

            <button type="submit" class="btn btn-success">
                Konfirmasi Keluar
            </button>

            <a href="{{ route('petugas.transaksi.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>
    </div>

</div>

@endsection
