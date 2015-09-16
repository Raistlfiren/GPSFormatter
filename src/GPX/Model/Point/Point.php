<?php

namespace Raistlfiren\GPS\GPX\Model\Point;


use Raistlfiren\GPS\GPX\Model\Attributes;

class Point extends Attributes
{

    private $ele;

    private $time;

    /**
     * @return mixed
     */
    public function getEle()
    {
        return $this->ele;
    }

    /**
     * @param mixed $ele
     * @return Point
     */
    public function setEle($ele)
    {
        $this->ele = (float)$ele;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     * @return Point
     */
    public function setTime($time)
    {
        $this->time = $time;
        return $this;
    }

    public function mappedAttributes()
    {
        return array(
            'lat' => 'float',
            'lon' => 'float'
        );
    }

}