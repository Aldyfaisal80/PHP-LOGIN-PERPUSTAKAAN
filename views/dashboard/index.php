<?php
include('koneksi.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anggota Perpustakaan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

</head>

<body>

    <div class="container">
        <h2>Anggota Baru</h2>
        <!-- <a href="#" class="btn btn-primary"><i class="fa fa-arrow-circle-left"></i> Back</a> -->
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#tambahAnggota">
            <i class="fa fa-plus"></i> Tambah Anggota
        </button>
        <a class="btn btn-danger" href="https://9ecc-118-99-112-9.ngrok-free.app/loginAdmin/views/user/logout/" onclick="return confirm('Yakin Ingin Logout?')">
            <i class="bi bi-box-arrow-left"></i> Logout
        </a>
        <hr>

        <table class="table table-bordered table-striped table-hover" id="myTable">
            <thead>
                <tr>
                    <th class="text-center" scope="col">No</th>
                    <th class="text-center" scope="col">Nama</th>
                    <th class="text-center" scope="col">NIK</th>
                    <th class="text-center" scope="col">Gander</th>
                    <th class="text-center" scope="col">Alamat</th>
                    <th class="text-center" scope="col">Telepon</th>
                    <th class="text-center" scope="col">Pekerjaan</th>
                    <th class="text-center" scope="col">Pendidikan</th>
                    <th class="text-center" scope="col">Lihat</th>
                    <th class="text-center" scope="col">Edit</th>
                    <th class="text-center" scope="col">Hapus</th>
                    <th class="text-center" scope="col">Cetak</th>
                </tr>
            </thead>

            <?php
            $get_data = "SELECT * FROM anggota ORDER BY id_anggota DESC";
            $run_data = mysqli_query($kon, $get_data);
            $i = 0;
            while ($row = mysqli_fetch_array($run_data)) {
                $sl = ++$i;
                $id = $row['id_anggota'];
                $nama = $row['nama'];
                $nik = $row['nik'];
                $gander = $row['jenis_kelamin'];
                $alamat = $row['alamat'];
                $telepon = $row['telepon'];
                $pekerjaan = $row['pekerjaan'];
                $pendidikan = $row['pendidikan'];

                echo "
                <tr>
                    <td class='text-center'>$sl</td>
                    <td class='text-left'>$nama</td>
                    <td class='text-left'>$nik</td>
                    <td class='text-left'>$gander</td>
                    <td class='text-left'>$alamat</td>
                    <td class='text-left'>$telepon</td>
                    <td class='text-center'>$pekerjaan</td>
                    <td class='text-center'>$pendidikan</td>
                    
                    <td class='text-center'>
                        <span>
                            <a href='#' class='btn btn-success mr-3 profile' data-toggle='modal' data-target='#view$id' title='Profile'><i class='fa fa-address-card-o' aria-hidden='true'></i></a>
                        </span>
                    </td>
                    <td class='text-center'>
                        <span>
                            <a href='#' class='btn btn-warning mr-3 edituser' data-toggle='modal' data-target='#edit$id' title='Edit'><i class='fa fa-pencil-square-o fa-lg'></i></a>
                        </span>
                    </td>
                    <td class='text-center'>
                        <span>
                            <a href='#' class='btn btn-danger deleteuser' title='Delete' data-toggle='modal' data-target='#delete$id'>
                                <i class='fa fa-trash-o fa-lg' aria-hidden='true'></i>
                            </a>
                        </span>
                    </td>


                    <td class='text-center'>
            <span>
                <a href='#' class='btn btn-info mr-3 print-user' title='Print' data-id='$id'>
                    <i class='fa fa-print'></i>
                </a>
            </span>
        </td>
                </tr>";
            }
            ?>
        </table>

        <form method="post" action="export.php">
            <input type="submit" name="export" class="btn btn-success" value="Export Data" />
        </form>

        <!-- Add modal -->

        <?php
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
            $target = "./berkas/" . basename($foto);

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
                $msg = "Image uploaded successfully";
            } else {
                $msg = "Failed to upload image";
            }

            $insert_data = "INSERT INTO anggota(nama, nik, jenis_kelamin, tanggal_lahir, alamat, telepon, email, password, pekerjaan, pendidikan, foto) VALUES ('$nama','$nik','$jenis_kelamin','$tanggal_lahir','$alamat','$telepon','$email','$password','$pekerjaan','$pendidikan','$foto')";

            $run_data = mysqli_query($kon, $insert_data);

            if ($run_data) {
                // Data berhasil ditambahkan, tambahkan script JavaScript untuk menampilkan alert dan refresh halaman
                echo '<script>window.location.href = window.location.href;</script>';
                // Redirect ke halaman tertentu jika diperlukan
                // header('Location: halaman_tujuan.php');
            } else {
                echo "Data not inserted";
            }
        }
        ?>

        <!-- Tambah data Anggota -->
        <div id="tambahAnggota" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-center">Tambah Anggota Baru</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" enctype="multipart/form-data">
                            <!-- Add your form fields here -->
                            <div class='form-group'>
                                <label for='nama'>Nama:</label>
                                <input type='text' class='form-control' id='nama' name='nama' required placeholder="Masukkan Nama Lengkap">
                            </div>
                            <div class='form-group'>
                                <label for='nik'>NIK:</label>
                                <input type='text' class='form-control' id='nik' name='nik' required placeholder="Masukkan NIK">
                            </div>
                            <div class='form-group'>
                                <label for='nik'>Jenis Kelamin:</label><br>
                                <input type="radio" name="jenis_kelamin" class="" value="Laki-laki"> Laki-laki &nbsp;&nbsp;&nbsp;
                                <input type="radio" name="jenis_kelamin" class="" value="Perempuan"> Perempuan
                            </div>
                            <div class='form-group'>
                                <label for='NIK'>Tanggal Lahir:</label><br>
                                <input type="date" name="tanggal_lahir" class="form-control" placeholder="Masukkan NIK">
                            </div>
                            <div class='form-group'>
                                <label for='nik'>Alamat:</label><br>
                                <textarea name="alamat" placeholder="Masukan Alamat" class="form-control"></textarea>
                            </div>
                            <div class='form-group'>
                                <label for='nik'>Telepon:</label><br>
                                <input type="text" name="telepon" placeholder="Masukan No Telepon" class="form-control">
                            </div>
                            <div class='form-group'>
                                <label for='nik'>Email:</label><br>
                                <input type="text" name="email" placeholder="Masukan Email" class="form-control">
                            </div>
                            <div class='form-group'>
                                <label for='nik'>Pasword:</label><br>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <div class='form-group'>
                                <label for='nik'>Pendidikan:</label><br>
                                <input required type="text" name="pendidikan" class="form-control" placeholder="Pendidikan Terakhir/Saat ini">
                            </div>
                            <div class='form-group'>
                                <label for='nik'>Pekerjaan:</label><br>
                                <input type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan">
                            </div>
                            <!-- php add -->



                            <!-- Add other form fields accordingly -->

                            <div class='form-group'>
                                <label for='foto'>Foto:</label>
                                <input type='file' class='form-control' id='foto' name='foto'>
                            </div>
                            <button type='submit' class='btn btn-primary' name='submit'>Tambah Anggota</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $get_data = "SELECT * FROM anggota";
        $run_data = mysqli_query($kon, $get_data);

        while ($row = mysqli_fetch_array($run_data)) {
            $id = $row['id_anggota'];
        ?>

            <!-- Delete model -->
            <div id='delete<?php echo $id; ?>' class='modal fade' role='dialog'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                            <h4 class='modal-title text-center'>Are you sure?</h4>
                        </div>
                        <div class='modal-body'>
                            <a href='delete.php?id_anggota=<?php echo $id; ?>' class='btn btn-danger' style='margin-left:250px'>Delete</a>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Edit model -->
            <div id='edit<?php echo $id; ?>' class='modal fade' role='dialog'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                            <h4 class='modal-title text-center'>Edit Data</h4>
                        </div>
                        <div class='modal-body'>
                            <form method='post' action='edit.php?id=<?php echo $id; ?>' enctype='multipart/form-data'>
                                <div class='form-group'>
                                    <label for='nama'>Nama:</label>
                                    <input type='text' class='form-control' id='nama' name='nama' value='<?php echo $row['nama']; ?>' required>
                                </div>
                                <div class='form-group'>
                                    <label for='nik'>NIK:</label>
                                    <input type='text' class='form-control' id='nik' name='nik' value='<?php echo $row['nik']; ?>' required>
                                </div>
                                <div class='form-group'>
                                    <label for='jenis_kelamin'>Jenis Kelamin:</label>
                                    <div>
                                        <input type="radio" name="jenis_kelamin" class="input-control" value="Laki-laki" <?php echo ($row['jenis_kelamin'] == 'Laki-laki') ? 'checked' : ''; ?>> Laki-laki &nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="jenis_kelamin" class="input-control" value="Perempuan" <?php echo ($row['jenis_kelamin'] == 'Perempuan') ? 'checked' : ''; ?>> Perempuan
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label for='tanggal_lahir'>Tanggal Lahir:</label>
                                    <input type='date' class='form-control' id='tanggal_lahir' name='tanggal_lahir' value='<?php echo $row['tanggal_lahir']; ?>' required>
                                </div>
                                <div class='form-group'>
                                    <label for='alamat'>Alamat:</label>
                                    <input type='text' class='form-control' id='alamat' name='alamat' value='<?php echo $row['alamat']; ?>' required>
                                </div>
                                <div class='form-group'>
                                    <label for='telepon'>Telepon:</label>
                                    <input type='text' class='form-control' id='telepon' name='telepon' value='<?php echo $row['telepon']; ?>' required>
                                </div>
                                <div class='form-group'>
                                    <label for='pekerjaan'>Pekerjaan:</label>
                                    <input type='text' class='form-control' id='pekerjaan' name='pekerjaan' value='<?php echo $row['pekerjaan']; ?>'>
                                </div>
                                <div class='form-group'>
                                    <label for='pendidikan'>Pendidikan:</label>
                                    <input type='text' class='form-control' id='pendidikan' name='pendidikan' value='<?php echo $row['pendidikan']; ?>' required>
                                </div>
                                <div class='form-group'>
                                    <label for='foto'>Foto:</label>
                                    <input type='file' class='form-control' id='foto' name='foto'>
                                    <img src='./berkas/<?php echo $row['foto']; ?>' alt='Foto' width='50'>
                                </div>
                                <button type='submit' class='btn btn-primary' name='submit'>Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>


        <!-- View modal -->
        <?php
        $get_data = "SELECT * FROM anggota";
        $run_data = mysqli_query($kon, $get_data);

        while ($row = mysqli_fetch_array($run_data)) {
            $id = $row['id_anggota'];
        ?>
            <div id='view<?php echo $id; ?>' class='modal fade' role='dialog'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                            <h4 class='modal-title text-center'>View Data</h4>
                        </div>
                        <div class='modal-body'>
                            <div style="float: left; margin-right: 10px;">
                                <p><strong>Foto:</strong> <img src='./berkas/<?php echo $row['foto']; ?>' alt='Foto' width='100%' height="100%"></p>
                            </div>
                            <p><strong>Nama:</strong> <?php echo $row['nama']; ?></p>
                            <p><strong>NIK:</strong> <?php echo $row['nik']; ?></p>
                            <p><strong>Jenis Kelamin:</strong> <?php echo $row['jenis_kelamin']; ?></p>
                            <p><strong>Tanggal Lahir:</strong> <?php echo $row['tanggal_lahir']; ?></p>
                            <p><strong>Alamat:</strong> <?php echo $row['alamat']; ?></p>
                            <p><strong>Telepon:</strong> <?php echo $row['telepon']; ?></p>
                            <p><strong>Pekerjaan:</strong> <?php echo $row['pekerjaan']; ?></p>
                            <p><strong>Pendidikan:</strong> <?php echo $row['pendidikan']; ?></p>


                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>





        <script>
            $(document).ready(function() {
                $('.print-user').click(function() {
                    var userId = $(this).data('id');

                    // Melakukan permintaan Ajax untuk mendapatkan konten dari halaman detail_cetak.php
                    $.ajax({
                        url: 'detail_cetak.php', // Sesuaikan dengan URL halaman detail_cetak.php
                        type: 'GET',
                        data: {
                            id: userId
                        }, // Kirim data ID jika diperlukan
                        success: function(response) {
                            var printContent = response;
                            var originalContent = $('body').html();

                            $('body').html(printContent);

                            // Simpan konten yang ingin dihapus
                            var scriptsToExclude = $('script[src*="cdn.datatables.net"]');

                            // Hapus konten yang ingin dihindari
                            scriptsToExclude.remove();

                            // Jalankan fungsi pencetakan
                            window.print();

                            // Kembalikan konten yang dihapus setelah pencetakan selesai
                            $('body').html(originalContent);

                            window.location.href = 'index.php';
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching content:', status, error);
                        }
                    });
                });
            });
        </script>






        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
            });
        </script>
</body>

</html>