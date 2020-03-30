<?php

// Twig Config
require_once './vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('./src/views/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => './var/cache/twig',
]);
session_start();
$twig->addGlobal('session', $_SESSION);