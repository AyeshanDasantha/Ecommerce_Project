<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = 1;                      // Enable verbose debug output
    require 'smtpconfig.php';

    $mail->addAddress($email);     // Add a recipient
    $body='<b>Hello</b> '.$firstname.' '.$lastname.' ,
        <br>
        <b>You are successfuly added to our system</b>
        <br>
        <br>
        <b>your Login Email address :</b> '.$email.'
        <br>
        <b>your password :</b> '.$pw.'
        <br>
        <b>your Address :</b> '.$address.'
        <br>
        <b>your Contact No :</b> '.$contactno.'
        <br>
        <br>
        <b>You Can Change your password after login your Account</b>
        <br>
        <br>
        <b>URL</b>'.$sitelink.'/my-account/change-password.php
        <br>
        <br>
        <b>Login URL</b>'.$sitelink.'/login.php
        <br>
        <b>Forgot Password URL</b>'.$sitelink.'/forgot-password.php
        <br>
        <br>
        <b>Thank You</b>';
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'System Registration Details';
    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);

    $mail->send();
    $successmsg="User Details Send Him/His Email !!";
} catch (Exception $e) {
    $errormsg="Error Cant Send Email.Give Details Manualy !!";
}