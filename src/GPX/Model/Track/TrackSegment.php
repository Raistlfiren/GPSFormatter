<?php

namespace Raistlfiren\GPS\GPX\Model\Track;


use Raistlfiren\GPS\GPX\Model\Waypoint\Waypoint;
use Raistlfiren\GPS\GPX\Model\Waypoint\WaypointCollection;

class TrackSegment
{

    private $waypointCollection;

    public function __construct()
    {
        $this->waypointCollection = new WaypointCollection();
    }

    /**
     * @return WaypointCollection
     */
    public function getTrackCollection()
    {
        return $this->waypointCollection;
    }

    /**
     * @param WaypointCollection $waypointCollection
     * @return $this
     */
    public function setTrackCollection(WaypointCollection $waypointCollection)
    {
        $this->waypointCollection = $waypointCollection;

        return $this;
    }

    /**
     * @param Waypoint $waypoint
     * @return $this
     */
    public function addTrack(Waypoint $waypoint)
    {
        $this->waypointCollection->add($waypoint);

        return $this;
    }

}