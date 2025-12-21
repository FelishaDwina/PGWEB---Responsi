<?php
include 'koneksi.php';

// Ambil data dari form
$nama = $_POST['nama'];
$jenis = $_POST['jenis'];
$lokasi = $_POST['lokasi'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$status = $_POST['status'];
$deskripsi = $_POST['deskripsi']; // Added deskripsi field

$gambar = null; // Initialize gambar variable

// Handle file upload
if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
    $target_dir = "img/"; // Upload directory
    $file_name = basename($_FILES["gambar"]["name"]);
    $target_file = $target_dir . $file_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $unique_name = uniqid() . "." . $imageFileType; // Generate a unique filename
    $target_file_unique = $target_dir . $unique_name;

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if($check !== false) {
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            exit();
        }
        // Check file size (e.g., 5MB limit)
        if ($_FILES["gambar"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            exit();
        }
        // Try to upload file
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file_unique)) {
            $gambar = $unique_name; // Store unique filename in database
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    } else {
        echo "File is not an image.";
        exit();
    }
} else if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] != 4) { // Error 4 means no file was uploaded
    echo "Error during file upload: " . $_FILES['gambar']['error'];
    exit();
}


// Query untuk insert data
$query = "INSERT INTO pelabuhan (Nama, Jenis, Lokasi, Latitude, Longitude, Status, Deskripsi, Gambar) 
          VALUES ('$nama', '$jenis', '$lokasi', '$latitude', '$longitude', '$status', '$deskripsi', '$gambar')";

// Eksekusi query
if (mysqli_query($koneksi, $query)) {
    // Redirect kembali ke halaman tabel jika berhasil
    header("Location: tabel.php");
    exit();
} else {
    // Tampilkan pesan error jika gagal
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}

// Tutup koneksi
mysqli_close($koneksi);
?>
