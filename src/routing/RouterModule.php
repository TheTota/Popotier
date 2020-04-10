<?php

require_once 'src/routing/AbstractRouter.php';

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
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * @param array $routes
     */
    public function setRoutes(array $routes)
    {
        $this->routes = $routes;
    }


}