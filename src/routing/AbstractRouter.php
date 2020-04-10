<?php

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
     * @param string $routeName
     * @param mixed[] $parameters
     * @return bool
     *
     * Navigate to a specified route, with specified parameters
     */
    public function navigate($routeName, $parameters = null){
        foreach($this->routes as $route){
            if($route->getName() == $routeName){
                return $route->generatePath($parameters);
            }
        }
        return false;
    }
}