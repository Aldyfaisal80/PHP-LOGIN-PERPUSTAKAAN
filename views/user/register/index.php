<?php
require("../../../module/function.php");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (register() > 0) {
        echo "
        <script>
            alert('Berhasil Daftar');
            document.location.href='https://9ecc-118-99-112-9.ngrok-free.app/loginAdmin/'
        </script>";
    } else {
        echo "
        <script>
            alert('Daftar Gagal');
            document.location.href='https://9ecc-118-99-112-9.ngrok-free.app/loginAdmin/views/user/register/'
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Font Awesome Cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS -->
    <link rel="stylesheet" href="./src/css/main.css" />
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- JS -->
    <script src="./src/js/app.js" defer></script>
    <title>Register</title>
</head>

<body>
    <div id="root" class="container d-flex flex-column gap-5 justify-content-center align-items-center" style="height: 100vh;">
        <h1>Register</h1>
        <form class="w-50" action="" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">No Handphone</label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="address" name="address">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="password">
            </div>
            <div class="mb-3">
                <label for="confirm-password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm-password" name="confirm-password" value="password">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember</label>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
            <div>
                <span>Sudah memiliki akun?</span>
                <a href="https://9ecc-118-99-112-9.ngrok-free.app/loginAdmin/">Login</a>
            </div>
        </form>
    </div>
</body>

</html>