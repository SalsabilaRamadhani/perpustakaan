<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perpustakaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
            padding: 0;
        }
        h1 {
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: auto;
        }
        .menu {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
        .menu a {
            text-decoration: none;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f0f0f0;
        }
        .menu a:hover {
            background-color: #e0e0e0;
        }
        .main-content {
            margin-top: 20px;
        }
        .features {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sistem Perpustakaan</h1>
        <div class="menu">
            <a href="mahasiswaa.php">Data Mahasiswa</a>
            <a href="bukuu.php">Data Buku</a>
            <a href="pinjamm.php">Data Pinjam/Pengembalian</a>
            <a href="pengembaliann.php">Data Pengembalian</a>
            <a href="laporan.php">Laporan</a>
        </div>
        <div class="main-content">
            <h2>Selamat Datang di Sistem Perpustakaan</h2>
            <p>Ini adalah sistem perpustakaan sederhana untuk mengelola data mahasiswa, buku, dan peminjaman/pengembalian buku. Anda dapat menggunakan menu di atas untuk mengakses fitur-fitur yang tersedia.</p>
            <h3>Fitur Utama</h3>
            <ul class="features">
                <li>Manajemen Data Mahasiswa: Tambah, lihat, ubah, dan hapus data mahasiswa.</li>
                <li>Manajemen Data Buku: Tambah, lihat, ubah, dan hapus data buku.</li>
                <li>Manajemen Peminjaman dan Pengembalian: Catat peminjaman dan pengembalian buku, serta hitung denda keterlambatan.</li>
            </ul>
            <h3>Instruksi Penggunaan</h3>
            <p>Untuk memulai, pilih salah satu menu di atas. Anda dapat menambahkan data baru, mengupdate data yang ada, atau menghapus data yang tidak diperlukan.</p>
            <p>Sistem ini dirancang untuk membantu mengelola perpustakaan dengan lebih mudah dan efisien. Jika Anda memiliki pertanyaan atau membutuhkan bantuan, silakan hubungi administrator sistem.</p>
        </div>
    </div>
</body>
</html>
