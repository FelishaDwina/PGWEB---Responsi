<?php
include 'koneksi.php';

$sql = "ALTER TABLE pelabuhan ADD COLUMN Deskripsi TEXT";

if (mysqli_query($koneksi, $sql)) {
    echo "Kolom 'Deskripsi' berhasil ditambahkan ke tabel 'pelabuhan'.";
} else {
    echo "Error menambahkan kolom: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>