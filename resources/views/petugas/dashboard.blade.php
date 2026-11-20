
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petugas - PARKIR APP</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="brand">
            <h2>PARKIR APP</h2>
            <p>Sistem Informasi Parkir</p>
        </div>

        <nav class="menu">
            <a href="{{ route('petugas.dashboard') }}" class="active">
                Dashboard
            </a>

            <a href="{{ route('petugas.transaksi.index') }}">
                Data Transaksi
            </a>
        </nav>

        <div class="account">
            <p>Akun Petugas</p>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>

    </aside>

    <!-- KONTEN UTAMA -->
    <div class="content">

        <!-- HEADER -->
        <header class="topbar">
            <div>
                <h2>Dashboard Petugas</h2>
                
            </div>

          
        </header>

        <main>


            <!-- MENU OPERASIONAL -->
            <section class="petugas-menu-section">

                <div class="petugas-section-header">
                    <h3>Menu Operasional</h3>
                    <p>Pilih menu untuk menjalankan aktivitas parkir.</p>
                </div>

                <div class="actions">

                    <!-- KENDARAAN MASUK -->
                    <div class="action-card">
                        

                        <h3>Kendaraan Masuk</h3>

                        <p>
                            Catat data kendaraan yang masuk
                            ke area parkir.
                        </p>

                        <a href="{{ route('petugas.transaksi.formMasuk') }}">
                            Catat Kendaraan Masuk
                        </a>
                    </div>

                    <!-- DATA TRANSAKSI -->
                    <div class="action-card">
                      

                        <h3>Data Transaksi</h3>

                        <p>
                            Lihat dan kelola data transaksi
                            kendaraan yang tercatat.
                        </p>

                        <a href="{{ route('petugas.transaksi.index') }}">
                            Lihat Data Transaksi
                        </a>
                    </div>

                </div>

            </section>

        </main>

    </div>

</div>

</body>
</html>
