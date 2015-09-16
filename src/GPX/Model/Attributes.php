<?php


namespace Raistlfiren\GPS\GPX\Model;


class Attributes implements InterfaceAttributes
{

    protected $attributes;

    protected $mappedAttributes;

    public function __construct()
    {
        $this->attributes = array();
    }

    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param mixed $attributes
     * @return Attributes
     */
    public function setAttributes($attributes)
    {
        $mappedAttributes = $this->mappedAttributes();

        foreach($attributes as $attribute => $value) {
            if(isset($mappedAttributes[$attribute])){
                $attributes[$attribute] = $this->typecastAttribute($attribute, $value, $mappedAttributes);
            } else {
                $attributes[$attribute] = $attribute;
            }
        }

        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @param $attribute
     * @param $value
     * @return mixed
     */
    protected function typecastAttribute($attribute, $value, $mappedAttributes)
    {
        settype($value, $mappedAttributes[$attribute]);

        return $value;
    }

    public function mappedAttributes() {}

}