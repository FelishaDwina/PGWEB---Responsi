<?php 
include 'header.php'; 
include 'koneksi.php'; 

$where_clauses = [];
$search_nama = $_GET['search_nama'] ?? '';
$search_lokasi = $_GET['search_lokasi'] ?? '';
$search_jenis = $_GET['search_jenis'] ?? '';

if (!empty($search_nama)) {
    $search_nama_escaped = mysqli_real_escape_string($koneksi, $search_nama);
    $where_clauses[] = "(Nama LIKE '%$search_nama_escaped%' OR Deskripsi LIKE '%$search_nama_escaped%')";
}
if (!empty($search_lokasi)) {
    $search_lokasi_escaped = mysqli_real_escape_string($koneksi, $search_lokasi);
    $where_clauses[] = "Lokasi = '$search_lokasi_escaped'";
}
if (!empty($search_jenis)) {
    $search_jenis_escaped = mysqli_real_escape_string($koneksi, $search_jenis);
    $where_clauses[] = "Jenis = '$search_jenis_escaped'";
}

$where = '';
if (!empty($where_clauses)) {
    $where = " WHERE " . implode(" AND ", $where_clauses);
}

// Fetch distinct locations for dropdown
$query_lokasi = mysqli_query($koneksi, "SELECT DISTINCT Lokasi FROM pelabuhan ORDER BY Lokasi");
$locations = [];
while ($row = mysqli_fetch_assoc($query_lokasi)) {
    $locations[] = $row['Lokasi'];
}

// Fetch distinct types for dropdown
$query_jenis = mysqli_query($koneksi, "SELECT DISTINCT Jenis FROM pelabuhan ORDER BY Jenis");
$types = [];
while ($row = mysqli_fetch_assoc($query_jenis)) {
    $types[] = $row['Jenis'];
}

?>

<div class="container mt-4">

    <!-- FORM INPUT DATA -->
    <div class="card mb-4">
        <div class="card-header">
            <h4>Input Sultra Seaport Data</h4>
        </div>
        <div class="card-body">

            <form action="input.php" method="POST" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Sultra Seaport</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Sultra Seaport</label>
                        <input type="text" class="form-control" name="jenis" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Kec./Kab.</label>
                        <input type="text" class="form-control" name="lokasi" list="lokasi-list" required>
                        <datalist id="lokasi-list">
                            <?php foreach ($locations as $loc) { ?>
                                <option value="<?= htmlspecialchars($loc); ?>">
                            <?php } ?>
                        </datalist>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status Operasional</label>
                        <input type="text" class="form-control" name="status" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Latitude</label>
                        <input type="text" class="form-control" name="latitude" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Longitude</label>
                        <input type="text" class="form-control" name="longitude" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Sultra Seaport</label>
                    <textarea class="form-control" name="deskripsi" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar Sultra Seaport</label>
                    <input type="file" class="form-control" name="gambar" accept="image/*" required>
                </div>

                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i>Simpan Data</button>

            </form>

        </div>
    </div>

    <hr>

    <!-- SEARCH & FILTER FORM -->
    <div class="card mb-4">
        <div class="card-header">
            <h4><i class="bi bi-search me-2"></i>Cari & Filter Data Pelabuhan</h4>
        </div>
        <div class="card-body">
            <form action="tabel.php" method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="search_nama" class="form-label">Nama/Deskripsi</label>
                        <input type="text" class="form-control" id="search_nama" name="search_nama" value="<?= htmlspecialchars($search_nama); ?>" placeholder="Cari nama atau deskripsi...">
                    </div>
                    <div class="col-md-3">
                        <label for="search_lokasi" class="form-label">Lokasi</label>
                        <select class="form-select" id="search_lokasi" name="search_lokasi">
                            <option value="">Semua Lokasi</option>
                            <?php foreach ($locations as $loc) { ?>
                                <option value="<?= htmlspecialchars($loc); ?>" <?= ($search_lokasi == $loc) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($loc); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="search_jenis" class="form-label">Jenis</label>
                        <select class="form-select" id="search_jenis" name="search_jenis">
                            <option value="">Semua Jenis</option>
                            <?php foreach ($types as $type) { ?>
                                <option value="<?= htmlspecialchars($type); ?>" <?= ($search_jenis == $type) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($type); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel me-2"></i>Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- TABEL DATA -->
    <h4 class="text-center mt-4">Sultra Seaport WebGIS: Data Pelabuhan</h4>

    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark text-center">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Lokasi</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        <?php
        $no = 1;
        $query = mysqli_query($koneksi, "SELECT * FROM pelabuhan" . $where);

        while ($data = mysqli_fetch_assoc($query)) {
        ?>
            <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td><?= $data['Nama']; ?></td>
                <td><?= $data['Jenis']; ?></td>
                <td><?= $data['Lokasi']; ?></td>
                <td><?= $data['Status']; ?></td>
                <td class="text-center action-buttons-cell d-flex justify-content-center flex-wrap gap-1">
                    <a href="detail.php?id=<?= $data['id']; ?>" 
                       class="btn btn-info btn-sm">
                       <i class="bi bi-eye"></i> Detail
                    </a>
                    <a href="edit.php?id=<?= $data['id']; ?>" 
                       class="btn btn-warning btn-sm">
                       <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <a href="hapus.php?id=<?= $data['id']; ?>" 
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Yakin ingin menghapus data ini?')">
                       <i class="bi bi-trash"></i> Hapus
                    </a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>

<?php include 'footer.php'; ?>
