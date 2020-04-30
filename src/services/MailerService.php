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

    public static function sendMail(UserEntity $user)
    {
        require_once 'vendor/autoload.php';

        $twig = Templater::getInstance()->getTwig();

        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    // Enable verbose debug output
            $mail->isSMTP();                                          // Send using SMTP
            $mail->Host = self::$host;          // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = self::$username;            // SMTP username
            $mail->Password = self::$password;                         // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = self::$port;                                         // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom(self::$from, 'Mailer');
            $mail->addAddress($user->getEmail(), $user->getLastName() . ' ' . $user->getFirstName());    // Add a recipient

            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Verifiez votre email';
            $mail->Body = $twig->render('user/mail/confirmation-mail-template.html.twig', ['user' => $user]);
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}