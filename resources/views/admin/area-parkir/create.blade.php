
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Area Parkir</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="form-page">

    <div class="form-card">

        <div class="form-header">
            <h2>Tambah Area Parkir</h2> 
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

        <form action="{{ route('admin.area.store') }}"
              method="POST"
              id="formArea">

            @csrf

            <div class="form-group">
                <label>Nama Area</label>
                <input type="text"
                       name="nama_area"
                       placeholder="Contoh: Area A"
                       value="{{ old('nama_area') }}"
                       required>
            </div>

            <div class="form-group">
                <label>Kapasitas Parkir</label>
                <input type="number"
                       name="kapasitas"
                       placeholder="Masukkan jumlah kapasitas"
                       min="1"
                       value="{{ old('kapasitas') }}"
                       required>
                
            </div>

            <div class="form-buttons">
                <a href="{{ route('admin.area.index') }}" class="btn-back">
                    Kembali
                </a>

                <button type="submit" id="tombolSimpan">
                    Simpan Area
                </button>
            </div>

        </form>

    </div>

</div>

<script>
document.getElementById('formArea').addEventListener('submit', function (event) {
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
