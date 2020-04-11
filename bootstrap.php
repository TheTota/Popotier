<?php

require_once './src/utils/Templater.php';
require_once './src/routing/RouterModule.php';
require_once './src/routing/Route.php';

use Symfony\Component\Yaml\Yaml;


session_start();

// INIT OF TWIG
Templater::getInstance()->getTwig()->addGlobal('session', $_SESSION);
$pathFunction = new \Twig\TwigFunction('path', function (string $path_name, array $parameters = null) {
    $router = RouterModule::getInstance();
    echo $router->generatePath($path_name, $parameters);
});
Templater::getInstance()->getTwig()->addFunction($pathFunction);

// INIT OF THE ROUTER
$routesYML = Yaml::parse(file_get_contents('./src/routing/Routes.yml'));
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

//$routerModule->checkURL('/recipe/summary/5');die;
