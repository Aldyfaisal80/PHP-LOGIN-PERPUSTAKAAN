<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    echo "
        <script>
            confirm('Yakin dengan data Kamu?');
            
            document.location.href = 'http://localhost/loginAdmin/views/dashboard/formPendaftaranAnggota/';
        </script>";

    "<script>
    confirm('ingin cek data lagi')
    </script>";
    // Ambil data dari formulir pendaftaran anggota
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

    // File handling
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $foto = $_FILES['foto']['name'];
        $foto_temp = $_FILES['foto']['tmp_name'];
        $target = "../berkas/" . basename($foto);

        // Move the uploaded file to the specified directory
        move_uploaded_file($foto_temp, $target);
    } else {
        // Handle the case when no file is uploaded or an error occurs during upload
        $foto = "default.jpg"; // You can set a default image or handle it as needed
    }

    // Masukkan data anggota ke tabel anggota
    mysqli_query($kon, "INSERT INTO anggota SET
        nama = '$nama',
        nik = '$nik',
        jenis_kelamin = '$jenis_kelamin',
        tanggal_lahir = '$tanggal_lahir',
        alamat = '$alamat',
        telepon = '$telepon',
        email = '$email',
        password = '$password',
        pekerjaan = '$pekerjaan',
        pendidikan = '$pendidikan',
        foto = '$foto'
    ");

    // Ambil ID anggota yang baru saja didaftarkan
    $id_anggota = mysqli_insert_id($kon);

    // Ambil data petugas dari tabel petugas
    // $query_petugas = mysqli_query($kon, "SELECT * FROM petugas LIMIT 1");
    // $data_petugas = mysqli_fetch_assoc($query_petugas);

    // Gunakan data petugas yang telah diambil
    // $id_petugas = $data_petugas['id_petugas'];

    // Masukkan data kartu ke tabel kartu
    // mysqli_query($kon, "INSERT INTO kartu SET
    //     nik = '$nik',
    //     id_petugas = '$id_petugas',
    //     masa_berlaku = 'Seumur Hidup'
    // ");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Bungkarno</title>
    <!-- <link rel="stylesheet" href="./main.css> -->
    <link rel=" stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#selected_date").datepicker();
        });
    </script>
</head>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Caveat&family=Onest:wght@500&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: "Poppins", sans-serif;
    }

    .container {
        width: 100%;
        min-height: 100vh;
        padding: 4vh 10vh;
        background-image: url(./image/background-merah-hd.png);
        background-size: cover;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    section.box-formulir {
        background-color: white;
        min-width: 50%;
        height: auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 25px;
        padding: 35px 40px;
        border-radius: 3vh;
    }

    section.box-formulir h2 {
        font-size: 30px;
        display: flex;
        text-align: center;
    }

    section.box-formulir form {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    section.box-formulir form table {
        width: 100%;
    }

    section.box-formulir form tr td {
        height: 5vh;
    }

    section.box-formulir form td#titik-dua {
        width: 20px;
    }

    section.box-formulir form td textarea,
    section.box-formulir form input#text {
        width: 100%;
        padding: 5px 10px;
        border: 2px solid gray;
        border-radius: 7px;
        font-family: "Poppins", sans-serif;
    }

    section.box-formulir .box-button {
        margin-top: 20px;
        width: 100%;
        height: auto;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    section.box-formulir .box-button a {
        width: 60%;
        height: 100%;
        text-decoration: none;
    }

    section.box-formulir .box-button a button {
        font-family: "Poppins", sans-serif;
        font-size: 17px;
        font-weight: 600;
        width: 100%;
        padding: 10px 0;
        border-radius: 2vh;
        border: none;
        color: white;
        background-image: url(./image/background-merah-hd-header.png);
        background-size: cover;
        cursor: pointer;
    }

    section.box-formulir .box-button a button:hover {
        filter: drop-shadow(0px 6px 12px #c73333);
    }
</style>

<body>
    <div class="container">
        <!-- bagian box formulis-->
        <section class="box-formulir">

            <h2> Formulir Pendaftaran Anggota Baru</h2>

            <!-- bagian form-->
            <form action="" method="post" enctype="multipart/form-data">

                <table border="0" class="table-form">
                    <tr>
                        <td>Nama Lengkap</td>
                        <td id="titik-dua">:</td>
                        <td>
                            <input required id="text" type="text" name="nama" placeholder="Masukan Nama Lengkap" class="input-control">
                        </td>
                    </tr>
                    <tr>
                        <td>NIK</td>
                        <td id="titik-dua">:</td>
                        <td>
                            <input required id="text" type="number" name="nik" placeholder="Masukan NIK" class="input-control">
                        </td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td id="titik-dua">:</td>
                        <td>
                            <input required type="radio" name="jenis_kelamin" class="input-control" value="Laki-laki"> Laki-laki &nbsp;&nbsp;&nbsp;
                            <input required type="radio" name="jenis_kelamin" class="input-control" value="Perempuan"> Perempuan
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td id="titik-dua">:</td>
                        <td>
                            <input required id="text" type="date" name="tanggal_lahir" class="input-control">
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td id="titik-dua">:</td>
                        <td>
                            <textarea required name="alamat" placeholder="Masukan Alamat" class="input-control"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Telepon</td>
                        <td id="titik-dua">:</td>
                        <td>
                            <input required id="text" type="number" name="telepon" placeholder="Masukan No Telepon" class="input-control">
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td id="titik-dua">:</td>
                        <td>
                            <input required id="text" type="email" name="email" placeholder="Masukan Email" class="input-control">
                        </td>
                    </tr>
                    <tr>
                        <td>Pasword</td>
                        <td id="titik-dua">:</td>
                        <td>
                            <input required id="text" type="password" name="password" class="input-control" placeholder="Masukkan Password">
                        </td>
                    </tr>
                    <tr>
                        <td>Pendidikan</td>
                        <td id="titik-dua">:</td>
                        <td>
                            <input required id="text" type="text" class="input-control" name="pendidikan" placeholder="Pendidikan terakhir/saat ini">
                        </td>
                    </tr>
                    <tr>
                        <td>Pekerjaan</td>
                        <td id="titik-dua">:</td>
                        <td>
                            <input id="text" type="text" name="pekerjaan" class="input-control" placeholder="Pekerjaan">
                        </td>
                    </tr>

                    <tr>
                        <td>Foto</td>
                        <td id="titik-dua">:</td>
                        <td>
                            <input type='file' class='form-control' id='foto' name='foto'>
                        </td>
                    </tr>
                </table>
                <div class="box-button">
                    <a href="#">
                        <button type="submit" name="submit">Daftar Sekarang</button>
                    </a>
                </div>

            </form>

        </section>
    </div>
</body>

</html>