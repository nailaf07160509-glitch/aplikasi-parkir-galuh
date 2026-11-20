
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Tarif Parkir</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="form-page">

    <div class="form-card">

        <div class="form-header">
            <h2>Tambah Tarif Parkir</h2>
          
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

        <form action="{{ route('admin.tarif.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="jenis_kendaraan">Jenis Kendaraan</label>

                <select name="jenis_kendaraan" id="jenis_kendaraan" required>
                    <option value="">-- Pilih Kendaraan --</option>

                    <option value="motor" {{ old('jenis_kendaraan') == 'motor' ? 'selected' : '' }}>
                        Motor
                    </option>

                    <option value="mobil" {{ old('jenis_kendaraan') == 'mobil' ? 'selected' : '' }}>
                        Mobil
                    </option>

                    <option value="lainnya" {{ old('jenis_kendaraan') == 'lainnya' ? 'selected' : '' }}>
                        Lainnya
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="tarif_per_jam">Tarif per Jam (Rp)</label>

                <input
                    type="number"
                    name="tarif_per_jam"
                    id="tarif_per_jam"
                    min="1"
                    value="{{ old('tarif_per_jam') }}"
                    placeholder="Contoh: 2000"
                    required
                >

               
            </div>

            <div class="form-buttons">
                <a href="{{ route('admin.tarif.index') }}" class="btn-back">
                    Kembali
                </a>

                <button type="submit">
                    Simpan Tarif
                </button>
            </div>

        </form>

    </div>

</div>

</body>
</html>
