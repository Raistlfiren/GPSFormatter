<?php

namespace Raistlfiren\GPS\GPX\Model;


class Copyright extends Attributes implements InterfaceXML
{

    private $year;

    private $license;

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     * @return Copyright
     */
    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLicense()
    {
        return $this->license;
    }

    /**
     * @param mixed $license
     * @return Copyright
     */
    public function setLicense($license)
    {
        $this->license = $license;
        return $this;
    }

    public function mappedAttributes()
    {
        return array(
            'author' => 'string'
        );
    }

    public function readyXML()
    {
        return array(
            'year'      =>  $this->getYear(),
            'license'   =>  $this->getLicense()
        );
    }

}