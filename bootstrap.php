<?php

use src\utils\Templater;
use src\routing\Route;
use src\routing\RouterModule;
use Symfony\Component\Yaml\Yaml;

$GLOBALS['recipe_image_path'] = '/public/assets/recipes-image/';

// AUTOLOADER INIT
spl_autoload_register( function($className) {
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    include_once $_SERVER['DOCUMENT_ROOT'] . '/' . $className . '.php';
});

session_start();

// INIT OF TWIG
Templater::getInstance()->getTwig()->addGlobal('session', $_SESSION);
$pathFunction = new \Twig\TwigFunction('path', function (string $path_name, array $parameters = null) {
    $router = RouterModule::getInstance();
    echo $router->generatePath($path_name, $parameters);
});
Templater::getInstance()->getTwig()->addFunction($pathFunction);

// INIT OF THE ROUTER
$routesYML = Yaml::parse(file_get_contents('./src/routing/routes.yml'));
$routerModule = RouterModule::getInstance();
foreach ($routesYML as $name => $route){
    $routerModule->addRoute(
        new Route(
            $name,
            $route['path'],
            $requirements = (isset($route['requirements']))? $route['requirements']: [],
            $route['controller'],
            $route['action']
        )
    );
}
