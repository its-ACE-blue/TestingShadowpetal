<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredOTP = $_POST['otp'];
    if(!isset($_SESSION['temp_user'])) {
        echo "No signup in progress!";
        exit;
    }
    $temp = $_SESSION['temp_user'];

    if($enteredOTP === $temp['otp']) {
        $password = password_hash($temp['password'], PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username,email,password) VALUES (?,?,?)");
        $stmt->bind_param("sss",$temp['username'],$temp['email'],$password);
        $stmt->execute();
        unset($_SESSION['temp_user']);
        echo "Signup successful! <a href='../login.html'>Login now</a>";
    } else {
        echo "Wrong OTP!";
    }
}
?>
