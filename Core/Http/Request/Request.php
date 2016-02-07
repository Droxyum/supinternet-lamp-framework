<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 13/01/2016
 * Time: 12:01
 */

namespace Core\Http\Request;


use Core\Collection\StorageCollection;

/**
 * Class Request
 * @package Core\Http\Request
 */
class Request
{
    /**
     * @var
     */
    private $method;
    /**
     * @var
     */
    private $host;
    /**
     * @var
     */
    private $statusCode;
    /**
     * @var mixed
     */
    private $path;
    /**
     * @var StorageCollection
     */
    private $post;
    /**
     * @var StorageCollection
     */
    private $get;

    /**
     * @var
     */
    private $urlOrigin;
    /**
     * @var
     */
    private $routeName;
    /**
     * @var
     */
    private $params;

    /**
     * @var
     */
    private $controller;
    /**
     * @var
     */
    private $action;
    /**
     * @var
     */
    private $secure;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->host = $_SERVER['SERVER_NAME'];
        $this->statusCode = $_SERVER['REDIRECT_STATUS'];
        $this->path = str_replace(str_replace(' ', '%20', BASE_URL), '', $_SERVER['REQUEST_URI']);
        $this->post = new StorageCollection($_POST);
        $this->get = new StorageCollection($_GET);
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return mixed
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * @return StorageCollection
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @return StorageCollection
     */
    public function getGet()
    {
        return $this->get;
    }

    /**
     * @return mixed
     */
    public function getUrlOrigin()
    {
        return $this->urlOrigin;
    }

    /**
     * @param $urlOrigin
     */
    public function setUrlOrigin($urlOrigin)
    {
        $this->urlOrigin = $urlOrigin;
    }

    /**
     * @return mixed
     */
    public function getRouteName()
    {
        return $this->routeName;
    }

    /**
     * @param $routeName
     */
    public function setRouteName($routeName)
    {
        $this->routeName = $routeName;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getSecure()
    {
        return $this->secure;
    }

    /**
     * @param $secure
     */
    public function setSecure($secure)
    {
        $this->secure = $secure;
    }

}