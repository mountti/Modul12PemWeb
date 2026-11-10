<?php
session_start();

if (!isset($_SESSION['jabatan'])) {
    header("Location: login.php");
    exit;
}

require_once "koneksiMVC.php";
require_once "c_programKerja.php";

$controller = new c_programKerja($mysqli);
$controller->invoke();
?>

