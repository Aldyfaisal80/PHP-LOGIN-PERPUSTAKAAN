<?php
session_start();
require("../loginAdmin/module/function.php");

// if (isset($_SESSION["login"])) {
//     header("Location: http://localhost/loginAdmin/views/dashboard/");
// }

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (isset($_POST['remember'])) {
        $remember = $_POST["remember"];
    }
    $credentials = getData("SELECT * FROM petugas WHERE email = '$email'")[0];

    if ($credentials) {
        if (password_verify($password, $credentials["password"])) {
            $_SESSION["login"] = true;
            echo "
                <script>
                    alert('Berhasil Login');
                    document.location.href = 'https://9ecc-118-99-112-9.ngrok-free.app/loginAdmin/views/dashboard/';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Email atau Password Salah');
                    document.location.href = 'https://9ecc-118-99-112-9.ngrok-free.app/loginAdmin/';
                </script>
            ";
        }
    } else {
        echo "
            <script>
                alert('Email atau Password Salah');
                document.location.href = 'https://9ecc-118-99-112-9.ngrok-free.app/loginAdmin/';
            </script>
        ";
    }


    echo $email . "<br>";
    echo $password . "<br>";
    echo $remember . "<br>";
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
    <title>Perpustakaan Makam Bung Karno</title>
</head>

<body>
    <div id="root" class="container d-flex flex-column gap-5 justify-content-center align-items-center" style="height: 100vh;">
        <h1>Login Admin</h1>
        <form class="w-50" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <!-- <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember</label>
            </div> -->
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            <div>
                <span>Belum memiliki akun?</span>
                <a href="https://9ecc-118-99-112-9.ngrok-free.app/loginAdmin/views/user/register/">Register</a>
            </div>
        </form>
    </div>
</body>

</html>