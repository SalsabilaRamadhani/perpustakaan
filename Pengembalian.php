<?php
class Pengembalian {
    private $conn;
    private $table_name = "pengembalian";

    public $id;
    public $id_pinjam;
    public $tanggal_pengembalian;
    public $denda;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create new pengembalian record
    function create() {
        $query = "INSERT INTO " . $this->table_name . " SET id_pinjam=?, tanggal_pengembalian=?, denda=?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("iss", $this->id_pinjam, $this->tanggal_pengembalian, $this->denda);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Hitung denda berdasarkan tanggal pengembalian
    function hitungDenda($id_pinjam, $tanggal_pengembalian) {
        $query = "SELECT tanggal_kembali FROM pinjam WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id_pinjam);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $tanggal_kembali = $row['tanggal_kembali'];

        // Hitung selisih hari
        $selisih_hari = strtotime($tanggal_pengembalian) - strtotime($tanggal_kembali);
        $selisih_hari = $selisih_hari / (60 * 60 * 24); // konversi detik ke hari

        // Jika terlambat, hitung denda
        if ($selisih_hari > 0) {
            $denda = $selisih_hari * 1000; // denda Rp. 1000 per hari
            return $denda;
        } else {
            return 0; // tidak ada denda
        }
    }

    // Read all pengembalian records
    function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>
