<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
if ( isset( $_POST[ 'send' ] ) )
 {
    $mail = new PHPMailer( true );
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'medicalappointmentsystem100@gmail.com';
    $mail->Password = 'hmgvfdgpcvkqqnar';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom( 'medicalappointmentsystem100@gmail.com' );
    $mail->addAddress( $_POST[ 'email' ] );
    $mail->isHTML( true );
    $mail->Subject = $_POST[ 'subject' ];
    $mail->Body = $_POST[ 'message' ];
    $mail->send();
    echo "<script>alert
    ('sent successful');
    document.location.href='../admin/index.php';
    </script>";
}

?>