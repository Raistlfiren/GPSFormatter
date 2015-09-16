<?php
/**
 * Created by PhpStorm.
 * User: avalandra
 * Date: 9/5/15
 * Time: 12:46 PM
 */

namespace Raistlfiren\GPS\GPX\Model;


class Email extends Attributes implements InterfaceXML
{
    public function mappedAttributes()
    {
        return array(
            'id' => 'string',
            'domain' => 'string'
        );
    }

    public function readyXML()
    {
        return array();
    }
}