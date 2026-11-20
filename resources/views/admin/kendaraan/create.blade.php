
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Kendaraan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="form-page">

    <div class="form-card">

        <div class="form-header">
            <h2>Tambah Kendaraan Parkir</h2>
       
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

        <form action="{{ route('admin.kendaraan.store') }}"
              method="POST"
              id="formKendaraan">

            @csrf

            <div class="form-group">
                <label>Plat Nomor</label>
                <input
                    type="text"
                    name="plat_nomor"
                    placeholder="Contoh: B 1234 ABC"
                    value="{{ old('plat_nomor') }}"
                    required
                >
            </div>

            <div class="form-group">
                <label>Jenis Kendaraan</label>
                <select name="jenis_kendaraan" required>
                    <option value="">-- Pilih Jenis Kendaraan --</option>
                    <option value="motor" {{ old('jenis_kendaraan') == 'motor' ? 'selected' : '' }}>Motor</option>
                    <option value="mobil" {{ old('jenis_kendaraan') == 'mobil' ? 'selected' : '' }}>Mobil</option>
                    <option value="lainnya" {{ old('jenis_kendaraan') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>

            <div class="form-group">
                <label>Warna Kendaraan</label>
                <input
                    type="text"
                    name="warna"
                    placeholder="Contoh: Hitam"
                    value="{{ old('warna') }}"
                    required
                >
            </div>

            <div class="form-group">
                <label>Nama Pemilik</label>
                <input
                    type="text"
                    name="pemilik"
                    placeholder="Masukkan nama pemilik"
                    value="{{ old('pemilik') }}"
                    required
                >
            </div>

            <div class="form-buttons">
                <a href="{{ route('admin.kendaraan.index') }}" class="btn-back">
                    Kembali
                </a>

                <button type="submit" id="tombolSimpan">
                    Simpan Kendaraan
                </button>
            </div>

        </form>

    </div>

</div>

<script>
document.getElementById('formKendaraan').addEventListener('submit', function (event) {
    const tombol = document.getElementById('tombolSimpan');

    if (this.dataset.submitted === 'true') {
        event.preventDefault();
        return;
    }

    this.dataset.submitted = 'true';
    tombol.disabled = true;
    tombol.innerText = 'Menyimpan...';
});
</script>

</body>
</html>
