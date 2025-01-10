<!DOCTYPE html>
<html>
<head>
    <title>Data Pinjam</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h1>Data Pinjam</h1>
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
    <br>
    <form method="POST">
        <h2>Data Pinjam</h2>
        ID Mahasiswa: <input type="text" name="id_mahasiswa" required><br>
        ID Buku: <input type="text" name="id_buku" required><br>
        Tanggal Pinjam: <input type="date" name="tanggal_pinjam" value="<?= date('Y-m-d') ?>" required><br>
        Tanggal Kembali: <input type="date" name="tanggal_kembali" value="<?= date('Y-m-d', strtotime('+7 days')) ?>" required><br>
        <input type="hidden" name="action" value="create">
        <input type="submit" value="Tambah Pinjaman">
    </form>
    <br>
    <h2>Daftar Pinjam</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>ID Mahasiswa</th>
            <th>ID Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            
            <th>Aksi</th>
        </tr>
        <?php
        include 'db.php';
        include 'Pinjam.php';

        $pinjam = new Pinjam($conn);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $action = $_POST['action'];

            if ($action == 'create') {
                $pinjam->id_mahasiswa = $_POST['id_mahasiswa'];
                $pinjam->id_buku = $_POST['id_buku'];
                $pinjam->tanggal_pinjam = $_POST['tanggal_pinjam'];
                $pinjam->tanggal_kembali = $_POST['tanggal_kembali'];
                $pinjam->create();
            } elseif ($action == 'update') {
                $pinjam->id = $_POST['id'];
                $pinjam->id_mahasiswa = $_POST['id_mahasiswa'];
                $pinjam->id_buku = $_POST['id_buku'];
                $pinjam->tanggal_pinjam = $_POST['tanggal_pinjam'];
                $pinjam->tanggal_kembali = $_POST['tanggal_kembali'];
                $pinjam->update();
            } elseif ($action == 'delete') {
                $pinjam->id = $_POST['id'];
                $pinjam->delete();
            }
        }

        $all_pinjam = $pinjam->read();

        while($row = $all_pinjam->fetch_assoc()): ?>
        <tr>
            <form method="POST">
                <td><?= $row['id'] ?></td>
                <td><input type="text" name="id_mahasiswa" value="<?= $row['id_mahasiswa'] ?>" required></td>
                <td><input type="text" name="id_buku" value="<?= $row['id_buku'] ?>" required></td>
                <td><input type="date" name="tanggal_pinjam" value="<?= $row['tanggal_pinjam'] ?>" required></td>
                <td><input type="date" name="tanggal_kembali" value="<?= $row['tanggal_kembali'] ?>" required></td>
                
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
