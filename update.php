<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve data from form
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jenis = mysqli_real_escape_string($koneksi, $_POST['jenis']);
    $lokasi = mysqli_real_escape_string($koneksi, $_POST['lokasi']);
    $latitude = mysqli_real_escape_string($koneksi, $_POST['latitude']);
    $longitude = mysqli_real_escape_string($koneksi, $_POST['longitude']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $old_gambar = mysqli_real_escape_string($koneksi, $_POST['old_gambar']);

    $gambar_update = $old_gambar; // Default to old image

    // Handle new image upload
    if (isset($_FILES['gambar_baru']) && $_FILES['gambar_baru']['error'] == 0) {
        $target_dir = "img/";
        $file_name = basename($_FILES["gambar_baru"]["name"]);
        $imageFileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $unique_name = uniqid() . "." . $imageFileType;
        $target_file_unique = $target_dir . $unique_name;

        // Validate image
        $check = getimagesize($_FILES["gambar_baru"]["tmp_name"]);
        if($check !== false) {
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                exit();
            }
            if ($_FILES["gambar_baru"]["size"] > 5000000) { // 5MB limit
                echo "Sorry, your file is too large.";
                exit();
            }

            // Upload new file
            if (move_uploaded_file($_FILES["gambar_baru"]["tmp_name"], $target_file_unique)) {
                // Delete old image if it exists
                if (!empty($old_gambar) && file_exists($target_dir . $old_gambar)) {
                    unlink($target_dir . $old_gambar);
                }
                $gambar_update = $unique_name; // Set to new unique filename
            } else {
                echo "Sorry, there was an error uploading your new file.";
                exit();
            }
        } else {
            echo "New file is not an image.";
            exit();
        }
    } else if (isset($_FILES['gambar_baru']) && $_FILES['gambar_baru']['error'] != 4) { // Error 4 means no file was uploaded
        echo "Error during new file upload: " . $_FILES['gambar_baru']['error'];
        exit();
    }

    // Update query
    $query = "UPDATE pelabuhan SET 
                Nama='$nama', 
                Jenis='$jenis', 
                Lokasi='$lokasi', 
                Latitude='$latitude', 
                Longitude='$longitude', 
                Status='$status', 
                Deskripsi='$deskripsi', 
                Gambar='$gambar_update' 
              WHERE id='$id'";

    if (mysqli_query($koneksi, $query)) {
        header("Location: tabel.php?update_success=true");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
} else {
    // If not a POST request, redirect or show error
    header("Location: tabel.php");
    exit();
}
?>