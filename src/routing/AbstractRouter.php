<?php

require_once 'src/controllers/RecipeController.php';

abstract class AbstractRouter {

    protected $routes; // Route[]

    /**
     * @param $routeName
     * @param $routeUrl
     *
     * Add a new route
     */
    public function addRoute($route) {
        $this->routes[$route->getName()] = $route;
    }

    public function checkRoute($routeName, $parameters = null){
        foreach($this->routes as $route){
            if($route->getName() == $routeName){
                return $route->getPath();
            } else {
                return false;
            }
        }
    }

    /**
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * @param string $routeName
     * @param mixed[] $parameters
     * @return bool
     *
     * Navigate to a specified route, with specified parameters
     */
    public function generatePath($routeName, $parameters = null){
        foreach($this->routes as $route){
            if($route->getName() == $routeName){
                return $route->generatePath($parameters);
            }
        }
        return false;
    }

    public function callController(Route $route, $parameters = null) {
        $controllerClass = '\Src\Controllers\\'.$route->getController();
        $controllerInstance = new $controllerClass();
        if($parameters){
            // TODO: Find a way to generalise this part
            switch(count($parameters)){
                case 1:
                    call_user_func(array($controllerInstance, $route->getAction()), $parameters[0]);
                    break;

                case 2:
                    call_user_func(array($controllerInstance, $route->getAction()), $parameters[0], $parameters[1]);
                    break;

                case 3:
                    call_user_func(array($controllerInstance, $route->getAction()), $parameters[0], $parameters[1], $parameters[2]);
                    break;

                default:
                    break;
            }
        }else{
            call_user_func(array($controllerInstance, $route->getAction()));
        }
    }

    /**
     * @param string $url
     *
     * Check if a url match a route and call the right controller if so.
     * @throws Exception If no route match the given url
     */
    public function checkURL(string $url) {
        foreach ($this->getRoutes() as $route){
            $path = $route->getPath();
            $parameters = [];

            if(!preg_match_all('/{([a-z]+)}/', $path, $parameters)){ // If the path does not contain any parameter
                if( $route->getPath() == $url) {
                    $this->callController($route);
                    return;
                }
            }else{ // if we have parameters in the path (ex: {id})
                $requirements = $route->getRequirements();

                foreach ($parameters[1] as $key =>$parameter){ // We replace all parameters in the path by regex
                    if(isset($requirements[$parameter])){ // if the parameter as requirements we put those in the path
                        $path = str_replace($parameters[0][$key], $requirements[$parameter], $path);
                    } else {
                        $path = str_replace($parameters[0][$key], '([a-z0-9]+)', $path);
                    }
                }

                if(preg_match('#'.$path.'$#', $url, $parameters)){// Once the path contain all the regex, we can check if the url match the path
                    $urlParameters = [];
                    for($i = 1; $i < count($parameters); $i++) {
                        array_push($urlParameters, $parameters[$i]);
                    }

                    $this->callController($route, $urlParameters);
                    return;
                }
            }
        }

        throw new Exception('page not found');
    }
}