<?php

namespace Raistlfiren\GPS\GPX\Model;


class Person implements InterfaceXML
{

    private $name;

    private $email;

    private $link;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Person
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return Person
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
     * @return Person
     */
    public function setLink($link)
    {
        $this->link = $link;
        return $this;
    }

    public function readyXML()
    {
        return array(
            'name'  => $this->getName(),
            'email' => $this->getEmail(),
            'link'  => $this->getLink()
        );
    }

}