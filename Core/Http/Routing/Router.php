<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 20/01/2016
 * Time: 09:32
 */

namespace Core\Http\Routing;


use Core\Http\Request\Request;

class Router
{
    private $Request;

    public function __construct(Request $Request) {
        $this->Request = $Request;
    }
}