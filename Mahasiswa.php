<?php
class Mahasiswaa {
    private $conn;
    private $table_name = "mahasiswa";

    public $id;
    public $nama;
    public $nim;
    public $jurusan;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Read all mahasiswaa records
    function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Create new mahasiswaa record
    function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nama=?, nim=?, jurusan=?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("sss", $this->nama, $this->nim, $this->jurusan);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Update existing mahasiswaa record
    function update() {
        $query = "UPDATE " . $this->table_name . " SET nama=?, nim=?, jurusan=? WHERE id=?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("sssi", $this->nama, $this->nim, $this->jurusan, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete mahasiswaa record
    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("i", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
