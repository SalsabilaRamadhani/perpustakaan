<?php
include 'db.php';
include 'Mahasiswa.php';
include 'Buku.php';
include 'Pinjam.php'; // Include Pinjam.php to resolve class not found error
include 'Pengembalian.php'; // Include Pengembalian.php for Pengembalian class

$mahasiswa = new Mahasiswaa($conn);
$buku = new Bukuu($conn);
$pinjam = new Pinjam($conn); // Instantiate Pinjam class
$pengembalian = new Pengembalian($conn); // Instantiate Pengembalian class

$all_mahasiswa = $mahasiswa->read();
$all_buku = $buku->read();
$all_pinjam = $pinjam->read();
$all_pengembalian = $pengembalian->read();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Sistem Perpustakaan</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h1>Laporan Sistem Perpustakaan</h1>
    <nav>
        <ul>
            <li><a href="index.php">Beranda</a></li>
            <li><a href="mahasiswaa.php">Data Mahasiswa</a></li>
            <li><a href="bukuu.php">Data Buku</a></li>
            <li><a href="pinjamm.php">Data Pinjam</a></li>
            <li><a href="pengembaliann.php">Data Pengembalian</a></li>
            <li><a href="laporan.php">Laporan</a></li>
        </ul>
    </nav>

    <h2>Data Mahasiswa</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Jurusan</th>
        </tr>
        <?php while($row = $all_mahasiswa->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['nim'] ?></td>
            <td><?= $row['jurusan'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Data Buku</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Penerbit</th> 
            <th>Tahun Terbit</th>
        </tr>
        <?php while($row = $all_buku->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['judul'] ?></td>
            <td><?= $row['penulis'] ?></td>
            <td><?= $row['penerbit'] ?></td>
            <td><?= $row['tahun_terbit'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Data Pinjam</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>ID Mahasiswa</th>
            <th>ID Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
           
        </tr>
        <?php while($row = $all_pinjam->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['id_mahasiswa'] ?></td>
            <td><?= $row['id_buku'] ?></td>
            <td><?= $row['tanggal_pinjam'] ?></td>
            <td><?= $row['tanggal_kembali'] ?></td>
            
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Data Pengembalian</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>ID Pinjam</th>
            <th>Tanggal Pengembalian</th>
            <th>Denda</th>
        </tr>
        <?php while($row = $all_pengembalian->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['id_pinjam'] ?></td>
            <td><?= $row['tanggal_pengembalian'] ?></td>
            <td><?= $row['denda'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <br>
    <a href="index.php" class="button">Kembali ke Beranda</a>
</body>
</html>
