<?php

$mysqli = new mysqli(
    "localhost",
    "root",
    "root123",
    "praktikum_Web"
);

if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

?>
