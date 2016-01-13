<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 13/01/2016
 * Time: 11:43
 */

namespace Core;


use Core\Request\Request;

class Kernel
{
    private $Request;

    public function __construct()
    {
        $this->Request = new Request();
    }
}