<?php
$isKepala = ($_SESSION['jabatan'] === 'Kepala Departemen');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Program Kerja BEM</title>
</head>
<body>

<h2>Daftar Program Kerja BEM</h2>

<p>
    Selamat datang, 
    <?php echo htmlspecialchars($_SESSION['username']); ?>
    (<?php echo htmlspecialchars($_SESSION['jabatan']); ?>)
</p>

<a href="logout.php">Logout</a>

<hr>

<?php if ($isKepala): ?>

    <h3>
        <?php echo $editData ? "Edit Program Kerja" : "Tambah Program Kerja"; ?>
    </h3>

    <form method="POST">
        <label>Nomor Program:</label><br>
        <input
            type="number"
            name="nomorProgram"
            value="<?php echo htmlspecialchars($editData['nomorProgram'] ?? ''); ?>"
            required
            <?php echo $editData ? 'readonly' : ''; ?>
        ><br><br>

        <label>Nama Program:</label><br>
        <input
            type="text"
            name="namaProgram"
            value="<?php echo htmlspecialchars($editData['namaProgram'] ?? ''); ?>"
            required
        ><br><br>

        <label>Surat Keterangan:</label><br>
        <input
            type="text"
            name="suratKeterangan"
            value="<?php echo htmlspecialchars($editData['suratKeterangan'] ?? ''); ?>"
            required
        ><br><br>

        <?php if ($editData): ?>
            <button type="submit" name="edit">Simpan Perubahan</button>
            <a href="index.php">Batal</a>
        <?php else: ?>
            <button type="submit" name="tambah">Tambah</button>
        <?php endif; ?>
    </form>

    <hr>

<?php endif; ?>

<h3>Data Program Kerja</h3>

<table border="1" cellpadding="8">
    <tr>
        <th>Nomor Program</th>
        <th>Nama Program</th>
        <th>Surat Keterangan</th>

        <?php if ($isKepala): ?>
            <th>Aksi</th>
        <?php endif; ?>
    </tr>

    <?php foreach ($proker as $data): ?>
        <tr>
            <td><?php echo htmlspecialchars($data['nomorProgram']); ?></td>
            <td><?php echo htmlspecialchars($data['namaProgram']); ?></td>
            <td><?php echo htmlspecialchars($data['suratKeterangan']); ?></td>

            <?php if ($isKepala): ?>
                <td>
                    <a href="index.php?edit=<?php echo urlencode($data['nomorProgram']); ?>">
                        Edit
                    </a>

                    <form method="POST" style="display:inline;">
                        <input
                            type="hidden"
                            name="nomorProgram"
                            value="<?php echo htmlspecialchars($data['nomorProgram']); ?>"
                        >
                        <button
                            type="submit"
                            name="hapus"
                            onclick="return confirm('Yakin ingin menghapus data ini?')"
                        >
                            Hapus
                        </button>
                    </form>
                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
