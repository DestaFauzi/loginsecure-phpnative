<?php
include "../conn/koneksi.php";

$email = $_POST['email'];
$password = $_POST['password'];

//Melindungi dari serangan XSS yang biasa menggunakan tag HTML untuk mencari celah dari website
$email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
$password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');

// Menggunakan prepared statement untuk melindungi dari serangan SQL Injection
$stmt = $mysqli->prepare("SELECT * FROM tbl_user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

//Atur HTTP-Only Flag pada Cookie
// setcookie('session', $sessionValue, ['httponly' => true]);

//melindungi header dari XSS dengan gunakan Content Security Policy (CSP):
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline';");

// Mengambil hasil dari pernyataan SQL
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($data) {
    // Memverifikasi password dengan password_verify()
    if (password_verify($password, $data['password'])) {
        session_start();
        $_SESSION['anu'] = $data;
        //Melindungi INPUT PASSWORD dengan MD5 password
        $password = MD5($_POST['password']);
        header('location:../index.php');
    } else {
        echo 'Invalid password.';
    }
} else {
    echo 'Email tidak terdaftar.';
}if(isset($_REQUEST['login'])){
    $password = $_REQUEST['password'];
    $captca = $_REQUEST['captcha'];
    $captcarandom = $_REQUEST['captcha-rand'];
}
if('$captca'!='$captcarandom'){
        echo "<script>alert('Captcha Salah')</script>";
    }
    else{
        $select_query = mysqli_query($mysqli, "SELECT * FROM tbl_user WHERE email = '$email' AND password = '$password'");
        $result = mysqli_num_rows($select_query);
    }if('$result' > 0){
            echo "<script>alert('Login Successful')</script>";
}else{
    echo "<script>alert('Login Failed')</script>";
}

// Menutup statement dan koneksi
$stmt->close();
$mysqli->close();
?>