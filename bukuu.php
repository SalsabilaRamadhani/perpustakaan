<?php
include 'db.php';
include 'Buku.php'; // Pastikan ini adalah file yang benar untuk kelas Buku

$buku = new Bukuu($conn); // Pastikan nama kelas sesuai dengan file yang di-include

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'create') {
        $buku->judul = $_POST['judul'];
        $buku->pengarang = $_POST['pengarang'];
        $buku->tahun_terbit = $_POST['tahun_terbit'];
        $buku->create();
    } elseif ($action == 'update') {
        $buku->id_buku = $_POST['id_buku'];
        $buku->judul = $_POST['judul'];
        $buku->pengarang = $_POST['pengarang'];
        $buku->tahun_terbit = $_POST['tahun_terbit'];
        $buku->update();
    } elseif ($action == 'delete') {
        $buku->id_buku = $_POST['id'];
        $buku->delete();
    }
}

$all_buku = $buku->read();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Buku</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h1>Data Buku</h1>
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
    <form method="POST">
    <h2>Data Buku</h2>
        Judul: <input type="text" name="judul" required><br>
        Pengarang: <input type="text" name="pengarang" required><br>
        Tahun Terbit: <input type="text" name="tahun_terbit" required><br>
        <input type="hidden" name="action" value="create">
        <input type="submit" value="Tambah Buku">
    </form>
    <br>
    <h2>Daftar Buku</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Tahun Terbit</th>
            <th>Aksi</th>
        </tr>
        <?php while($row = $all_buku->fetch_assoc()): ?>
        <tr>
            <form method="POST">
                <td><?= $row['id'] ?></td>
                <td><input type="text" name="judul" value="<?= $row['judul'] ?>" required></td>
                <td><input type="text" name="pengarang" value="<?= $row['penulis'] ?>" required></td>
                <td><input type="text" name="tahun_terbit" value="<?= $row['tahun_terbit'] ?>" required></td>
                <td>
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="hidden" name="action" value="update">
                    <input type="submit" value="Update">
                    <input type="hidden" name="action" value="delete">
                    <input type="submit" value="Delete">
                </td>
            </form>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="index.php">Kembali ke Beranda</a>
</body>
</html>
