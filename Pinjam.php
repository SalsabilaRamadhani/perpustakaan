<?php
class Pinjam {
    private $conn;
    private $table_name = "pinjam";

    public $id;
    public $id_mahasiswa;
    public $id_buku;
    public $tanggal_pinjam;
    public $tanggal_kembali;
    public $status_pengembalian;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Read all pinjam records
    function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Create new pinjam record
    function create() {
        $query = "INSERT INTO " . $this->table_name . " SET id_mahasiswa=?, id_buku=?, tanggal_pinjam=?, tanggal_kembali=?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("iiss", $this->id_mahasiswa, $this->id_buku, $this->tanggal_pinjam, $this->tanggal_kembali);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Update existing pinjam record
    function update() {
        $query = "UPDATE " . $this->table_name . " SET id_mahasiswa=?, id_buku=?, tanggal_pinjam=?, tanggal_kembali=? WHERE id=?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("iissi", $this->id_mahasiswa, $this->id_buku, $this->tanggal_pinjam, $this->tanggal_kembali, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Update tanggal kembali
    function updateKembali() {
        $query = "UPDATE " . $this->table_name . " SET tanggal_kembali=? WHERE id=?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("si", $this->tanggal_kembali, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Update status pengembalian
    function updateStatusPengembalian($id_pinjam, $status_pengembalian) {
        $query = "UPDATE " . $this->table_name . " SET status_pengembalian=? WHERE id=?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("si", $status_pengembalian, $id_pinjam);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete pinjam record
    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("i", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Calculate fine
    function hitungDenda($tanggal_kembali, $tanggal_sekarang) {
        $datetime1 = new DateTime($tanggal_kembali);
        $datetime2 = new DateTime($tanggal_sekarang);
        if ($datetime1 < $datetime2) {
            $interval = $datetime1->diff($datetime2);
            return $interval->days * 1000; // Assume fine is Rp. 1,000 per day
        }
        return 0;
    }

    // Read pinjam records that are not yet returned
    function readBelumKembali() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE status_pengembalian='Belum'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Get tanggal kembali based on id_pinjam
    function getTanggalKembali($id_pinjam) {
        $query = "SELECT tanggal_kembali FROM " . $this->table_name . " WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id_pinjam);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['tanggal_kembali'];
    }
}
?>
