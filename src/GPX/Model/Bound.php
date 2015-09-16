<?php


namespace Raistlfiren\GPS\GPX\Model;


class Bound extends Attributes implements InterfaceXML
{

    public function mappedAttributes()
    {
        return array(
            'minlat' => 'float',
            'minlon' => 'float',
            'maxlat' => 'float',
            'maxlon' => 'float'
        );
    }

    public function readyXML()
    {
        return array();
    }

}