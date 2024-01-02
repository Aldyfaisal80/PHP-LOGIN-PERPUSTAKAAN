<?php
include('koneksi.php');

// Periksa apakah ID anggota disertakan dalam permintaan
if (isset($_GET['id'])) {
    $id_anggota = $_GET['id'];

    // Ambil data anggota berdasarkan ID
    $query_anggota = "SELECT * FROM anggota WHERE id_anggota = $id_anggota";
    $result_anggota = mysqli_query($kon, $query_anggota);

    // Ambil data kartu berdasarkan NIK
    $query_kartu = "SELECT * FROM kartu WHERE nik = (SELECT nik FROM anggota WHERE id_anggota = $id_anggota)";
    $result_kartu = mysqli_query($kon, $query_kartu);

    // Periksa apakah data anggota ditemukan
    if ($result_anggota && $result_kartu) {
        $data_anggota = mysqli_fetch_assoc($result_anggota);
        $data_kartu = mysqli_fetch_assoc($result_kartu);
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Detail Anggota</title>
            <link rel="stylesheet" href="./css/print.css">
            <style>
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }

                .container {
                    width: 100%;
                    height: 100vh;
                }

                .warp-img {
                    width: 100%;
                    display: flex;
                    justify-content: center;
                }

                .warp-img img {
                    width: 100%;
                    aspect-ratio: 6/4;
                    border-radius: 2vh;
                    border: 1px solid black;
                    transform: scale(0.8);
                }

                .warp-card {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    gap: 80px;
                    border: 1px solid black;
                    border-radius: 2vh;
                    width: 100%;
                    padding: 40px;
                    transform: scale(0.8);
                    aspect-ratio: 6/4;
                    font-size: 2.5rem;
                }

                .warp-side {
                    width: 100%;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                }

                .right-side img {
                    width: 300px;
                    aspect-ratio: 3/4;
                }
            </style>
        </head>

        <body>
            <div class="container">
                <div" class="warp-img">
                    <img class="logo" src="./source/image/logo perpus makam.png">
            </div>
            <div class="warp-card">
                <h1 style="text-align: center;">Anggota Perpustakaan</h1>
                <div class="warp-side">
                    <div class="left-side">
                        <p><strong>Nama:</strong> <?php echo $data_anggota['nama']; ?></p>
                        <p><strong>NIK:</strong> <?php echo $data_anggota['nik']; ?></p>
                        <p><strong>Jenis Kelamin:</strong> <?php echo $data_anggota['jenis_kelamin']; ?></p>
                        <p><strong>Tanggal Lahir:</strong> <?php echo $data_anggota['tanggal_lahir']; ?></p>
                        <p><strong>Alamat:</strong> <?php echo $data_anggota['alamat']; ?></p>
                        <p><strong>Telepon:</strong> <?php echo $data_anggota['telepon']; ?></p>
                        <p><strong>Pekerjaan:</strong> <?php echo $data_anggota['pekerjaan']; ?></p>
                        <p><strong>Pendidikan:</strong> <?php echo $data_anggota['pendidikan']; ?></p>
                        <p><strong>Masa Berlaku:</strong><span> Seumur hidup</span>
                    </div>
                    <div class="right-side">
                        <img class="profile" src='berkas/<?php echo $data_anggota['foto']; ?>' alt='Foto' width='100%' height="100%">
                    </div>
                </div>
            </div>
            </div>
        </body>

        </html>
<?php
    } else {
        echo "Error fetching data from the database.";
    }
} else {
    echo "ID anggota tidak ditemukan dalam permintaan.";
}
?>