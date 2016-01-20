<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 13/01/2016
 * Time: 11:43
 */

namespace Core;


use Core\Http\Request\Request;
use Core\Http\Routing\Router;
use Core\Loader\ControllerLoader;

class Kernel
{
    private $Request;
    private $Router;
    private $Controller;

    public function __construct()
    {
        $this->Request = new Request();
        $this->Router = new Router($this->Request);

        $ControllerLoader = new ControllerLoader($this->Request->getController());
        if ($ControllerLoader->exist()) {
            $this->Controller = $ControllerLoader->getInstance($this->Request);
        }
    }
}