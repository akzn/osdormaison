<?php
require 'assets/PHPMailer/PHPMailerAutoload.php';

//$judul = $_POST['judul'];
//$isi = $_POST['isi'];

$judul = 'Test Mail';
$isi = "hello mail";

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 587; // or 587
$mail->IsHTML(true);
$mail->Username = "smtpserv mailaddress";
$mail->Password = "mail passowrd";
$mail->SetFrom("smtpserv mailaddress");
$mail->Subject = $judul;
$mail->Body = $isi;
$mail->AddAddress("mail recipient");

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}