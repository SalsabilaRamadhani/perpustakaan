<?php
include 'db.php';
include 'Pinjam.php';
include 'Pengembalian.php';

$pinjam = new Pinjam($conn);
$pengembalian = new Pengembalian($conn);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'pengembalian') {
        $id_pinjam = $_POST['id_pinjam'];
        $tanggal_pengembalian = $_POST['tanggal_pengembalian'];

        // Hitung denda
        $tanggal_kembali = $pinjam->getTanggalKembali($id_pinjam);
        $denda = $pinjam->hitungDenda($tanggal_kembali, $tanggal_pengembalian);

        // Cek apakah denda harus dibayar atau tidak
        if ($denda > 0) {
            $status_pembayaran = $_POST['status_pembayaran'];
            if ($status_pembayaran == 'sudah') {
                $status_pengembalian = 'Diterima';
            } else {
                $status_pengembalian = 'Gagal';
            }
        } else {
            $status_pengembalian = 'Diterima';
        }

        // Simpan pengembalian ke database
        $pengembalian->id_pinjam = $id_pinjam;
        $pengembalian->tanggal_pengembalian = $tanggal_pengembalian;
        $pengembalian->denda = $denda;
        $pengembalian->status_pengembalian = $status_pengembalian;
        $pengembalian->create();

        // Update status pengembalian di tabel pinjam
        $pinjam->updateStatusPengembalian($id_pinjam, $status_pengembalian);
    }
}

// Ambil data peminjaman yang belum dikembalikan
$all_pinjam = $pinjam->readBelumKembali();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pengembalian</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h1>Data Pengembalian</h1>
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

    <h2>Form Pengembalian Buku</h2>
    <form method="POST">
        ID Pinjam:
        <select name="id_pinjam" required>
            <?php while($row = $all_pinjam->fetch_assoc()): ?>
                <option value="<?= $row['id'] ?>"><?= $row['id'] ?></option>
            <?php endwhile; ?>
        </select><br>
        Tanggal Pengembalian: <input type="date" name="tanggal_pengembalian" required><br>
        <?php if (isset($denda) && $denda > 0): ?>
        Status Pembayaran Denda:
        <select name="status_pembayaran" required>
            <option value="sudah">Sudah</option>
            <option value="belum">Belum</option>
        </select><br>
        <?php endif; ?>
        <input type="hidden" name="action" value="pengembalian">
        <input type="submit" value="Kirim Pengembalian">
    </form>

    <br>
    <h2>Data Pengembalian</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>ID Pinjam</th>
            <th>Tanggal Pengembalian</th>
            <th>Denda</th>
            <th>Status Pengembalian</th>
        </tr>
        <?php 
        $all_pengembalian = $pengembalian->read();
        while($row = $all_pengembalian->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['id_pinjam'] ?></td>
            <td><?= $row['tanggal_pengembalian'] ?></td>
            <td><?= $row['denda'] ?></td>
            <td><?= $row['status_pengembalian'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="index.php" class="button">Kembali ke Beranda</a>
</body>
</html>
