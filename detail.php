<?php
include 'header.php';
include 'koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT * FROM pelabuhan WHERE id='$id'");
$data = mysqli_fetch_assoc($query);
?>

<div class="container mt-4">

                    <a href="tabel.php" class="btn btn-secondary mt-3"><i class="bi bi-arrow-left-circle me-2"></i>Kembali ke Daftar Pelabuhan</a>

    <h3><?= $data['Nama']; ?></h3>

    <?php if (!empty($data['Gambar'])): ?>
    <img src="img/<?= htmlspecialchars($data['Gambar']); ?>" 
         class="img-fluid mb-3" 
         style="max-width:400px"
         alt="Gambar <?= htmlspecialchars($data['Nama']); ?>">
<?php else: ?>
    <p><i>Tidak ada gambar tersedia.</i></p>
<?php endif; ?>

<p><?= nl2br(htmlspecialchars($data['Deskripsi'])); ?></p>


    <ul>
        <li><b>Nama:</b> <?= $data['Nama']; ?></li>
        <li><b>Lokasi:</b> <?= $data['Lokasi']; ?></li>
        <li><b>Koordinat:</b> <?= $data['Latitude']; ?>, <?= $data['Longitude']; ?></li>
    </ul>

</div>
</body>
</html>
