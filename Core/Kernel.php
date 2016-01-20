<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 13/01/2016
 * Time: 11:43
 */

namespace Core;


use Core\Controller\Controller;
use Core\Http\Request\Request;
use Core\Http\Routing\Router;

class Kernel
{
    private $Request;
    private $Router;
    private $Controller;

    public function __construct()
    {
        $this->Request = new Request();
        $this->Router = new Router($this->Request);
        $this->Controller = new Controller($this->Request);
    }
}