<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 20/01/2016
 * Time: 10:23
 */

namespace Core\Controller;


use Core\DIC\DIC;
use Core\Http\Request\Request;
use Core\Orm\Orm;

class Controller
{
    protected $Request;
    protected $Orm;
    protected $container;

    public function __construct(Request $Request) {
        $this->Request = $Request;
        $this->Orm = new Orm();
        $this->container = new DIC();
        $this->fillContainer();
    }

    private function fillContainer() {
        $this->container->setInstance($this->Request);
        $this->container->setInstance($this->Orm);
    }
}