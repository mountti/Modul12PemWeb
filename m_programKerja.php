<?php

class m_programKerja {

    private $mysqli;
    public $hasil = array();

    public function __construct($db) {
        $this->mysqli = $db;
    }

    // CREATE: Menambah program kerja
    public function setProgramKerja($nomorProgram, $namaProgram, $suratKeterangan) {

        $stmt = $this->mysqli->prepare(
            "INSERT INTO proker
            (nomorProgram, namaProgram, suratKeterangan)
            VALUES (?, ?, ?)"
        );

        $stmt->bind_param(
            "iss",
            $nomorProgram,
            $namaProgram,
            $suratKeterangan
        );

        return $stmt->execute();
    }

    // READ: Menampilkan semua program kerja
    public function getSemuaProgramKerja() {

        $rs = $this->mysqli->query(
            "SELECT * FROM proker ORDER BY nomorProgram"
        );

        $this->hasil = [];

        while ($row = $rs->fetch_assoc()) {
            $this->hasil[] = $row;
        }

        return $this->hasil;
    }

    // UPDATE: Mengedit program kerja
    public function updateProgramKerja($nomorProgram, $namaProgram, $suratKeterangan) {

        $stmt = $this->mysqli->prepare(
            "UPDATE proker
            SET namaProgram = ?, suratKeterangan = ?
            WHERE nomorProgram = ?"
        );

        $stmt->bind_param(
            "ssi",
            $namaProgram,
            $suratKeterangan,
            $nomorProgram
        );

        return $stmt->execute();
    }

    // DELETE: Menghapus program kerja
    public function deleteProgramKerja($nomorProgram) {

        $stmt = $this->mysqli->prepare(
            "DELETE FROM proker WHERE nomorProgram = ?"
        );

        $stmt->bind_param("i", $nomorProgram);

        return $stmt->execute();
    }

    // Mengambil satu data untuk diedit
    public function getProgramKerjaById($nomorProgram) {

        $stmt = $this->mysqli->prepare(
            "SELECT * FROM proker WHERE nomorProgram = ?"
        );

        $stmt->bind_param("i", $nomorProgram);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }
}

?>
