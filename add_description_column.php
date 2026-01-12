<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kolom Deskripsi</title>
</head>
<body>

<h3>Tambah Kolom Deskripsi ke Tabel Pelabuhan</h3>

<form method="post">
    <button type="submit" name="tambah">Tambah Kolom Deskripsi</button>
</form>

<?php
include 'koneksi.php';

if (isset($_POST['tambah'])) {

    // cek apakah kolom sudah ada
    $cek = mysqli_query($koneksi, "SHOW COLUMNS FROM pelabuhan LIKE 'Deskripsi'");
    
    if (mysqli_num_rows($cek) > 0) {
        echo "<p>Kolom <b>Deskripsi</b> sudah ada di tabel pelabuhan.</p>";
    } else {
        $sql = "ALTER TABLE pelabuhan ADD COLUMN Deskripsi TEXT";

        if (mysqli_query($koneksi, $sql)) {
            echo "<p>Kolom <b>Deskripsi</b> berhasil ditambahkan.</p>";
        } else {
            echo "<p>Error: " . mysqli_error($koneksi) . "</p>";
        }
    }

    mysqli_close($koneksi);
}
?>

</body>
</html>

