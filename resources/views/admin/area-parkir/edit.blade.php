
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Area Parkir</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="form-page">

    <div class="form-card">

        <div class="form-header">
            <h2>Edit Area Parkir</h2>
          
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

        <form action="{{ route('admin.area.update', $area->id_area) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Area</label>
                <input type="text"
                       name="nama_area"
                       placeholder="Contoh: Area A"
                       value="{{ old('nama_area', $area->nama_area) }}"
                       required>
            </div>

            <div class="form-group">
                <label>Kapasitas Parkir</label>
                <input type="number"
                       name="kapasitas"
                       placeholder="Masukkan jumlah kapasitas"
                       value="{{ old('kapasitas', $area->kapasitas) }}"
                       min="1"
                       required>
            
            </div>

            <div class="form-buttons">
                <a href="{{ route('admin.area.index') }}" class="btn-back">
                    Kembali
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
