<?php

namespace Raistlfiren\GPS\GPX\Model;


use Raistlfiren\GPS\GPX\Model\Route\Route;
use Raistlfiren\GPS\GPX\Model\Route\RouteCollection;
use Raistlfiren\GPS\GPX\Model\Track\Track;
use Raistlfiren\GPS\GPX\Model\Track\TrackCollection;
use Raistlfiren\GPS\GPX\Model\Waypoint\Waypoint;
use Raistlfiren\GPS\GPX\Model\Waypoint\WaypointCollection;

class Document extends Attributes implements InterfaceXML
{

    private $metadata;

    private $waypointCollection;

    private $routeCollection;

    private $trackCollection;

    private $extensions;

    public function __construct()
    {
        $this->waypointCollection = new WaypointCollection();
        $this->trackCollection = new TrackCollection();
        $this->routeCollection = new RouteCollection();
    }

    /**
     * @return Metadata
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @param Metadata $metadata
     * @return $this
     */
    public function setMetadata(Metadata $metadata)
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * @return WaypointCollection
     */
    public function getWaypointCollection()
    {
        return $this->waypointCollection;
    }

    /**
     * @param WaypointCollection $waypointCollection
     * @return $this
     */
    public function setWaypointCollection(WaypointCollection $waypointCollection)
    {
        $this->waypointCollection = $waypointCollection;

        return $this;
    }

    /**
     * @param Waypoint $waypoint
     * @return $this
     */
    public function addWaypoint(Waypoint $waypoint)
    {
        $this->waypointCollection->add($waypoint);

        return $this;
    }

    /**
     * @return RouteCollection
     */
    public function getRouteCollection()
    {
        return $this->routeCollection;
    }

    /**
     * @param RouteCollection $routeCollection
     * @return $this
     */
    public function setRouteCollection(RouteCollection $routeCollection)
    {
        $this->routeCollection = $routeCollection;

        return $this;
    }

    /**
     * @param Route $route
     * @return $this
     */
    public function addRoute(Route $route)
    {
        $this->routeCollection->add($route);

        return $this;
    }

    /**
     * @param TrackCollection $trackCollection
     * @return $this
     */
    public function setTrackCollection(TrackCollection $trackCollection)
    {
        $this->trackCollection = $trackCollection;

        return $this;
    }

    /**
     * @param Track $track
     * @return $this
     */
    public function addTrack(Track $track)
    {
        $this->trackCollection->add($track);

        return $this;
    }

    /**
     * @return TrackCollection
     */
    public function getTrackCollection()
    {
        return $this->trackCollection;
    }

    /**
     * @return mixed
     */
    public function getExtensions()
    {
        return $this->extensions;
    }

    /**
     * @param mixed $extensions
     * @return Document
     */
    public function setExtensions($extensions)
    {
        $this->extensions = $extensions;
        return $this;
    }

    public function mappedAttributes()
    {
        return array(
            'creator' => 'string',
            'version' => 'float'
        );
    }

    public function readyXML()
    {
        return array (
            'metadataType'  =>  $this->getMetadata(),
            'wptType'       =>  $this->getWaypointCollection(),
            'rteType'       =>  $this->getRouteCollection(),
            'trkType'       =>  $this->getTrackCollection(),
            'extensions'    =>  $this->getExtensions()
        );
    }

}