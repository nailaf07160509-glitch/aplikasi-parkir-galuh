
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data User</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="data-page">

    <div class="data-card">

        <div class="data-header">
            <div>
                <h2>Data User</h2>
                <p>Kelola akun Admin, Petugas, dan Owner.</p>
            </div>

            <a href="{{ route('admin.user.create') }}" class="btn-add">
                + Tambah User
            </a>
        </div>

        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        @if (session('error'))
            <p class="error">{{ session('error') }}</p>
        @endif

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
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($users as $i => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $i }}</td>

                            <td>{{ $user->nama_lengkap }}</td>

                            <td>{{ $user->username }}</td>

                            <td>
                                <span class="user-role">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            <td>
                                @if ($user->status_aktif)
                                    <span class="user-status-active">Aktif</span>
                                @else
                                    <span class="user-status-inactive">Nonaktif</span>
                                @endif
                            </td>

                            <td>
                                <div class="data-actions">

                                    <a
                                        href="{{ route('admin.user.edit', $user->id_user) }}"
                                        class="btn-edit">
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.user.destroy', $user->id_user) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus user ini?')">

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
                                Belum ada data user.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

        <div class="data-pagination">
            {{ $users->links() }}
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
