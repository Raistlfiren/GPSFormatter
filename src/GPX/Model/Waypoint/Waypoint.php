<?php

namespace Raistlfiren\GPS\GPX\Model\Waypoint;

use Raistlfiren\GPS\GPX\Model\Attributes;

class Waypoint extends Attributes
{

    private $ele;

    private $time;

    private $magvar;

    private $geoidheight;

    private $name;

    private $cmt;

    private $desc;

    private $src;

    private $link;

    private $sym;

    private $type;

    private $fix;

    private $sat;

    private $hdop;

    private $vdop;

    private $pdop;

    private $ageofdgpsdata;

    private $dpgsid;

    private $extensions;

    /**
     * @return mixed
     */
    public function getEle()
    {
        return $this->ele;
    }

    /**
     * @param mixed $ele
     * @return Waypoint
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
     * @return Waypoint
     */
    public function setTime($time)
    {
        $this->time = $time;
        return $this;
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
     * @return Waypoint
     */
    public function setName($name)
    {
        $this->name = (string)$name;
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
     * @return Waypoint
     */
    public function setDesc($desc)
    {
        $this->desc = (string)$desc;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSym()
    {
        return $this->sym;
    }

    /**
     * @param mixed $sym
     * @return Waypoint
     */
    public function setSym($sym)
    {
        $this->sym = $sym;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMagvar()
    {
        return $this->magvar;
    }

    /**
     * @param mixed $magvar
     * @return Waypoint
     */
    public function setMagvar($magvar)
    {
        $this->magvar = $magvar;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGeoidheight()
    {
        return $this->geoidheight;
    }

    /**
     * @param mixed $geoidheight
     * @return Waypoint
     */
    public function setGeoidheight($geoidheight)
    {
        $this->geoidheight = $geoidheight;
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
     * @return Waypoint
     */
    public function setCmt($cmt)
    {
        $this->cmt = $cmt;
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
     * @return Waypoint
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
     * @param mixed $link
     * @return Waypoint
     */
    public function setLink($link)
    {
        $this->link = $link;
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
     * @return Waypoint
     */
    public function setType($type)
    {
        $this->type = (string)$type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFix()
    {
        return $this->fix;
    }

    /**
     * @param mixed $fix
     * @return Waypoint
     */
    public function setFix($fix)
    {
        $this->fix = $fix;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSat()
    {
        return $this->sat;
    }

    /**
     * @param mixed $sat
     * @return Waypoint
     */
    public function setSat($sat)
    {
        $this->sat = (int)$sat;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHdop()
    {
        return $this->hdop;
    }

    /**
     * @param mixed $hdop
     * @return Waypoint
     */
    public function setHdop($hdop)
    {
        $this->hdop = (float)$hdop;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVdop()
    {
        return $this->vdop;
    }

    /**
     * @param mixed $vdop
     * @return Waypoint
     */
    public function setVdop($vdop)
    {
        $this->vdop = (float)$vdop;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPdop()
    {
        return $this->pdop;
    }

    /**
     * @param mixed $pdop
     * @return Waypoint
     */
    public function setPdop($pdop)
    {
        $this->pdop = (float)$pdop;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAgeofdgpsdata()
    {
        return $this->ageofdgpsdata;
    }

    /**
     * @param mixed $ageofdgpsdata
     * @return Waypoint
     */
    public function setAgeofdgpsdata($ageofdgpsdata)
    {
        $this->ageofdgpsdata = $ageofdgpsdata;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDpgsid()
    {
        return $this->dpgsid;
    }

    /**
     * @param mixed $dpgsid
     * @return Waypoint
     */
    public function setDpgsid($dpgsid)
    {
        $this->dpgsid = $dpgsid;
        return $this;
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
     * @return Waypoint
     */
    public function setExtensions($extensions)
    {
        $this->extensions = $extensions;
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