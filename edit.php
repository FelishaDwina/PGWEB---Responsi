<?php
include 'header.php';
include 'koneksi.php';

// Fetch distinct locations for datalist
$query_lokasi = mysqli_query($koneksi, "SELECT DISTINCT Lokasi FROM pelabuhan ORDER BY Lokasi");
$locations = [];
while ($row = mysqli_fetch_assoc($query_lokasi)) {
    $locations[] = $row['Lokasi'];
}

// Check if 'id' is set in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<div class='container mt-4'><div class='alert alert-danger' role='alert'>ID Pelabuhan tidak ditemukan.</div></div>";
    include 'footer.php';
    exit();
}

// Sanitize the ID
$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// Fetch existing data
$query = mysqli_query($koneksi, "SELECT * FROM pelabuhan WHERE id='$id'");
if (!$query) {
    echo "<div class='container mt-4'><div class='alert alert-danger' role='alert'>Error fetching data: " . mysqli_error($koneksi) . "</div></div>";
    include 'footer.php';
    exit();
}
$data = mysqli_fetch_assoc($query);

// Check if data was found
if (!$data) {
    echo "<div class='container mt-4'><div class='alert alert-warning' role='alert'>Data pelabuhan tidak ditemukan.</div></div>";
    include 'footer.php';
    exit();
}
?>

<div class="container mt-4">
    <!-- FORM EDIT DATA -->
    <div class="card">
        <div class="card-header">
            <h4>Edit Data Pelabuhan</h4>
        </div>
        <div class="card-body">
            <form action="update.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']); ?>">
                <input type="hidden" name="old_gambar" value="<?= htmlspecialchars($data['Gambar']); ?>">

                <div class="mb-3">
                    <label class="form-label">Nama Pelabuhan</label>
                    <input type="text" class="form-control" name="nama" value="<?= htmlspecialchars($data['Nama']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Pelabuhan</label>
                    <input type="text" class="form-control" name="jenis" value="<?= htmlspecialchars($data['Jenis']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Kec./Kab.</label>
                    <input type="text" class="form-control" name="lokasi" value="<?= htmlspecialchars($data['Lokasi']); ?>" list="lokasi-list" required>
                    <datalist id="lokasi-list">
                        <?php foreach ($locations as $loc) { ?>
                            <option value="<?= htmlspecialchars($loc); ?>">
                        <?php } ?>
                    </datalist>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Latitude</label>
                        <input type="text" class="form-control" name="latitude" value="<?= htmlspecialchars($data['Latitude']); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Longitude</label>
                        <input type="text" class="form-control" name="longitude" value="<?= htmlspecialchars($data['Longitude']); ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status Operasional</label>
                    <input type="text" class="form-control" name="status" value="<?= htmlspecialchars($data['Status']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Pelabuhan</label>
                    <textarea class="form-control" name="deskripsi" rows="3" required><?= htmlspecialchars($data['Deskripsi']); ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar Pelabuhan Saat Ini</label><br>
                    <?php if (!empty($data['Gambar'])): ?>
                        <img src="img/<?= htmlspecialchars($data['Gambar']); ?>" class="img-fluid rounded mb-2" style="max-width: 200px;" alt="Gambar Pelabuhan <?= htmlspecialchars($data['Nama']); ?>"><br>
                    <?php else: ?>
                        <p>Tidak ada gambar saat ini.</p>
                    <?php endif; ?>
                    <label class="form-label mt-2">Upload Gambar Baru (Opsional)</label>
                    <input type="file" class="form-control" name="gambar_baru" accept="image/*">
                    <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                </div>

                <button type="submit" class="btn btn-primary"><i class="bi bi-arrow-repeat me-2"></i>Update Data</button>
                <a href="tabel.php" class="btn btn-secondary"><i class="bi bi-x-circle me-2"></i>Batal</a>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
