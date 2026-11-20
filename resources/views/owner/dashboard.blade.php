
@extends('layouts.app')

@section('title', 'Dashboard Owner')

@section('content')

<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="owner-dashboard">

    <h2 class="dashboard-title">Dashboard Owner</h2>

    <p class="dashboard-subtitle">
        Selamat datang, {{ auth()->user()->nama_lengkap }}.
    </p>

    {{-- KARTU DASHBOARD --}}

    <div class="owner-cards">

        <div class="owner-card">
            <h3>Total Transaksi</h3>
            <div class="angka">{{ $totalTransaksi ?? 0 }}</div>
        </div>

        <div class="owner-card">
            <h3>Kendaraan Parkir</h3>
            <div class="angka">{{ $kendaraanParkir ?? 0 }}</div>
        </div>

        <div class="owner-card">
            <h3>Pendapatan Hari Ini</h3>
            <div class="angka">
                Rp{{ number_format($pendapatanHariIni ?? 0, 0, ',', '.') }}
            </div>
        </div>

    </div>

    {{-- REKAP TRANSAKSI --}}

    <div class="rekap-box">

        <h3 class="rekap-title">Rekap Transaksi Parkir</h3>

        {{-- FILTER TANGGAL --}}

        <form method="GET"
              action="{{ route('owner.dashboard') }}"
              class="owner-filter">

            <div class="filter-item">
                <label>Dari Tanggal</label>
                <input type="date"
                       name="dari"
                       value="{{ request('dari') }}">
            </div>

            <div class="filter-item">
                <label>Sampai Tanggal</label>
                <input type="date"
                       name="sampai"
                       value="{{ request('sampai') }}">
            </div>

            <div class="filter-buttons">
                <button type="submit" class="btn-filter">Filter</button>

                <a href="{{ route('owner.dashboard') }}"
                   class="btn-reset">Reset</a>
            </div>

        </form>

        {{-- TOTAL PENDAPATAN --}}

        <div class="pendapatan">
            Total Pendapatan:
            <strong>
                Rp{{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}
            </strong>
        </div>

        {{-- TABEL TRANSAKSI --}}

        <div class="table-responsive">

            <table class="owner-table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Plat Nomor</th>
                        <th>Area</th>
                        <th>Masuk</th>
                        <th>Keluar</th>
                        <th>Durasi</th>
                        <th>Biaya</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($transaksis as $t)

                    <tr>
                        <td>{{ $transaksis->firstItem() + $loop->index }}</td>
                        <td>{{ $t->kendaraan->plat_nomor ?? '-' }}</td>
                        <td>{{ $t->area->nama_area ?? '-' }}</td>

                        <td>
                            {{ $t->waktu_masuk
                                ? \Carbon\Carbon::parse($t->waktu_masuk)->format('d-m-Y H:i')
                                : '-' }}
                        </td>

                        <td>
                            {{ $t->waktu_keluar
                                ? \Carbon\Carbon::parse($t->waktu_keluar)->format('d-m-Y H:i')
                                : '-' }}
                        </td>

                        <td>{{ $t->durasi_jam ?? 0 }} jam</td>

                        <td>
                            Rp{{ number_format($t->biaya_total ?? 0, 0, ',', '.') }}
                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="7" class="empty-data">
                            Belum ada transaksi.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="owner-pagination">
            {{ $transaksis->links() }}
        </div>

    </div>

</div>

@endsection
