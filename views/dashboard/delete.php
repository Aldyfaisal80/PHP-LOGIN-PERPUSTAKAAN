<?php
include('koneksi.php');

$id = $_GET['id_anggota'];

$delete = "DELETE FROM anggota WHERE id_anggota = $id";
$run_data = mysqli_query($kon, $delete);

if ($run_data) {
    header('location:index.php');
} else {
    echo "Delete failed";
}
?>
