
<?php
require_once "koneksiMVC.php";

$akun = [
    ["menteri", "menteri123", "Menteri"],
    ["kepala", "kepala123", "Kepala Departemen"]
];

$stmt = $mysqli->prepare(
    "INSERT INTO pengguna (username, password, jabatan)
     VALUES (?, ?, ?)"
);

foreach ($akun as $data) {
    $username = $data[0];
    $password = password_hash($data[1], PASSWORD_DEFAULT);
    $jabatan = $data[2];

    $stmt->bind_param("sss", $username, $password, $jabatan);

    if ($stmt->execute()) {
        echo "Akun $username berhasil dibuat!<br>";
    } else {
        echo "Gagal membuat akun $username: " . $stmt->error . "<br>";
    }
}
?>