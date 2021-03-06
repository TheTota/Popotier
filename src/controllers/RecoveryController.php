<?php
namespace src\controllers;

use src\services\LoginService;
use src\services\MailerService;
use src\services\UserService;
use src\utils\StringGenerator;
use src\utils\Templater;



class RecoveryController{

    /**
     * Action called when the password recovery page is loaded.
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function view(){
        $twig = Templater::getInstance()->getTwig();

        // check if entered mail and clicked on button
        if (isset($_POST['recovery'])) {
            // only send mail if the given email is linked to an activated account
            // TODO: make the link available for a few hours only
            $targetMail = $_POST['inputEmail'];
            if (UserService::emailExists($targetMail)) {
                $user = UserService::findByEmail($targetMail); // get user

                if ($user->getValid()) {
                    $user->setValidationString(StringGenerator::generateRandomString(30));
                    UserService::addValidationString($user->getId(), $user->getValidationString());

                    MailerService::sendMail(
                        $targetMail,
                        $user->getLastName() . ' ' . $user->getFirstName(),
                        'Réinitialisation de votre mot de passe',
                        $twig->render('user/mail/password-recovery-mail.html.twig', ['user' => $user])
                    );
                }
            }

            // update render to say signal an email has been sent
            echo $twig->render('login/password-recovery.html.twig', ["recoveryMailSent" => true]);
        } else {
            echo $twig->render('login/password-recovery.html.twig', []);
        }
    }

    public function proceedRecovery($validationString) {
        $twig = Templater::getInstance()->getTwig();

        // if user sets password and clicks validate button
        if (isset($_POST['passwordChange'])) {
            UserService::resetPassword($_POST['inputPassword'], $validationString);

            echo $twig->render('login/password-change.html.twig', ['passwordReset' => true, 'validationTokenExists' => true]);
        } else {
            $validationTokenExists = false;
            if (UserService::findByValidationString($validationString) != false) {
                $validationTokenExists = true;
            }
            echo $twig->render('login/password-change.html.twig', ['validationString' => $validationString, 'validationTokenExists' => $validationTokenExists]);
        }
    }
}