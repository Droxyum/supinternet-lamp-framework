<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 13/01/2016
 * Time: 12:01
 */

namespace Core\Http\Request;


class Request
{
    private $method;
    private $host;
    private $statusCode;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->host = $_SERVER['SERVER_NAME'];
        $this->statusCode = $_SERVER['REDIRECT_STATUS'];
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }



}