<?php

namespace Raistlfiren\GPS\GPX\Model\Point;


class PointSegment
{

    private $points;

    /**
     * @return mixed
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param Point $point
     * @return $this
     */
    public function addPoints(Point $point)
    {
        $this->points = $point;
        return $this;
    }
}