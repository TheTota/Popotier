<?php



class Templater {

    private $twig;

    private static $instance;

    public static function getInstance(): Templater
    {
        if (self::$instance === null) {
            self::$instance = new Templater();
        }

        return self::$instance;
    }

    public function __construct()
    {
        require_once 'vendor/autoload.php';
        $loader = new \Twig\Loader\FilesystemLoader('./src/views/templates');
        $this->twig = new \Twig\Environment($loader, [
            //'cache' => './var/cache/twig',
        ]);
    }

    /**
     * @return \Twig\Environment
     */
    public function getTwig(): \Twig\Environment
    {
        return $this->twig;
    }
}