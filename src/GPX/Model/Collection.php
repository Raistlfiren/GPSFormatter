<?php


namespace Raistlfiren\GPS\GPX\Model;

use ArrayIterator;

class Collection implements InterfaceCollection
{

    public function count()
    {
        return count($this->getConstant());
    }

    public function getIterator()
    {
        $iterator = new ArrayIterator($this->getConstant());

        return $iterator;
    }

    public function offsetExists($offset)
    {
        return (isset($this->getIterator()[$offset]) ? TRUE : FALSE);
    }

    public function offsetGet($offset)
    {
        if ($this->offsetExists($offset))
            return $this->getIterator()[$offset];

        return FALSE;
    }

    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.
    }

    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset))
            unset($this->getIterator()[$offset]);

        return FALSE;
    }

    public function getIteratorConstant()
    {
        // TODO: Implement iteratorConstant() method.
    }

    protected function getConstant()
    {
        return $this->{$this->getIteratorConstant()}();
    }

    public function hasValues()
    {
        return ($this->count() > 0 ? TRUE : FALSE);
    }

}