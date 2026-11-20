
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pengguna</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="container">
    <h2>Tambah Pengguna</h2>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('admin.pengguna.store') }}" method="POST">
        @csrf

        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap"
               value="{{ old('nama_lengkap') }}" required>

        <label>Username</label>
        <input type="text" name="username"
               value="{{ old('username') }}" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Role</label>
        <select name="role" required>
            <option value="">-- Pilih Role --</option>
            <option value="admin">Admin</option>
            <option value="petugas">Petugas</option>
            <option value="owner">Owner</option>
        </select>

        <button type="submit">Simpan</button>
        <a href="{{ route('admin.pengguna.index') }}">Kembali</a>
    </form>
</div>
</body>
</html>
