<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once 'vendor/phpmailer/phpmailer/src/SMTP.php';
require_once 'vendor/phpmailer/phpmailer/src/Exception.php';
require_once 'config/constants.php';
require_once 'config/db.php';

require_once 'vendor/autoload.php';

/* Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
  ->setUsername(EMAIL)
  ->setPassword(PASSWORD); */

// Create the Mailer using your created Transport


function sendVerificationEmail($userEmail, $token) {
    
    //PHPMailer Object
    $mail = new PHPMailer(true);
    
    //From email address and name
    $mail->From = "arknightst722@gmail.com";
    $mail->FromName = "Alex";
    
    //To address and name
    $mail->addAddress("arknightst722@gmail.com", "Alex");
    $mail->addAddress("arknightst722@gmail.com"); //Recipient name is optional

    //Address to which recipient will reply
    $mail->addReplyTo("arknightst722@gmail.com", "Reply");

    //CC and BCC
    $mail->addCC("cc@example.com");
    $mail->addBCC("bcc@example.com");

    //Send HTML or Plain Text email
    $mail->isHTML(true);

    $mail->Subject = "Email Verification";
    $mail->Body = '<!doctype html>
            <html lang="en">
              <head>
                <meta charset="utf-8">
                <title>Verify email</title>
                <style>
                    .wrapper {
                        padding: 20px;
                        color: #444;
                        font-size: 1.3em;
                    }
                    a {
                        background: #592f80;
                        text-decoration: none;
                        padding: 8px 15px;
                        border-radius 5px;
                        color: #fff;
                    }
                </style>
              </head>
              <body>
                  <div class="wrapper">
                      <p>
                          Thank you for your registration on our website. Please click on the link below
                          to verify your email.
                      </p>
                      <a href="http://localhost/UserRegistration/index.php?token='.$token.'">
                          Verify your email address
                      </a>
                  </div>
              </body>
            </html>
            ';
    $mail->AltBody = "This is the plain text version of the email content";

    try {
        $mail->send();
        echo "Message has been sent successfully";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}


//function verifyEmail($token)
//{
//    global $conn;
//    $sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
//    $result = mysqli_query($conn, $sql);
//
//    if (mysqli_num_rows($result) > 0) {
//        $user = mysqli_fetch_assoc($result);
//        $query = "UPDATE users SET verified=1 WHERE token='$token'";
//
//        if (mysqli_query($conn, $query)) {
//            $_SESSION['username'] = $user['username'];
//            $_SESSION['email'] = $user['email'];
//            $_SESSION['verified'] = true;
//            $_SESSION['message'] = "Your email address has been verified successfully";
//            $_SESSION['type'] = 'alert-success';
//            header('location: index.php');
//            exit(0);
//        }
//    } else {
//        echo "User not found!";
//    }
//}


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>