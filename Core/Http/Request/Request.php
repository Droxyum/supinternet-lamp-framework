<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 13/01/2016
 * Time: 12:01
 */

namespace Core\Http\Request;


use Core\Collection\StorageCollection;

class Request
{
    private $method;
    private $host;
    private $statusCode;
    private $path;
    private $post;
    private $get;

    private $urlOrigin;
    private $routeName;
    private $params;

    private $controller;
    private $action;
    private $secure;

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

    public function getUrlOrigin()
    {
        return $this->urlOrigin;
    }

    public function setUrlOrigin($urlOrigin)
    {
        $this->urlOrigin = $urlOrigin;
    }

    public function getRouteName()
    {
        return $this->routeName;
    }

    public function setRouteName($routeName)
    {
        $this->routeName = $routeName;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function setParams($params)
    {
        $this->params = $params;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function setController($controller)
    {
        $this->controller = $controller;
    }
    public function getAction()
    {
        return $this->action;
    }

    public function setAction($action)
    {
        $this->action = $action;
    }

    public function getSecure()
    {
        return $this->secure;
    }

    public function setSecure($secure)
    {
        $this->secure = $secure;
    }

}