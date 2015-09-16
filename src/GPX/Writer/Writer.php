<?php


namespace Raistlfiren\GPS\GPX\Writer;


use Raistlfiren\GPS\GPX\Model\Collection;
use Raistlfiren\GPS\GPX\Model\Document;
use Raistlfiren\GPS\GPX\Model\Metadata;

class Writer
{

    /** @var Document $document */
    private $document;

    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    public function findMethods($object)
    {
        $properties = get_class_methods($object);

        return $properties;
    }

    public function getProperty($property, $value, $class)
    {
        $method = "get{$property}";
        $class->$method($value);
    }

    public function recursiveFunction($object, $gpx, $child = FALSE)
    {
        //$test[] = $gpx->addChild($value);
        /*$xmlValues = $object->readyXML();

        $counter = count($object->readyXML());

        foreach ($object->readyXML() as $element => $value) {
            $child = $gpx->addChild($element);

            if (is_object($value)) {

            }
        }

        for ($x = 0; $counter > $x; $x++) {
            if (! $child) { //Must be root child elements
                $
            }
        }*/


        foreach ($object->readyXML() as $index => $value) {
            if (! $value instanceof Collection) {
                if (is_object($value)) {
                    $child = $gpx->addChild($index);
                    return $this->steppingStone($value, $child);
                } else {
                    if ($child instanceof \SimpleXMLElement) {
                        $child->addChild($index, $value);
                    } else {
                        $gpx->addChild($index, $value);
                    }
                }
            }
        }

        //echo 'test';


    }

    /*public function steppingStone($object, $child)
    {
        foreach($object->readyXML() as $element => $value) {

            if (is_object($value)) {
                if (count($value->readyXML()) > 0) {
                    $grandChild = $child->addChild($element);
                    return $this->grandChildSteppingStone($value, $grandChild);
                }
            }

            $child->addChild($element, $value);

        }
    }

    public function grandChildSteppingStone($object, $child)
    {
        foreach($object->readyXML() as $element => $value) {

            if (is_object($value)) {
                if (count($value->readyXML()) > 0) {
                    $greatGrandChild = $child->addChild($element);
                    return $this->greatGrandChildSteppingStone($value, $greatGrandChild);
                }
            }

            $child->addChild($element, $value);

        }
    }

    public function greatGrandChildSteppingStone($object, $child)
    {
        foreach($object->readyXML() as $element => $value) {

            $child->addChild($element, $value);

        }
    }*/

    public function write()
    {
        $gpx = new \SimpleXMLElement("<gpx></gpx>");

        foreach ($this->document->getAttributes() as $index => $attribute) {
            $gpx->addAttribute($index, $attribute);
        }

        foreach ($this->document->readyXML() as $index => $value) {
            if (! $value instanceof Collection) {
                if (is_object($value)) {
                    $child = $gpx->addChild($index);
                    return $this->recursiveFunction($value, $child);
                } else {
                    $gpx->addChild($index, $value);
                }
            }
        }

        //$this->recursiveFunction($this->document, $gpx);

        /*foreach ($this->document->readyXML() as $index => $value) {
            $child = $gpx->addChild($index);

            if (! $value instanceof Collection) {
                foreach ($value->readyXML() as $index => $value) {
                    if (is_object($value)) {
                        $grandChild = $gpx->addChild($index);

                        foreach ($value->readyXML() as $index => $value) {
                            $grandChild->addChild($index);

                            if (is_object($value)) {
                                $greatGrandChild = $gpx->addChild($index);

                                foreach ($value->readyXML() as $index => $value) {
                                    $greatGrandChild->addChild($index, $value);
                                }
                            } else {
                                $grandChild->addChild($index, $value);
                            }
                        }
                    } else {
                        $child->addChild($index, $value);
                    }
                }
            }
        }*/

        if ($this->document->getMetadata() instanceof Metadata) {
            $metadata = $gpx->addChild('metadata');

            foreach ($this->document->getMetadata()->readyXML() as $index => $value) {
                if (is_object($value)){

                }
            }


            $metadata->addChild('name', $this->document->getMetadata()->getName());
        }

        if ($this->document->getWaypointCollection()->hasValues()) {
            $gpx->addChild('wpt');
        }

        //$gpx->addChild('wpt');

        /*foreach ($this->document->getWaypoints() as $waypoints) {
            foreach ($waypoints->getAttributes() as $index => $attribute) {
                $gpx->addAttribute($index, $attribute);
            }
        }*/

        $test = $gpx->asXML();

        /*$properties = $this->findMethods($this->document);

        foreach($properties as $index => $value) {
            echo 'hi';
        }*/

    }

}