
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Struk Parkir</title>

    <style>
        body {
            font-family: monospace;
            width: 280px;
            margin: 20px auto;
            color: #000;
        }

        hr {
            border: none;
            border-top: 1px dashed #000;
        }

        .center {
            text-align: center;
        }

        table {
            width: 100%;
        }

        td {
            padding: 3px 0;
            vertical-align: top;
        }

        .total {
            font-size: 16px;
        }

        button {
            padding: 8px 15px;
            cursor: pointer;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                margin: 0 auto;
            }
        }
    </style>
</head>

<body>

    <div class="center">
        <h3>STRUK PARKIR</h3>
        <p>
            {{ $transaksi->area->nama_area ?? 'Area belum ditentukan' }}
        </p>
    </div>

    <hr>

    <table>
        <tr>
            <td>Plat Nomor</td>
            <td>: {{ $transaksi->kendaraan->plat_nomor ?? '-' }}</td>
        </tr>

        <tr>
            <td>Jenis</td>
            <td>: {{ ucfirst($transaksi->kendaraan->jenis_kendaraan ?? '-') }}</td>
        </tr>

        <tr>
            <td>Masuk</td>
            <td>:
                {{ $transaksi->waktu_masuk
                    ? \Carbon\Carbon::parse($transaksi->waktu_masuk)->format('d-m-Y H:i')
                    : '-' }}
            </td>
        </tr>

        <tr>
            <td>Keluar</td>
            <td>:
                {{ $transaksi->waktu_keluar
                    ? \Carbon\Carbon::parse($transaksi->waktu_keluar)->format('d-m-Y H:i')
                    : '-' }}
            </td>
        </tr>

        <tr>
            <td>Durasi</td>
            <td>: {{ $transaksi->durasi_jam ?? 0 }} jam</td>
        </tr>

        <tr>
            <td>Tarif/jam</td>
            <td>:
                Rp{{ number_format($transaksi->tarif->tarif_per_jam ?? 0, 0, ',', '.') }}
            </td>
        </tr>
    </table>

    <hr>

    <div class="center total">
        <strong>
            TOTAL: Rp{{ number_format($transaksi->biaya_total ?? 0, 0, ',', '.') }}
        </strong>
    </div>

    <hr>

    <p class="center">
        Petugas: {{ $transaksi->petugas->nama_lengkap ?? '-' }}
        <br><br>
        Terima kasih telah menggunakan layanan parkir kami.
    </p>

    <div class="no-print center">
        <button onclick="window.print()">Cetak Struk</button>
        <br><br>
        <button onclick="window.location.href='{{ route('petugas.transaksi.index') }}'">
            Kembali
        </button>
    </div>

</body>
</html>
