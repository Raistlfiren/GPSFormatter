<?php

namespace Raistlfiren\GPS\GPX\Model\Track;


use Raistlfiren\GPS\GPX\Model\Link;
use Raistlfiren\GPS\GPX\Model\Track\TrackSegment;

class Track
{

    private $name;

    private $cmt;

    private $desc;

    private $src;

    private $link;

    private $number;

    private $type;

    private $extension;

    /** @var TrackSegmentCollection $trackSegmentCollection */
    private $trackSegmentCollection;

    public function __construct()
    {
        $this->trackSegmentCollection = new TrackSegmentCollection();
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
     * @return Track
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
     * @return Track
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
     * @return Track
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
     * @return Track
     */
    public function setSrc($src)
    {
        $this->src = $src;
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
     * @return Track
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
     * @return Track
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
     * @return Track
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
     * @return Track
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
        return $this;
    }

    /**
     * @return TrackSegmentCollection
     */
    public function getTrackSegmentCollection()
    {
        return $this->trackSegmentCollection;
    }

    /**
     * @param TrackSegmentCollection $trackSegmentCollection
     * @return $this
     */
    public function setTrackSegmentCollection(TrackSegmentCollection $trackSegmentCollection)
    {
        $this->trackSegmentCollection = $trackSegmentCollection;

        return $this;
    }

    /**
     * @param TrackSegment $trackSegment
     * @return $this
     */
    public function addTrackSegment(TrackSegment $trackSegment)
    {
        $this->trackSegmentCollection->add($trackSegment);

        return $this;
    }


}