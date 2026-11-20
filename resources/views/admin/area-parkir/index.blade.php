
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Area Parkir</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="data-page">

    <div class="data-card">

        <div class="data-header">
            <div>
                <h2>Data Area Parkir</h2>
          
            </div>

            <a href="{{ route('admin.area.create') }}" class="btn-add">
                + Tambah Area
            </a>
        </div>

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="data-table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Area</th>
                        <th>Kapasitas</th>
                        <th>Terisi</th>
                        <th>Sisa Kapasitas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($areas as $i => $item)
                        <tr>
                            <td>{{ $areas->firstItem() + $i }}</td>
                            <td>{{ $item->nama_area }}</td>
                            <td>{{ $item->kapasitas }} kendaraan</td>
                            <td>{{ $item->terisi }} kendaraan</td>
                            <td>
                                {{ max(0, $item->kapasitas - $item->terisi) }} kendaraan
                            </td>

                            <td>
                                <div class="data-actions">

                                    <a href="{{ route('admin.area.edit', $item->id_area) }}"
                                       class="btn-edit">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.area.destroy', $item->id_area) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin hapus area parkir ini?')">
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
                            <td colspan="6" class="empty-data">
                                Belum ada data area parkir.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="data-pagination">
            {{ $areas->links() }}
        </div>

        <a class="data-back" href="{{ route('admin.dashboard') }}">
            <- Kembali ke Dashboard
        </a>

    </div>

</div>

</body>
</html>
