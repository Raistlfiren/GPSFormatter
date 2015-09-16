<?php


namespace Raistlfiren\GPS\GPX\Model\Waypoint;


use Raistlfiren\GPS\GPX\Model\Collection;

class WaypointCollection extends Collection
{

    private $waypoints;

    public function add(Waypoint $waypoint)
    {
        $this->waypoints[] = $waypoint;

        return $this;
    }

    public function totalWaypoints()
    {
        return count($this->waypoints);
    }

    public function hasWaypoints()
    {
        if (is_array($this->waypoints))
            return TRUE;

        return FALSE;
    }

    public function getWaypoints()
    {
        return $this->waypoints;
    }

    public function getIteratorConstant()
    {
        return 'getWaypoints';
    }

    /**
     * @param integer $offset
     * @return Waypoint
     */
    public function offsetGet($offset)
    {
        return parent::offsetGet($offset);
    }
}