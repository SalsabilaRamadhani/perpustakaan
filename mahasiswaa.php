<?php
include 'db.php';
include 'Mahasiswa.php';

$mahasiswa = new Mahasiswaa($conn);

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'create') {
        $mahasiswa->nama = $_POST['nama'];
        $mahasiswa->nim = $_POST['nim'];
        $mahasiswa->jurusan = $_POST['jurusan'];
        $mahasiswa->create();
    } elseif ($action == 'update') {
        $mahasiswa->id = $_POST['id'];
        $mahasiswa->nama = $_POST['nama'];
        $mahasiswa->nim = $_POST['nim'];
        $mahasiswa->jurusan = $_POST['jurusan'];
        $mahasiswa->update();
    } elseif ($action == 'delete') {
        $mahasiswa->id = $_POST['id'];
        $mahasiswa->delete();
    }
}

// Fetch all mahasiswa records
$all_mahasiswa = $mahasiswa->read();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h1>Data Mahasiswa</h1>
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
        <h2>Data Mahasiswa</h2>
        Nama: <input type="text" name="nama" required><br>
        NIM: <input type="text" name="nim" required><br>
        Jurusan: <input type="text" name="jurusan" required><br>
        <input type="hidden" name="action" value="create">
        <input type="submit" value="Tambah Mahasiswa">
    </form>
    <br>

    <h2>Daftar Mahasiswa</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Jurusan</th>
            <th>Aksi</th>
        </tr>
        <?php 
        if ($all_mahasiswa && $all_mahasiswa->num_rows > 0) {
            while($row = $all_mahasiswa->fetch_assoc()): ?>
                <tr>
                    <form method="POST">
                        <td><?= $row['id'] ?></td>
                        <td><input type="text" name="nama" value="<?= $row['nama'] ?>" required></td>
                        <td><input type="text" name="nim" value="<?= $row['nim'] ?>" required></td>
                        <td><input type="text" name="jurusan" value="<?= $row['jurusan'] ?>" required></td>
                        <td>
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <input type="submit" name="action" value="Update">
                            <input type="submit" name="action" value="Delete">
                        </td>
                    </form>
                </tr>
            <?php endwhile; 
        } else {
            echo '<tr><td colspan="5">Tidak ada data mahasiswa</td></tr>';
        }
        ?>
    </table>
    <br>
    <a href="index.php" class="button">Kembali ke Beranda</a>
</body>
</html>
