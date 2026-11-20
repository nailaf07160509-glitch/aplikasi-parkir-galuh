
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <aside class="sidebar">
        <h2>PARKIR APP</h2>

        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.tarif.index') }}">Tarif Parkir</a>
        <a href="{{ route('admin.user.index') }}">Data User</a>
         <a href="{{ route('admin.area.index') }}">Area Parkir</a>
          <a href="{{ route('admin.kendaraan.index') }}">Kendaraan</a>
           <a href="{{ route('admin.log.index') }}">Log Aktivitas</a>




        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </aside>

    <main class="content">
        <h1>Dashboard Admin</h1>
        <p>rek, {{ auth()->user()->nama_lengkap }}.</p>

        <div class="card">
            <h3>Kelola Tarif Parkir</h3>
            <p>Tambah, edit, dan hapus tarif parkir kendaraan.</p>
            <a href="{{ route('admin.tarif.index') }}">
                Buka Data Tarif Parkir
            </a>
        </div>
        <div class="card">
            <h3>Kelola Data User</h3>
            <p>Tambah, edit, dan hapus Data User.</p>
            <a href="{{ route('admin.user.index') }}">
                Buka Data User
            </a>
        </div>
        <div class="card">
            <h3>Kelola Area Parkir</h3>
            <p>Tambah, edit, dan hapus Area parkir kendaraan.</p>
            <a href="{{ route('admin.area.index') }}">
                Buka Data Tarif Parkir
            </a>
        </div>
        <div class="card">
            <h3>Kelola Kendaraan</h3>
            <p>Tambah, edit, dan hapus kendaraan.</p>
            <a href="{{ route('admin.kendaraan.index') }}">
                Buka Data Kendaaraan
            </a>
        </div>
        <div class="card">
            <h3>Log Aktivitas</h3>
            <p>Lihat log aktivitas.</p>
            <a href="{{ route('admin.log.index') }}">
                Buka log aktivitas 
            </a>
        </div>
    </main>

</body>
</html>
