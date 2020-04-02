<?php


require_once './src/utils/Templater.php';

session_start();
Templater::getInstance()->getTwig()->addGlobal('session', $_SESSION);