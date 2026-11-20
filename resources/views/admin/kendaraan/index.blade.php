
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Kendaraan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="data-page">

    <div class="data-card">

        <div class="data-header">
            <div>
                <h2>Data Kendaraan Parkir</h2>
             
            </div>

            <a href="{{ route('admin.kendaraan.create') }}" class="btn-add">
                + Tambah Kendaraan
            </a>
        </div>

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <div class="data-table-wrapper">

            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Plat Nomor</th>
                        <th>Jenis Kendaraan</th>
                        <th>Warna</th>
                        <th>Pemilik</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($kendaraan as $i => $item)
                        <tr>
                            <td>{{ $kendaraan->firstItem() + $i }}</td>
                            <td>{{ $item->plat_nomor }}</td>
                            <td>{{ ucfirst($item->jenis_kendaraan) }}</td>
                            <td>{{ $item->warna }}</td>
                            <td>{{ $item->pemilik }}</td>

                            <td>
                                <div class="data-actions">

                                    <a class="btn-edit"
                                       href="{{ route('admin.kendaraan.edit', $item->id_kendaraan) }}">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.kendaraan.destroy', $item->id_kendaraan) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn-delete" type="submit">
                                            Hapus
                                        </button>

                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-data">
                                Belum ada data kendaraan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

        <div class="data-pagination">
            {{ $kendaraan->links() }}
        </div>

        <a class="data-back" href="{{ route('admin.dashboard') }}">
            ← Kembali ke Dashboard
        </a>

    </div>

</div>

</body>
</html>
