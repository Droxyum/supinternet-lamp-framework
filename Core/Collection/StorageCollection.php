<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 20/01/2016
 * Time: 08:54
 */

namespace Core\Collection;


/**
 * Class StorageCollection
 * @package Core\Collection
 */
class StorageCollection implements \ArrayAccess, \IteratorAggregate
{
    /**
     * @var array
     */
    private $items;

    /**
     * StorageCollection constructor.
     * @param array $items
     */
    public function __construct(array $items) {
        $this->items = $items;
    }

    /**
     * @param $key
     * @return bool|StorageCollection
     */
    public function get($key) {
        if ($this->has($key)) {
            if (is_array($this->items[$key])) {
                return new StorageCollection($this->items[$key]);
            } else {
                return $this->items[$key];
            }
        }
        return false;
    }

    /**
     * @param $key
     * @param $value
     */
    public function set($key, $value) {
        $this->items[$key] = $value;
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key) {
        return array_key_exists($key, $this->items);
    }


    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * @param mixed $offset
     * @return bool|StorageCollection
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        return $this->set($offset, $value);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        if($this->has($offset)) {
            unset($this->items[$offset]);
        }
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }


}