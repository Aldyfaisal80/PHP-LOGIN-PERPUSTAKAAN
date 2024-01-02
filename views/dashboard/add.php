<?php
// Database connection
include('koneksi.php');

// Adding data to the database
if (isset($_POST['submit'])) {
    // Assuming you have form fields like nama, nik, jenis_kelamin, etc.
    $nama = $_POST['nama'];
    $nik = $_POST['nik'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $pekerjaan = $_POST['pekerjaan'];
    $pendidikan = $_POST['pendidikan'];

    // Assuming you have an input field named "foto" for file upload
    $foto = $_FILES['foto']['name'];

    // Image upload
    $target = "./berkas" . basename($foto);

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
    } else {
        $msg = "Failed to upload image";
    }

    $insert_data = "INSERT INTO anggota(nama, nik, jenis_kelamin, tanggal_lahir, alamat, telepon, email, password, pekerjaan, pendidikan, foto) VALUES ('$u_nama','$u_nik','$u_jenis_kelamin','$u_tanggal_lahir','$u_alamat','$u_telepon','$u_email','$u_password','$u_pekerjaan','$u_pendidikan','$u_foto')";

    $run_data = mysqli_query($kon, $insert_data);

    if ($run_data) {
        header('index.php');
    } else {
        echo "Data not inserted";
    }
}
