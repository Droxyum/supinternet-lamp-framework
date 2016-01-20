<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 20/01/2016
 * Time: 10:23
 */

namespace Core\Controller;


use Core\Http\Request\Request;
use Core\Orm\Orm;

class Controller
{
    protected $Request;
    protected $Orm;

    public function __construct(Request $Request) {
        $this->Request = $Request;
        $this->Orm = new Orm();
    }
}