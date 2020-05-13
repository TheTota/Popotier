<?php

namespace src\services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use src\models\UserEntity;
use src\utils\Templater;

/**
 * Class MailerService
 * @package src\services
 * PHPMailer Lib is used, see documentation here : https://github.com/PHPMailer/PHPMailer
 */
class MailerService
{
    private static $from = 'popotier@alwaysdata.net';
    private static $host = 'smtp-popotier.alwaysdata.net';
    private static $username = 'popotier@alwaysdata.net';
    private static $password = 'nopass@2020';
    private static $port = 25;


    private static $testHost = 'smtp.mailtrap.io';
    private static $testUsername = '840c85838225c4';
    private static $testPassword = 'ea768852a4b078';
    private static $testPort = 2525;


    public static function sendMail(string $targetEmail, string $targetFullName, string $subject, $body)
    {
        require_once 'vendor/autoload.php';

        $twig = Templater::getInstance()->getTwig();

        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    // Enable verbose debug output
            $mail->isSMTP();                                          // Send using SMTP
            $mail->Host = self::$testHost;          // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = self::$testUsername;            // SMTP username
            $mail->Password = self::$testPassword;                         // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = self::$testPort;                                         // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom(self::$from, "L'équipe Popotier");
            $mail->addAddress($targetEmail, $targetFullName);    // Add a recipient

            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}