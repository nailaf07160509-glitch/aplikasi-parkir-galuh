
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Kendaraan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="form-page">

    <div class="form-card">

        <div class="form-header">
            <h2>Edit Kendaraan</h2>
       
        </div>

        @if($errors->any())
            <div class="error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.kendaraan.update', $kendaraan->id_kendaraan) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Plat Nomor</label>
                <input
                    type="text"
                    name="plat_nomor"
                    placeholder="Contoh: B 1234 ABC"
                    value="{{ old('plat_nomor', $kendaraan->plat_nomor) }}"
                    required
                >
            </div>

            <div class="form-group">
                <label>Jenis Kendaraan</label>
                <select name="jenis_kendaraan" required>
                    <option value="">-- Pilih Jenis Kendaraan --</option>

                    <option value="motor" {{ old('jenis_kendaraan', $kendaraan->jenis_kendaraan) == 'motor' ? 'selected' : '' }}>
                        Motor
                    </option>

                    <option value="mobil" {{ old('jenis_kendaraan', $kendaraan->jenis_kendaraan) == 'mobil' ? 'selected' : '' }}>
                        Mobil
                    </option>

                    <option value="lainnya" {{ old('jenis_kendaraan', $kendaraan->jenis_kendaraan) == 'lainnya' ? 'selected' : '' }}>
                        Lainnya
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label>Warna Kendaraan</label>
                <input
                    type="text"
                    name="warna"
                    placeholder="Contoh: Hitam"
                    value="{{ old('warna', $kendaraan->warna) }}"
                    required
                >
            </div>

            <div class="form-group">
                <label>Nama Pemilik</label>
                <input
                    type="text"
                    name="pemilik"
                    placeholder="Masukkan nama pemilik"
                    value="{{ old('pemilik', $kendaraan->pemilik) }}"
                    required
                >
            </div>

            <div class="form-buttons">
                <a href="{{ route('admin.kendaraan.index') }}" class="btn-back">
                    Batal
                </a>

                <button type="submit">
                    Simpan Perubahan
                </button>
            </div>

        </form>

    </div>

</div>

</body>
</html>
