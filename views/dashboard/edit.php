<?php
include('koneksi.php');

$id = $_GET['id'];

// Fetching previous data to update
if (isset($_GET['id'])) {
    $edit_id = $_GET['id'];
    $edit_query = "SELECT * FROM anggota WHERE id_anggota = $edit_id";
    $edit_query_run = mysqli_query($kon, $edit_query);
    if (mysqli_num_rows($edit_query_run) > 0) {
        $edit_row = mysqli_fetch_array($edit_query_run);

        $e_nama = $edit_row['nama'];
        $e_nik = $edit_row['nik'];
        $e_jenis_kelamin = $edit_row['jenis_kelamin'];
        $e_tanggal_lahir = $edit_row['tanggal_lahir'];
        $e_alamat = $edit_row['alamat'];
        $e_telepon = $edit_row['telepon'];
        $e_email = $edit_row['email'];
        $e_password = $edit_row['password'];
        $e_pekerjaan = $edit_row['pekerjaan'];
        $e_pendidikan = $edit_row['pendidikan'];
        $e_foto = $edit_row['foto'];
    } else {
        // Handle error, for example, redirect to an error page
        echo "Error fetching data for update";
    }
} else {
    // Handle error, for example, redirect to an error page
    echo "Error, ID not provided for update";
}

// Data Updating
if (isset($_POST['submit'])) {
    $u_nama = $_POST['nama'];
    $u_nik = $_POST['nik'];
    $u_jenis_kelamin = $_POST['jenis_kelamin'];
    $u_tanggal_lahir = $_POST['tanggal_lahir'];
    $u_alamat = $_POST['alamat'];
    $u_telepon = $_POST['telepon'];
    $u_email = $_POST['email'];
    $u_password = $_POST['password'];
    $u_pekerjaan = $_POST['pekerjaan'];
    $u_pendidikan = $_POST['pendidikan'];
    $u_foto = $_FILES['foto']['name'];

    $msg = "";
    if (empty($u_foto)) {
        $u_foto = $e_foto;
    }

    $target = "berkas/" . basename($u_foto);

    $update = "UPDATE anggota SET 
                nama='$u_nama', 
                nik='$u_nik', 
                jenis_kelamin='$u_jenis_kelamin', 
                tanggal_lahir='$u_tanggal_lahir', 
                alamat='$u_alamat', 
                telepon='$u_telepon', 
                pekerjaan='$u_pekerjaan', 
                pendidikan='$u_pendidikan', 
                foto='$u_foto' 
                WHERE id_anggota=$id ";

    $run_update = mysqli_query($kon, $update);

    if ($run_update) {
        move_uploaded_file($_FILES['foto']['tmp_name'], $target);
        echo "<script>
            alert('Success! Data has been successfully updated!');
            window.location.href='https://9ecc-118-99-112-9.ngrok-free.app/loginAdmin/views/dashboard/';
            </script>";
    } else {
        echo "Data not updated";
    }
}
