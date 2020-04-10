<?php

class Route {

    private $name;
    private $path;
    private $requirements = [];

    /**
     * Route constructor.
     * @param string $name
     * @param string $path
     * @param array|null $requirements
     */
    public function __construct(string $name, string $path, array $requirements = null)
    {
        $this->name = $name;
        $this->path = $path;
        $this->requirements = $requirements;
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
     * @param array|null $parameters
     * @return string
     *
     * Generate a url path, with the given parameters
     */
    public function generatePath(array $parameters = null): string{
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

