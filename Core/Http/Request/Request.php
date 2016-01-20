<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 13/01/2016
 * Time: 12:01
 */

namespace Core\Http\Request;


use Collection\StorageCollection;

class Request
{
    private $method;
    private $host;
    private $statusCode;
    private $path;
    private $post;
    private $get;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->host = $_SERVER['SERVER_NAME'];
        $this->statusCode = $_SERVER['REDIRECT_STATUS'];
        $this->path = str_replace(str_replace(' ', '%20', BASE_URL), '', $_SERVER['REQUEST_URI']);
        $this->post = new StorageCollection($_POST);
        $this->get = new StorageCollection($_GET);
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

    public function getPath() {
        return $this->path;
    }

    public function getPost()
    {
        return $this->post;
    }

    public function getGet()
    {
        return $this->get;
    }

}