<?php

namespace Raistlfiren\GPS\GPX\Model;


class Link extends Attributes implements InterfaceXML
{

    private $text;

    private $type;

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     * @return Link
     */
    public function setText($text)
    {
        $this->text = $text;
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
     * @return Link
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function mappedAttributes()
    {
        return array(
            'href' => 'string'
        );
    }

    public function readyXML()
    {
        return array(
            'text'  =>  $this->getText(),
            'type'  =>  $this->getType()
        );
    }
}