
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pengguna</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="container">
    <h2>Data Pengguna</h2>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('admin.pengguna.create') }}">+ Tambah Pengguna</a>

    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Role</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengguna as $item)
                <tr>
                    <td>{{ $loop->iteration + ($pengguna->currentPage() - 1) * $pengguna->perPage() }}</td>
                    <td>{{ $item->nama_lengkap }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ ucfirst($item->role) }}</td>
                    <td>{{ $item->status_aktif ? 'Aktif' : 'Nonaktif' }}</td>
                    <td>
                        <a href="{{ route('admin.pengguna.edit', $item->id_user) }}">Edit</a>

                        <form action="{{ route('admin.pengguna.destroy', $item->id_user) }}"
                              method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Yakin ingin menghapus pengguna ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada data pengguna.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $pengguna->links() }}
</div>
</body>
</html>
