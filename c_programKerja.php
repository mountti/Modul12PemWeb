
<?php
require_once "m_programKerja.php";

class c_programKerja {
    public $model;

    public function __construct($db) {
        $this->model = new m_programKerja($db);
    }

    public function invoke() {
        $isKepala = (
            isset($_SESSION['jabatan']) &&
            $_SESSION['jabatan'] === 'Kepala Departemen'
        );

        // Hanya Kepala Departemen yang boleh mengubah data
        if (isset($_POST['tambah']) ||
            isset($_POST['edit']) ||
            isset($_POST['hapus'])) {

            if (!$isKepala) {
                header("Location: index.php");
                exit;
            }
        }

        if (isset($_POST['tambah'])) {
            $this->model->setProgramKerja(
                $_POST['nomorProgram'],
                $_POST['namaProgram'],
                $_POST['suratKeterangan']
            );
            header("Location: index.php");
            exit;
        }

        if (isset($_POST['edit'])) {
            $this->model->updateProgramKerja(
                $_POST['nomorProgram'],
                $_POST['namaProgram'],
                $_POST['suratKeterangan']
            );
            header("Location: index.php");
            exit;
        }

        if (isset($_POST['hapus'])) {
            $this->model->deleteProgramKerja(
                $_POST['nomorProgram']
            );
            header("Location: index.php");
            exit;
        }

        $proker = $this->model->getSemuaProgramKerja();
        $editData = null;

        if ($isKepala && isset($_GET['edit'])) {
            $editData = $this->model->getProgramKerjaById($_GET['edit']);
        }

        include "v_programKerja.php";
    }
}
?>
