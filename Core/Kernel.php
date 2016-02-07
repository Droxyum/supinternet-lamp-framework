<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 13/01/2016
 * Time: 11:43
 */

namespace Core;


use Core\Exception\NotFoundException;
use Core\Http\Request\Request;
use Core\Http\Routing\Router;
use Core\Loader\ControllerLoader;
use Core\Service\Logger;

/**
 * Class Kernel
 * @package Core
 */
class Kernel
{
    /**
     * @var Request
     */
    private $Request;
    /**
     * @var Router
     */
    private $Router;
    /**
     * @var mixed
     */
    private $Controller;

    /**
     * Kernel constructor.
     */
    public function __construct()
    {
        try {
            $this->Request = new Request();
            $this->Router = new Router($this->Request);

            $ControllerLoader = new ControllerLoader($this->Request->getController());
            if ($ControllerLoader->exist()) {
                $this->Controller = $ControllerLoader->getInstance($this->Request);
                if (method_exists($this->Controller, $this->Request->getAction())) {
                    call_user_func([$this->Controller, $this->Request->getAction()], $this->Request->getParams());
                    $Logger = new Logger('/logs/access.log');
                    $Date = new \DateTime('now');
                    $Logger->writeLine('['.$Date->getTimestamp().'] Path:'.$this->Request->getPath().' type:'.$this->Request->getMethod());
                } else {
                    $exception = new NotFoundException('Path:'.$this->Request->getPath().', Action '.$this->Request->getAction().' not found in Controller '.ucfirst($this->Request->getController().'Controller'));
                    throw $exception;
                }
            } else {
                $exception = new NotFoundException('Path:'.$this->Request->getPath().', Controller '.ucfirst($this->Request->getController()).'Controller not found');
                throw $exception;
            }
        } catch(NotFoundException $e) {
            echo $e->cry();
        }
    }
}