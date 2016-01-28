<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 20/01/2016
 * Time: 12:20
 */

namespace Core\Exception;


use Core\Service\Logger;

class Exception extends \Exception
{
    protected $className = false;

    public function __construct($message, $code = 0, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
        $Date = new \DateTime();
        $Logger = new Logger('/logs/error.log');
        $Logger->writeLine('['.$Date->getTimestamp().'] '.$message);
    }

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