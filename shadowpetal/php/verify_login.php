<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredOTP = $_POST['otp'];

    if(!isset($_SESSION['temp_login'])) {
        echo "No login in progress!";
        exit;
    }

    $temp = $_SESSION['temp_login'];

    if($enteredOTP === $temp['otp']) {
        // OTP correct, start session
        $_SESSION['username'] = $temp['username'];
        unset($_SESSION['temp_login']);
        echo "Login successful! Welcome, " . $_SESSION['username'] . ".";
        // Optionally redirect to dashboard
        // header("Location: ../dashboard.php");
    } else {
        echo "Wrong OTP!";
    }
}
?>
