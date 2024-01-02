<?php
// export.php

include 'koneksi.php';
$output = '';

if (isset($_POST["export"])) {
    $query = "SELECT * FROM anggota ORDER BY id_anggota DESC";
    $result = mysqli_query($kon, $query); // Menggunakan $kon daripada $nama
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $output .= '
            <table class="table" bordered="1">  
                <tr>  
                    <th>S.L</th>  
                    <th>Nama: </th>  
                    <th>NIK: </th>  
                    <th>Jenis Kelamin:</th>  
                    <th>Tanggal Lahir:</th>  
                    <th>Alamat:</th>
                    <th>Telepon:</th>
                    <th>Pekerjaan:</th>
                </tr>
            ';

            $i = 0;
            while ($row = mysqli_fetch_array($result)) {
                $sl = ++$i;
                $output .= '
                <tr>  
                    <td > ' . $sl . ' </td>
                    <td>' . $row["nama"] . '</td>  
                    <td>' . $row["nik"] . '</td>  
                    <td>' . $row["jenis_kelamin"] . '</td>  
                    <td>' . $row["tanggal_lahir"] . '</td>  
                    <td>' . $row["alamat"] . '</td>  
                    <td>' . $row["telepon"] . '</td> 
                    <td>' . $row["pekerjaan"] . '</td>  
                </tr>
                ';
            }

            $output .= '</table>';
            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename=Anggota_Data.xls');
            echo $output;
        } else {
            echo "Tidak ada data yang ditemukan";
        }
    } else {
        echo "Query gagal: " . mysqli_error($kon);
    }
}
?>
