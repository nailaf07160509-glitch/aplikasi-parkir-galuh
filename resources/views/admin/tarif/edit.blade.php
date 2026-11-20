
@extends('layouts.app')

@section('heading', 'Edit Tarif Parkir')
@section('subtitle', 'Perbarui informasi tarif parkir kendaraan')

@section('content')

<div class="tarif-form-page">

    <div class="tarif-form-card">

        <div class="tarif-form-header">
            <h3>Edit Tarif Parkir</h3>
           
        </div>

        <form action="{{ route('admin.tarif.update', ['tarif' => $tarif->id_tarif]) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Jenis Kendaraan</label>

                <select name="jenis_kendaraan" required>
                    <option value="motor" {{ old('jenis_kendaraan', $tarif->jenis_kendaraan) == 'motor' ? 'selected' : '' }}>
                        Motor
                    </option>

                    <option value="mobil" {{ old('jenis_kendaraan', $tarif->jenis_kendaraan) == 'mobil' ? 'selected' : '' }}>
                        Mobil
                    </option>

                    <option value="lainnya" {{ old('jenis_kendaraan', $tarif->jenis_kendaraan) == 'lainnya' ? 'selected' : '' }}>
                        Lainnya
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label>Tarif Per Jam (Rp)</label>

                <input
                    type="number"
                    name="tarif_per_jam"
                    min="1"
                    value="{{ old('tarif_per_jam', $tarif->tarif_per_jam) }}"
                    placeholder="Contoh: 2000"
                    required
                >

               
            </div>

            <div class="tarif-form-buttons">
                <a href="{{ route('admin.tarif.index') }}" class="tarif-btn-back">
                    Batal
                </a>

                <button type="submit">
                    Simpan Perubahan
                </button>
            </div>

        </form>

    </div>

</div>

@endsection
