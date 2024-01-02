<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: https://9ecc-118-99-112-9.ngrok-free.app/loginAdmin");
}

session_destroy();
$_SESSION = [];
session_unset();
header("Location: https://9ecc-118-99-112-9.ngrok-free.app/loginAdmin");
