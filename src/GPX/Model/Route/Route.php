<?php

namespace Raistlfiren\GPS\GPX\Model\Route;


use Raistlfiren\GPS\GPX\Model\Link;
use Raistlfiren\GPS\GPX\Model\Waypoint\Waypoint;
use Raistlfiren\GPS\GPX\Model\Waypoint\WaypointCollection;

class Route
{

    private $name;

    private $cmt;

    private $desc;

    private $src;

    private $link;

    private $number;

    private $type;

    private $extension;

    public function __construct()
    {
        $this->waypointCollection = new WaypointCollection();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Route
     */
    public function setName($name)
    {
        $this->name = (string)$name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCmt()
    {
        return $this->cmt;
    }

    /**
     * @param mixed $cmt
     * @return Route
     */
    public function setCmt($cmt)
    {
        $this->cmt = $cmt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @param mixed $desc
     * @return Route
     */
    public function setDesc($desc)
    {
        $this->desc = (string)$desc;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * @param mixed $src
     * @return Route
     */
    public function setSrc($src)
    {
        $this->src = (string)$src;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param Link $link
     * @return Route
     */
    public function setLink(Link $link)
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     * @return Route
     */
    public function setNumber($number)
    {
        $this->number = (string)$number;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return Route
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param mixed $extension
     * @return Route
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
        return $this;
    }

    /**
     * @return WaypointCollection
     */
    public function getRoutePointCollection()
    {
        return $this->waypointCollection;
    }

    /**
     * @param WaypointCollection $waypointCollection
     * @return $this
     */
    public function setRoutePointCollection(WaypointCollection $waypointCollection)
    {
        $this->waypointCollection = $waypointCollection;

        return $this;
    }

    /**
     * @param Waypoint $waypoint
     * @return $this
     */
    public function addRoutePoint(Waypoint $waypoint)
    {
        $this->waypointCollection->add($waypoint);

        return $this;
    }


}