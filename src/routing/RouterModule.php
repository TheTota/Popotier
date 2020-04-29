<?php

namespace Src\Routing;

class RouterModule extends AbstractRouter {

    public static $instance;

    protected $routes = [];

    public function __construct()
    {

    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new RouterModule();
        }

        return self::$instance;
    }

    /**
     * @param array $routes
     */
    public function setRoutes(array $routes)
    {
        $this->routes = $routes;
    }
}