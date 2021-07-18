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
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = $server;                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = $username;                     // SMTP username
    $mail->Password   = $password;                               // SMTP password
    $mail->SMTPSecure = $securetype;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = $port;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($username, 'Test Mail');
    $mail->addAddress($username);     // Add a recipient
    $mail->addReplyTo('info@example.com', 'Information');
    // // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $body='This is test mail.you configurations are correct.please save it.';
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Test Mail';
    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);

    $mail->send();
    $successmsg="Test Mail Sended to this email address :".$username."";
} catch (Exception $e) {
    $errormsg="Error !! Please Check Your Details";
}