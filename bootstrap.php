<?php

require_once './src/utils/Templater.php';
require_once './src/routing/RouterModule.php';
require_once './src/routing/Route.php';

use Symfony\Component\Yaml\Yaml;

session_start();
Templater::getInstance()->getTwig()->addGlobal('session', $_SESSION);
$pathFunction = new \Twig\TwigFunction('path', function (string $path_name, array $parameters = null) {
    $router = RouterModule::getInstance();
    echo $router->navigate($path_name);
   // echo $router->checkRoute($path_name);
});
Templater::getInstance()->getTwig()->addFunction($pathFunction);

$routesYML = Yaml::parse(file_get_contents('./src/routing/Routes.yml'));
$routerModule = RouterModule::getInstance();
foreach ($routesYML as $name => $route){
    $routerModule->addRoute(
        new Route(
            $name,
            $route['path'],
            $req = (isset($route['requirements']))? $route['requirements']: null
        )
    );
}

var_dump($routerModule->navigate('validate_recipe', ['5']));
