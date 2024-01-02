<?php
$db = "perpustakaan";

$connect = mysqli_connect("localhost", "root", "", $db);

if (!$connect) {
    die("Koneksi error" . mysqli_connect_error());
}

function generateId($length = 9)
{
    $chars = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890";
    $lengChars = strlen($chars);
    $output = "";
    for ($i = 0; $i < $length; $i++) {
        $output .= $chars[rand(0, $lengChars - 1)];
    }
    return $output;
}

function getData($sql)
{
    global $connect;
    $data = [];
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $data[] = $row;
    }
    return $data;
}

function register()
{
    global $connect;

    // Validate inputs
    $username = mysqli_real_escape_string($connect, stripslashes($_POST["name"]));
    $email = mysqli_real_escape_string($connect, stripslashes($_POST["email"]));
    $address = mysqli_real_escape_string($connect, stripslashes($_POST["address"]));
    $phone = mysqli_real_escape_string($connect, $_POST["phone"]);
    $password = mysqli_real_escape_string($connect, $_POST["password"]);
    $confirmPassword = mysqli_real_escape_string($connect, $_POST["confirm-password"]);

    // Additional input validation if needed

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo "
        <script>
            alert('Password tidak sesuai');
            document.location.href = 'http://localhost/loginAdmin/views/user/register/';
        </script>
        ";
        return false;
    }

    // Check for email and phone duplicates
    $emailDuplicatedResult = getData("SELECT email FROM petugas WHERE email = '$email'");
    $phoneDuplicatedResult = getData("SELECT phone FROM petugas WHERE phone = '$phone'");

    if (!empty($emailDuplicatedResult) && strtolower($email) === strtolower($emailDuplicatedResult[0]["email"])) {
        echo "
        <script>
            alert('Email sudah terdaftar.');
            document.location.href = 'http://localhost/loginAdmin/views/user/register/';
        </script>
        ";
        return false;
    }

    if (!empty($phoneDuplicatedResult) && $phone === $phoneDuplicatedResult[0]["phone"]) {
        echo "
        <script>
            alert('Nomor HP sudah terdaftar.');
            document.location.href = 'http://localhost/loginAdmin/views/user/register/';
        </script>
        ";
        return false;
    }

    // Hash the password
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    // Use prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($connect, "INSERT INTO petugas (id, name, email, phone, address, password) VALUES (?, ?, ?, ?, ?, ?)");
    
    // Generate 'id' within the SQL query
    $id = generateId(9);
    
    mysqli_stmt_bind_param($stmt, "ssssss", $id, $username, $email, $phone, $address, $passwordHashed);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Check for successful insertion
    if (mysqli_affected_rows($connect) > 0) {
        return true;
    } else {
        return false;
    }




    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO petugas (id,name,email,phone,address,password) VALUES ('$id','$username','$email','$phone','$address','$passwordHashed')";

    mysqli_query($connect, $sql);
    return mysqli_affected_rows($connect);
}
