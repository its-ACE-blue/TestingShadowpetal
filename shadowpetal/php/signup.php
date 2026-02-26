<?php
include 'config.php';
include 'functions.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Check if username/email exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? OR email=?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "Username or email already exists!";
        exit;
    }

    // Generate OTP and store temp in session
    $otp = generateOTP();
    $_SESSION['temp_user'] = ['username'=>$username, 'email'=>$email, 'password'=>$password, 'otp'=>$otp];

    if(sendOTP($email, $otp)) {
        header("Location: ../verify_signup.html");
    } else {
        echo "Failed to send OTP. Check your email settings.";
    }

    $stmt->close();
    $conn->close();
}
?>
