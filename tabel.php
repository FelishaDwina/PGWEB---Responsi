<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sultra Seaport WebGIS</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <link rel="stylesheet" href="CSS/style.css">
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.html">Sultra Seaport</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.html"><i class="bi bi-house-door"></i> Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="peta.html"><i class="bi bi-geo-alt"></i> Peta</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tabel.html"><i class="bi bi-table"></i> Tabel Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="info.html"><i class="bi bi-info-circle"></i> Info</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid flex-grow-1">
<div class="container mt-4">

    <!-- FORM INPUT DATA -->
    <div class="card mb-4">
        <div class="card-header">
            <h4>Input Sultra Seaport Data</h4>
        </div>
        <div class="card-body">

            <form action="#" method="POST" enctype="multipart/form-data">

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

                <button type="submit" class="btn btn-primary" disabled><i class="bi bi-save me-2"></i>Simpan Data</button>

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
            <form action="#" method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="search_nama" class="form-label">Nama/Deskripsi</label>
                        <input type="text" class="form-control" id="search_nama" name="search_nama" value="" placeholder="Cari nama atau deskripsi...">
                    </div>
                    <div class="col-md-3">
                        <label for="search_lokasi" class="form-label">Lokasi</label>
                        <select class="form-select" id="search_lokasi" name="search_lokasi">
                            <option value="">Semua Lokasi</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="search_jenis" class="form-label">Jenis</label>
                        <select class="form-select" id="search_jenis" name="search_jenis">
                            <option value="">Semua Jenis</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100" disabled><i class="bi bi-funnel me-2"></i>Filter</button>
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
        </tbody>
    </table>

</div>
</div> <!-- /container-fluid -->

<footer class="footer mt-auto py-3 text-center">
  <p class="mb-0">© 2024 Sultra Seaport</p>
</footer>

</body>
</html>
