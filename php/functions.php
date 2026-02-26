<?php
function generateOTP($length = 6) {
    return str_pad(rand(0, pow(10, $length)-1), $length, '0', STR_PAD_LEFT);
}

function sendOTP($email, $otp) {
    $subject = "Your OTP for Shadowpetal";
    $message = "Your OTP is: $otp";
    $headers = "From: no-reply@shadowpetal.com\r\n";

    if(mail($email, $subject, $message, $headers)) {
        return true;
    } else {
        return false;
    }
}
?>
