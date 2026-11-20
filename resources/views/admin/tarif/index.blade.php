
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Tarif Parkir</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="data-page">

    <div class="data-card">

        <div class="data-header">
            <div>
                <h2>Data Tarif Parkir</h2>
              
            </div>

            <a href="{{ route('admin.tarif.create') }}" class="btn-add">
                + Tambah Tarif
            </a>
        </div>

        @if ($errors->any())
            <ul class="error">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="data-table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Jenis Kendaraan</th>
                        <th>Tarif per Jam</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($tarif as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>{{ ucfirst($item->jenis_kendaraan) }}</td>

                            <td>
                                Rp {{ number_format($item->tarif_per_jam, 0, ',', '.') }}
                            </td>

                            <td>
                                <div class="data-actions">

                                    <a
                                        href="{{ route('admin.tarif.edit', $item->id_tarif) }}"
                                        class="btn-edit">
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.tarif.destroy', $item->id_tarif) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus tarif ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn-delete">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="4" class="empty-data">
                                Belum ada data tarif parkir.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="data-back">
            <a href="{{ route('admin.dashboard') }}">
                ← Kembali ke Dashboard
            </a>
        </div>

    </div>

</div>

</body>
</html>
