
@extends('layouts.app')

@section('content')

<div class="container form-wrapper">

    <div class="form-header">
        <h3>Catat Kendaraan Masuk</h3>
    </div>

    <div class="form-card">

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST"
              action="{{ route('petugas.transaksi.prosesMasuk') }}"
              id="formMasuk">

            @csrf

            <div class="mb-4">
                <label class="form-label">Kendaraan</label>

                <select name="id_kendaraan"
                        id="kendaraan"
                        class="form-select"
                        required>

                    <option value="">-- Pilih Kendaraan --</option>

                    @foreach($kendaraans as $k)
                        <option
                            value="{{ $k->id_kendaraan }}"
                            data-jenis="{{ strtolower($k->jenis_kendaraan) }}"
                            {{ old('id_kendaraan') == $k->id_kendaraan ? 'selected' : '' }}>

                            {{ $k->plat_nomor }} -
                            {{ $k->pemilik }} -
                            {{ ucfirst($k->jenis_kendaraan) }}

                        </option>
                    @endforeach

                </select>
            </div>

            <div class="mb-4">
                <label class="form-label">Tarif Parkir</label>

                <input type="text"
                       id="tampilanTarif"
                       class="form-control"
                       value="Pilih kendaraan terlebih dahulu"
                       readonly>

                <input type="hidden" name="id_tarif" id="id_tarif">
            </div>

            <div class="mb-4">
                <label class="form-label">Area Parkir</label>

                <select name="id_area"
                        id="area"
                        class="form-select"
                        required>

                    <option value="">-- Pilih Area Parkir --</option>

                    @foreach($areas as $a)
                        <option
                            value="{{ $a->id_area }}"
                            {{ old('id_area') == $a->id_area ? 'selected' : '' }}
                            {{ $a->terisi >= $a->kapasitas ? 'disabled' : '' }}>

                            {{ $a->nama_area }}
                            (Terisi: {{ $a->terisi }}/{{ $a->kapasitas }})

                            @if($a->terisi >= $a->kapasitas)
                                - Penuh
                            @endif

                        </option>
                    @endforeach

                </select>

             
            </div>

            <hr>

            <div class="d-flex flex-wrap gap-2 mt-4">

                <button type="submit"
                        id="tombolSimpanMasuk"
                        class="btn btn-simpan"
                        disabled>
                    Simpan Kendaraan Masuk
                </button>

                <a href="{{ route('petugas.transaksi.index') }}"
                   class="btn btn-secondary btn-kembali">
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@php
    $daftarTarif = $tarifs->map(function ($t) {
        return [
            'id' => $t->id_tarif,
            'jenis' => strtolower($t->jenis_kendaraan),
            'harga' => $t->tarif_per_jam
        ];
    })->values();
@endphp

<script>
const daftarTarif = @json($daftarTarif);

const kendaraan = document.getElementById('kendaraan');
const area = document.getElementById('area');
const tampilanTarif = document.getElementById('tampilanTarif');
const idTarif = document.getElementById('id_tarif');
const tombol = document.getElementById('tombolSimpanMasuk');
const form = document.getElementById('formMasuk');

function tampilkanInformasi() {

    const pilihan = kendaraan.options[kendaraan.selectedIndex];

    idTarif.value = '';

    if (!pilihan || !pilihan.value) {
        tampilanTarif.value = 'Pilih kendaraan terlebih dahulu';
        tombol.disabled = true;
        return;
    }

    const jenis = pilihan.dataset.jenis;

    const tarif = daftarTarif.find(t => t.jenis === jenis);

    if (tarif) {
        tampilanTarif.value =
            'Rp' + Number(tarif.harga).toLocaleString('id-ID') + ' / jam';

        idTarif.value = tarif.id;
    } else {
        tampilanTarif.value = 'Tarif belum tersedia';
    }

    periksaForm();
}

function periksaForm() {
    tombol.disabled = !(
        kendaraan.value &&
        idTarif.value &&
        area.value
    );
}

kendaraan.addEventListener('change', tampilkanInformasi);
area.addEventListener('change', periksaForm);

tampilkanInformasi();
periksaForm();

form.addEventListener('submit', function(event) {

    if (tombol.disabled) {
        event.preventDefault();
        return;
    }

    tombol.disabled = true;
    tombol.innerText = 'Menyimpan...';

});
</script>

@endsection
