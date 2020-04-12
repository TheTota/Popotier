<?php

namespace Src\Routing;

class Route {

    private $name;
    private $path;
    private $requirements = [];
    private $controller;
    private $action;

    /**
     * Route constructor.
     * @param string $name
     * @param string $path
     * @param array|null $requirements
     * @param string $controller
     * @param string $action
     */
    public function __construct(string $name, string $path, array $requirements = [], string $controller, string $action)
    {
        $this->name = $name;
        $this->path = $path;
        foreach ($requirements as $key => $requirement){
            $this->requirements[$key] = '('.$requirement.')';
        }
        $this->controller = $controller;
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return array|null
     */
    public function getRequirements(): array
    {
        return $this->requirements;
    }

    /**
     * @param array|null $requirements
     */
    public function setRequirements(array $requirements)
    {
        $this->requirements = $requirements;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @param string $controller
     */
    public function setController(string $controller)
    {
        $this->controller = $controller;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setAction(string $action)
    {
        $this->action = $action;
    }

    /**
     * @param array|null $parameters
     * @return string
     *
     * Generate a url path, with the given parameters
     */
    public function generatePath(array $parameters = null): string {
        if($parameters){
            $path = $this->getPath();
            $parametersToReplace = [];
            preg_match_all('/{[a-z]+}/', $path, $parametersToReplace);

            foreach ($parametersToReplace as $key => $parameterToReplace){
                foreach ($this->requirements as $parameterName => $requirement){

                    if('{'.$parameterName.'}' == $parameterToReplace[$key] and preg_match($requirement, $parameters[$key])){
                        $path = str_replace($parameterToReplace, $parameters[$key], $path);
                    }
                }
            }

            return $path;

        } else {
            return $this->getPath();
        }
    }

}

