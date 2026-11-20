
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pengguna</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="container">
    <h2>Edit Pengguna</h2>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('admin.pengguna.update', $user->id_user) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap"
               value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required>

        <label>Username</label>
        <input type="text" name="username"
               value="{{ old('username', $user->username) }}" required>

        <label>Password Baru</label>
        <input type="password" name="password"
               placeholder="Kosongkan jika tidak diganti">

        <label>Role</label>
        <select name="role" required>
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
            <option value="owner" {{ $user->role == 'owner' ? 'selected' : '' }}>Owner</option>
        </select>

        <label>Status</label>
        <select name="status_aktif" required>
            <option value="1" {{ $user->status_aktif == 1 ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ $user->status_aktif == 0 ? 'selected' : '' }}>Nonaktif</option>
        </select>

        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('admin.pengguna.index') }}">Kembali</a>
    </form>
</div>
</body>
</html>
