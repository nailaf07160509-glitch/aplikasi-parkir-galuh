@extends('layouts.app')

@section('hideSidebar', true)
@section('heading', 'Edit User')
@section('subtitle', 'Perbarui informasi akun pengguna')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
<div class="tarif-form-page">

    <div class="tarif-form-card">

        <div class="tarif-form-header">
            <h3>Edit User</h3>
          
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

        <form method="POST" action="{{ route('admin.user.update', $user->id_user) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input
                    type="text"
                    name="nama_lengkap"
                    id="nama_lengkap"
                    value="{{ old('nama_lengkap', $user->nama_lengkap) }}"
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
                    value="{{ old('username', $user->username) }}"
                    placeholder="Masukkan username"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Password Baru</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Kosongkan jika tidak ingin mengganti password"
                >
             
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role" required>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>

                    <option value="petugas" {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>
                        Petugas
                    </option>

                    <option value="owner" {{ old('role', $user->role) == 'owner' ? 'selected' : '' }}>
                        Owner
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="status_aktif">Status Akun</label>
                <select name="status_aktif" id="status_aktif" required>
                    <option value="1" {{ old('status_aktif', $user->status_aktif) == '1' ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="0" {{ old('status_aktif', $user->status_aktif) == '0' ? 'selected' : '' }}>
                        Nonaktif
                    </option>
                </select>
            </div>

            <div class="tarif-form-buttons">
                <a href="{{ route('admin.user.index') }}" class="tarif-btn-back">
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
