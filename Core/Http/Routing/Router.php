<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 20/01/2016
 * Time: 09:32
 */

namespace Core\Http\Routing;


use Core\Http\Request\Request;
use Core\Loader\ConfigLoader;

class Router
{
    private $Request;
    private $routing;

    public function __construct(Request $Request) {
        $this->Request = $Request;
        $this->loadConfig();
    }

    public function loadConfig() {
        $Loader = new ConfigLoader();
        $this->routing = $Loader->load('routing');
    }
}