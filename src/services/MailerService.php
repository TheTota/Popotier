<?php

namespace src\services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use src\utils\Templater;

/**
 * Class MailerService
 * @package src\services
 * PHPMailer Lib is used, see documentation here : https://github.com/PHPMailer/PHPMailer
 */
class MailerService
{


    public static function sendMail($user)
    {
        require_once 'vendor/autoload.php';

        $twig = Templater::getInstance()->getTwig();

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                    // Enable verbose debug output
            $mail->isSMTP();                                          // Send using SMTP
            $mail->Host = 'smtp-popotier.alwaysdata.net';             // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = 'popotier@alwaysdata.net';              // SMTP username
            $mail->Password = 'nopass@2020';                          // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 25;                                         // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('popotier@alwaysdata.net', 'Mailer');
            $mail->addAddress('alexandre.tomasia@gmail.com', 'Alexandre Tomasia');    // Add a recipient

            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Verifiez votre email';
            $mail->Body = $twig->render('user/mail/confirmation-mail-template.html.twig', ['user' => $user]);
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}