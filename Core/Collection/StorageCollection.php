<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 20/01/2016
 * Time: 08:54
 */

namespace Core\Collection;


class StorageCollection implements \ArrayAccess, \IteratorAggregate
{
    private $items;

    public function __construct(array $items) {
        $this->items = $items;
    }

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

    public function set($key, $value) {
        $this->items[$key] = $value;
    }

    public function has($key) {
        return array_key_exists($key, $this->items);
    }




    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        return $this->set($offset, $value);
    }

    public function offsetUnset($offset)
    {
        if($this->has($offset)) {
            unset($this->items[$offset]);
        }
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }


}