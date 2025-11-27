@extends('layouts.main')

@section('container')
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1,0">
        <title>profil pengguna - D'Lima Coffe</title>

        <style>
            body{
                font-family= sora, sans-serif;
                background: #F9F2ED;
                margin: 0;
                padding: 0;
                color: #313131;
            }
            
            .navbar{
                background: #C67C4E;
                padding: 15px 40px;
                display: flex;
                justify-content: space-beetwen;
                align-items; center;
                color: white;
                margin: 0;
            padding: 0;
            color: #313131;
        }

        /* NAVBAR */
        .navbar {
            background: #C67C4E;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .nav-links a {
            margin-left: 30px;
            color: white;
            text-decoration: none;
            font-weight: 500;
        }

        .profile-icon {
            width: 35px;
            height: 35px;
            background: #EDD6C8;
            border-radius: 50%;
        }

        /* CONTAINER */
        .container {
            padding: 40px 80px;
        }

        /* HEADER USER */
        .profile-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #ccc;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .profile-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .profile-photo {
            width: 60px;
            height: 60px;
            background: #E3E3E3;
            border-radius: 50%;
        }

        .edit-btn {
            background: #C67C4E;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }

        /* CARD */
        .section-cards {
            display: flex;
            gap: 20px;
        }

        .card {
            background: #F7E9E0;
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
        }

        .card-title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card p {
            margin: 4px 0;
        }

        .btn-small {
            margin-top: 8px;
            background: #C67C4E;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #B8B8B8;
            font-size: 15px;
        }

        .status {
            padding: 5px 10px;
            border-radius: 6px;
            color: white;
            font-size: 13px;
        }

        .diproses { background: #C67C4E; }
        .selesai { background: #8BC48A; }
        .batal { background: #D77A7A; }

        /* PENGATURAN */
        .settings {
            margin-top: 35px;
        }

        .settings button {
            margin-right: 15px;
            padding: 10px 15px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            background: #313131;
        }

        .hapus {
            background: #D77A7A;
            color: white;
        }

    </style>
</head>

<body>

    <!-- NAVBAR -->
    <div class="navbar">
        <div class="logo"><strong>D'Lima Coffee</strong></div>
        <div class="nav-links">
            <a href="#">Edukasi</a>
            <a href="#">Menu</a>
            <a href="#">Berita</a>
            <a href="#">About</a>
        </div>
        <div class="profile-icon"></div>
    </div>

    <!-- CONTENT -->
    <div class="container">

        <!-- HEADER USER -->
        <div class="profile-header">
            <div class="profile-info">
                <div class="profile-photo"></div>
                <div>
                    <h2><b>Nama Pengguna D'Lima</b></h2>
                    <p>pengguna@gmail.com</p>
                </div>
            </div>
            <button class="edit-btn">Edit Profil</button>
        </div>

        <!-- INFORMASI PRIBADI + ALAMAT -->
        <div class="section-cards">
            <div class="card">
                <div class="card-title">Informasi Pribadi</div>
                <p><b>Nama Lengkap:</b><span> M. Faiz Ilyas<span></p>
                <p><b>Nomor Telepon:</b> 087734377501</p>
                <p><b>Email:</b> pengguna@gmail.com</p>
                <p><b>Tanggal Lahir:</b> 05/05/2005</p>
            </div>

            <div class="card">
                <div class="card-title">Alamat Pengiriman</div>
                <p><b>Alamat Utama</b></p>
                <p>Jl. Kopi Arabika No. 12, Kel. Roast, Kec. Brewing, Kota Kenangan, 12345</p>
                <button class="btn-small">Tambah Alamat</button>
            </div>
        </div>

        <!-- RIWAYAT PESANAN -->
        <h3 style="margin-top: 40px;">Riwayat Pesanan</h3>

        <table>
            <tr>
                <th>Nomor Pesanan</th>
                <th>Tanggal</th>
                <th>Total Harga</th>
                <th>Status</th>
            </tr>

            <tr>
                <td>#ORD-0012</td>
                <td>21 Nov 2025</td>
                <td>Rp 20.000</td>
                <td><span class="status diproses">Diproses</span></td>
            </tr>

            <tr>
                <td>#ORD-0012</td>
                <td>21 Nov 2025</td>
                <td>Rp 20.000</td>
                <td><span class="status selesai">Selesai</span></td>
            </tr>

            <tr>
                <td>#ORD-0012</td>
                <td>21 Nov 2025</td>
                <td>Rp 20.000</td>
                <td><span class="status batal">Dibatalkan</span></td>
            </tr>
        </table>

        <!-- PENGATURAN -->
        <div class="settings">
            <h3><strong>Pengaturan Akun</strong></h3>
            <button>Ganti Password</button>
            <button>Kelola Notifikasi</button>
            <button class="hapus">Hapus Akun</button>
        </div>

    </div>

</body>
</html>
        
@endsection