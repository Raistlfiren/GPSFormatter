<?php

namespace Raistlfiren\GPS\GPX\Model;

use DateTime;

class Metadata implements InterfaceXML
{

    private $name;

    private $desc;

    private $author;

    private $copyright;

    private $link;

    private $time;

    private $keywords;

    private $bounds;

    private $extensions;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Metadata
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
     * @return Metadata
     */
    public function setDesc($desc)
    {
        $this->desc = (string)$desc;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param Person $author
     * @return Metadata
     */
    public function setAuthor(Person $author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCopyright()
    {
        return $this->copyright;
    }

    /**
     * @param Copyright $copyright
     * @return Metadata
     */
    public function setCopyright(Copyright $copyright)
    {
        $this->copyright = $copyright;
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
     * @return Metadata
     */
    public function setLink(Link $link)
    {
        $this->link = $link;
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
     * @return Metadata
     */
    public function setTime($time)
    {
        $this->time = new DateTime($time);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param mixed $keywords
     * @return Metadata
     */
    public function setKeywords($keywords)
    {
        $this->keywords = (string)$keywords;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBounds()
    {
        return $this->bounds;
    }

    /**
     * @param Bound $bounds
     * @return Metadata
     */
    public function setBounds(Bound $bounds)
    {
        $this->bounds = $bounds;
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
     * @return Metadata
     */
    public function setExtensions($extensions)
    {
        $this->extensions = $extensions;
        return $this;
    }

    public function readyXML()
    {
        return array(
            'name'          =>  $this->getName(),
            'desc'          =>  $this->getDesc(),
            'author'        =>  $this->getAuthor(),
            'copyright'     =>  $this->getCopyright(),
            'link'          =>  $this->getLink(),
            'time'          =>  $this->getTime(),
            'keywords'      =>  $this->getKeywords(),
            'bounds'        =>  $this->getBounds(),
            'extensions'    =>  $this->getExtensions()
        );
    }

}