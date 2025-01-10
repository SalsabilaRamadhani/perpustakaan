<?php
class Bukuu {
    private $conn;
    private $table_name = "buku";

    public $id_buku;
    public $judul;
    public $penulis;
    public $tahun_terbit;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Read all buku records
    function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Create new buku record
    function create() {
        $query = "INSERT INTO " . $this->table_name . " SET judul=?, penulis=?, tahun_terbit=?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("sss", $this->judul, $this->pengarang, $this->tahun_terbit);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Update existing buku record
    function update() {
        $query = "UPDATE " . $this->table_name . " SET judul=?, pengarang=?, tahun_terbit=? WHERE id_buku=?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("sssi", $this->judul, $this->pengarang, $this->tahun_terbit, $this->id_buku);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete buku record
    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("i", $this->id_buku);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
