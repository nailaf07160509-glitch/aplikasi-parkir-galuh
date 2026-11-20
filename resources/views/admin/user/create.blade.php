
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah User</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="tarif-form-page">

    <div class="tarif-form-card">

        <div class="tarif-form-header">
            <h3>Tambah User</h3>
           
        </div>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="formUser" action="{{ route('admin.user.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input
                    type="text"
                    name="nama_lengkap"
                    id="nama_lengkap"
                    value="{{ old('nama_lengkap') }}"
                    placeholder="Masukkan nama lengkap"
                    required
                >
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input
                    type="text"
                    name="username"
                    id="username"
                    value="{{ old('username') }}"
                    placeholder="Masukkan username"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role" required>
                    <option value="">Pilih Role</option>

                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>

                    <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' }}>
                        Petugas
                    </option>

                    <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>
                        Owner
                    </option>
                </select>
            </div>

            <div class="tarif-form-buttons">
                <a href="{{ route('admin.user.index') }}" class="tarif-btn-back">
                    Kembali
                </a>

                <button type="submit" id="tombolSimpan">
                    Simpan
                </button>
            </div>

        </form>

    </div>

</div>

<script>
document.getElementById('formUser').addEventListener('submit', function () {
    const tombol = document.getElementById('tombolSimpan');

    if (this.dataset.submitted === 'true') {
        return;
    }

    this.dataset.submitted = 'true';
    tombol.disabled = true;
    tombol.textContent = 'Menyimpan...';
});
</script>

</body>
</html>
