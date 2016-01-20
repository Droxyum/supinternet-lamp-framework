<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 20/01/2016
 * Time: 09:32
 */

namespace Core\Http\Routing;


use Core\Collection\StorageCollection;
use Core\Exception\NotFoundException;
use Core\Http\Request\Request;
use Core\Loader\ConfigLoader;

class Router
{
    private $Request;
    private $routing;

    public function __construct(Request &$Request) {
        $this->Request = &$Request;
        $this->loadConfig();
        $this->parse();
    }

    public function loadConfig() {
        $Loader = new ConfigLoader();
        $this->routing = $Loader->load('routing');
    }

    public function parse() {
        if($this->match()) {
            $this->getInfos();
            return true;
        }
        return false;
    }

    public function match() {
        foreach($this->routing as $key => $value) {
            $url = $value['path'];
            if (!empty($value['requirements'])) {
                foreach ($value['requirements'] as $k => $v) {
                    $url = str_replace($k, '(?P<'.str_replace(':', '', $k).'>'.$v.')', $url);
                }
            }
            $url = str_replace('/', '\/', $url);
            $url = '/^'.$url.'$/';
            $result = preg_match_all($url, $this->Request->getPath(), $matches, PREG_SET_ORDER );
            if ($result) {
                $this->Request->setRouteName($key);
                $this->Request->setUrlOrigin($value['path']);
                $params = $this->array_remove_numerical(!empty($matches[0]) ? $matches[0] : []);
                $this->Request->setParams(new StorageCollection($params));
                return true;
            }
        }
        $exception = new NotFoundException("Route not found");
        throw $exception;
    }

    private function getInfos() {
        $this->Request->setController($this->routing[$this->Request->getRouteName()]['controller']);
        $this->Request->setAction($this->routing[$this->Request->getRouteName()]['action']);
        $this->Request->setSecure((!empty($this->routing[$this->Request->getRouteName()]['secure'])) ? $this->routing[$this->Request->getRouteName()]['secure'] : false);
        return true;
    }

    private function array_remove_numerical(array $array) {
        foreach ($array as $key => $value) {
            if (is_int($key)) {
                unset($array[$key]);
            }
        }
        return $array;
    }
}