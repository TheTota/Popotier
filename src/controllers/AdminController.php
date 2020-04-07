<?php

namespace Src\Controller;

class AdminController
{

    public static function viewAction()
    {
        $twig = \Templater::getInstance()->getTwig();

        //TODO: Get all recipes that need validation


        echo $twig->render('admin/admin-page.html.twig');
    }
}