<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Bungkarno</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .container {
        width: 100%;
        height: 100vh;
    }

    .container nav {
        width: 100%;
        height: 12vh;
        display: flex;
        align-items: center;
        padding-left: 35px;
        position: relative;
    }

    .container nav h1 {
        font-family: "Titillium Web", sans-serif;
        font-size: 2.2rem;
        letter-spacing: 1px;
        color: white;
    }

    .container nav img {
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        z-index: -1;
    }

    .container main {
        width: 100%;
        height: 88vh;
        background: linear-gradient(90deg, rgb(255, 255, 255) 0%, rgb(255, 255, 255) 40%, rgb(255, 255, 255) 63%, rgba(255, 255, 255, 0) 100%);
        position: relative;
        display: flex;
        align-items: center;
    }

    .container main .box-pendaftaran {
        width: 50%;
        height: 35%;
        border-radius: 2vh;
        position: absolute;
        left: 100px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 25px 35px;
    }

    .container main .box-pendaftaran h3 {
        width: 100%;
        height: 20%;
        font-family: "Poppins", sans-serif;
        font-size: 1.8rem;
        display: flex;
        align-items: center;
        z-index: 1;
        color: white;
    }

    .container main .box-pendaftaran .daftar {
        width: 100%;
        height: 80%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
    }

    .container main .box-pendaftaran .daftar a {
        width: 100%;
        font-family: "Poppins", sans-serif;
        font-size: 1.5rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 15px 0;
        border-radius: 3vh;
        text-decoration: none;
        background-color: white;
        color: black;
    }

    .container main .box-pendaftaran .daftar a:hover {
        filter: drop-shadow(0px 6px 12px #680000);
    }

    .container main .box-pendaftaran img {
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        top: 0;
        border-radius: 2vh;
    }

    .container main img.background-image {
        height: 100%;
        position: absolute;
        right: 0;
        z-index: -1;
        border: none;
    }
</style>

<body>
    <div class="container">
        <nav>
            <h1>PERPUSTAKAAN MAKAM BUNG KARNO</h1>
            <img src="./image/background-merah-hd-header.png">
        </nav>
        <main>
            <div class="box-pendaftaran">
                <h3>Pendaftaran</h3>
                <div class="daftar">
                    <a href="./form-pendaftaran.php">Daftar Sekarang</a>
                </div>
                <img src="./image/background-merah-hd.png">
            </div>
            <img class="background-image" src="./image/patung bung karno.png">
        </main>
    </div>
</body>

</html>