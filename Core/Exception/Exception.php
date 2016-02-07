<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 20/01/2016
 * Time: 12:20
 */

namespace Core\Exception;


use Core\Service\Logger;

/**
 * Class Exception
 * @package Core\Exception
 */
class Exception extends \Exception
{
    /**
     * @var bool
     */
    protected $className = false;

    /**
     * Exception constructor.
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($message, $code = 0, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
        $Date = new \DateTime();
        $Logger = new Logger('/logs/error.log');
        $Logger->writeLine('['.$Date->getTimestamp().'] '.$message);
    }

    /**
     * @param $class
     */
    protected function setClass($class) {
        $this->className = $class;
    }

    /**
     * @return bool
     */
    protected function getClassName() {
        return $this->className;
    }

    /**
     * @return string
     */
    public function cry() {
        if ($this->className) {
            return '['.get_class($this).'] Error in: '.$this->getClassName().': '.$this->getMessage().' -  line '.$this->getLine()."\n<br>";
        } else {
            return '['.get_class($this).']: '.$this->getMessage()."\n<br>";
        }
    }
}