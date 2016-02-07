<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 20/01/2016
 * Time: 10:31
 */

namespace Core\Loader;


use Core\Http\Request\Request;

/**
 * Class ControllerLoader
 * @package Core\Loader
 */
class ControllerLoader
{
    /**
     * @var string
     */
    private $file;
    /**
     * @var
     */
    private $controller;

    /**
     * ControllerLoader constructor.
     * @param $controller
     */
    public function __construct($controller) {
        $this->controller = $controller;
        $this->file = ROOT_DIR.'/App/Controller/'.ucfirst($this->controller).'Controller.php';
    }

    /**
     * @return bool
     */
    public function exist() {
        return file_exists($this->file);
    }

    /**
     * @param Request $Request
     * @return mixed
     */
    public function getInstance(Request $Request) {
        $namespace = '\\App\\Controller\\'.ucfirst($this->controller).'Controller';
        return new $namespace($Request);
    }
}