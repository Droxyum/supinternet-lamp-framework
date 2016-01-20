<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 20/01/2016
 * Time: 12:20
 */

namespace Core\Exception;


class Exception extends \Exception
{
    protected $className = false;

    protected function setClass($class) {
        $this->className = $class;
    }

    protected function getClassName() {
        return $this->className;
    }

    public function cry() {
        if ($this->className) {
            return '['.get_class($this).'] Error in: '.$this->getClassName().': '.$this->getMessage().' -  line '.$this->getLine()."\n<br>";
        } else {
            return '['.get_class($this).']: '.$this->getMessage()."\n<br>";
        }
    }
}