<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Aplikasi Parkir')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-3">
    <span class="navbar-brand">
        Aplikasi Parkir — {{ ucfirst(auth()->user()->role) }}
    </span>

    <div class="d-flex align-items-center">
        <span class="text-white me-3">
            {{ auth()->user()->nama_lengkap }}
        </span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-sm btn-outline-light">Logout</button>
        </form>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        {{-- SIDEBAR HANYA UNTUK DASHBOARD --}}
        @if(View::hasSection('showSidebar'))
            <div class="col-md-2 bg-light vh-100 p-3">

                @if(auth()->user()->role == 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="d-block mb-2">Dashboard</a>
                    <a href="{{ route('admin.user.index') }}" class="d-block mb-2">Data User</a>
                    <a href="{{ route('admin.tarif.index') }}" class="d-block mb-2">Tarif Parkir</a>
                    <a href="{{ route('admin.area.index') }}" class="d-block mb-2">Area Parkir</a>
                    <a href="{{ route('admin.kendaraan.index') }}" class="d-block mb-2">Kendaraan</a>
                    <a href="{{ route('admin.log.index') }}" class="d-block mb-2">Log Aktivitas</a>

                @elseif(auth()->user()->role == 'owner')
                    <h6>Menu Owner</h6>
                    <a href="{{ route('owner.dashboard') }}" class="d-block mb-2">Dashboard</a>

                @elseif(auth()->user()->role == 'petugas')
                    <a href="{{ route('petugas.dashboard') }}" class="d-block mb-2">Dashboard</a>
                    <a href="{{ route('petugas.transaksi.index') }}" class="d-block mb-2">Data Transaksi</a>
                @endif

            </div>
        @endif

        <div class="@if(View::hasSection('showSidebar')) col-md-10 @else col-12 @endif p-4">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')

        </div>
    </div>
</div>

</body>
</html>