<?php

date_default_timezone_set('Asia/Seoul');

ini_set("session.cookie_lifetime", 0);

session_start();
header('Content-Type: text/html; charset=UTF-8');

$db = new mysqli("localhost", "root", "", "side");
$db->set_charset("utf8");

function mq($sql)
{
    global $db;
    return $db->query($sql);
}

function me($sql)
{
    global $db;
    return mysqli_real_escape_string($db, $sql);
}

function alertRedirect($content, $url)
{
    echo "<script>alert('$content'); location.href='$url';</script>";
}

function redirect($url)
{
    echo "<script>location.href='$url';</script>";
}

require 'assets/src/Exception.php';
require 'assets/src/PHPMailer.php';
require 'assets/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Send an email using PHPMailer
 *
 * @param string $to Recipient email address
 * @param string $toName Recipient name
 * @param string $subject Email subject
 * @param string $body HTML email body
 * @param string $altBody Plain text email body
 * @return bool|string Returns true on success, or error message on failure
 */
function sendEmail($to, $toName, $subject, $body, $altBody)
{
    $mail = new PHPMailer(true); // Create a new PHPMailer instance

    try {
        // Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host = 'smtp.naver.com';                     // Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   // Enable SMTP authentication
        $mail->Username = '@naver.com';               // SMTP username
        $mail->Password = '';                        // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        // Recipients
        $mail->setFrom('@naver.com', '사이드');
        $mail->addAddress($to, $toName);                            // Add a recipient

        // Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AltBody = $altBody;
        $mail->CharSet = 'UTF-8';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

?>