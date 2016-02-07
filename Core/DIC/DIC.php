<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 20/01/2016
 * Time: 16:04
 */

namespace Core\DIC;



use Core\Exception\ReflectionException;

/**
 * Class DIC
 * @package Core\DIC
 */
class DIC
{
    /**
     * @var array
     */
    private $registry = [];
    /**
     * @var array
     */
    private $factories = [];
    /**
     * @var array
     */
    private $instances = [];


    /**
     * @param $key
     * @param callable $resolver
     */
    public function set($key, Callable $resolver) {
        $this->registry[$key] = $resolver;
    }

    /**
     * @param $key
     * @param callable $resolver
     */
    public function setFactory($key, Callable $resolver) {
        $this->factories[$key] = $resolver;
    }

    /**
     * @param $instance
     */
    public function setInstance($instance) {
        $reflection = new \ReflectionClass($instance);
        $this->instances[$reflection->getName()] = $instance;
    }

    /**
     * @param $key
     * @return mixed
     * @throws ReflectionException
     */
    public function get($key) {
        if (empty($this->factories[$key]) && !empty($this->registry[$key])) {
            return $this->factories[$key] = $this->registry[$key]();
        }

        if (empty($this->instances[$key])) {
            if (!empty($this->registry[$key])) {
                $this->instances[$key] = $this->registry[$key]();
            } else {
                $reflected_class = new \ReflectionClass($key);
                if ($reflected_class->isInstantiable()) {
                    $constructor = $reflected_class->getConstructor();
                    if ($constructor) {
                        $parameters = $constructor->getParameters();
                        $constructor_parameters = [];
                        foreach ($parameters as $parameter) {
                            if ($parameter->getClass()) {
                                $constructor_parameters[] = $this->get($parameter->getClass()->getName());
                            } else {
                                $constructor_parameters[] = $parameter->getDefaultValue();
                            }
                        }
                        $this->instances[$key] = $reflected_class->newInstanceArgs($constructor_parameters);
                    } else {
                        $this->instances[$key] = $reflected_class->newInstance();
                    }
                } else {
                    throw new ReflectionException('Class '.$reflected_class->getName().' cannot be instantiable');
                }
            }
        }

        return $this->instances[$key];
    }
}