<?php


namespace Raistlfiren\GPS\GPX\Model;

use Countable;
use IteratorAggregate;
use ArrayAccess;

interface InterfaceCollection extends Countable, IteratorAggregate, ArrayAccess
{

    public function count();

    public function getIterator();

    public function offsetExists($offset);

    public function offsetGet($offset);

    public function offsetSet($offset, $value);

    public function offsetUnset($offset);

    public function getIteratorConstant();

}