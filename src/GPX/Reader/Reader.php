<?php

namespace Raistlfiren\GPS\GPX\Reader;


use Raistlfiren\GPS\GPX\Exception\InvalidFileException;
use Raistlfiren\GPS\GPX\Model\Bound;
use Raistlfiren\GPS\GPX\Model\Copyright;
use Raistlfiren\GPS\GPX\Model\Document;
use Raistlfiren\GPS\GPX\Model\Email;
use Raistlfiren\GPS\GPX\Model\Link;
use Raistlfiren\GPS\GPX\Model\Metadata;
use Raistlfiren\GPS\GPX\Model\Person;
use Raistlfiren\GPS\GPX\Model\Route\Route;
use Raistlfiren\GPS\GPX\Model\Track\Track;
use Raistlfiren\GPS\GPX\Model\Track\TrackSegment;
use Raistlfiren\GPS\GPX\Model\Waypoint\Waypoint;
use SimpleXMLElement;

class Reader
{

    private $file;

    /** @var SimpleXMLElement $xml */
    private $xml;

    /** @var \Raistlfiren\GPS\GPX\Model\Document $document */
    private $document;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function read()
    {
        $this->document = new Document();

        if ($this->isValidFile()) {
            $this->parseGPXAsObject();

            return $this->document;
        }

        return FALSE;
    }

    public function setProperty($property, $value, $class)
    {
        $method = "set{$property}";
        $class->$method($value);
    }

    public function findProperties($object)
    {
        $properties = get_object_vars($object);
        unset($properties['@attributes']);
        unset($properties['trkseg']);
        unset($properties['rtept']);

        return $properties;
    }

    public function isWaypoint($node)
    {
        return ($node === 'wpt' ? TRUE : FALSE);
    }

    public function isTrack($node)
    {
        return ($node === 'trk' ? TRUE : FALSE);
    }

    public function isRoute($node)
    {
        return ($node === 'rte' ? TRUE : FALSE);
    }

    public function isMetadata($node)
    {
        return ($node === 'metadata' ? TRUE : FALSE);
    }

    public function isLink($property)
    {
        return ($property === 'link' ? TRUE : FALSE);
    }

    public function isAuthor($property)
    {
        return ($property === 'author' ? TRUE : FALSE);
    }

    public function isCopyright($property)
    {
        return ($property === 'copyright' ? TRUE : FALSE);
    }

    public function isEmail($property)
    {
        return ($property === 'email' ? TRUE : FALSE);
    }

    public function isBounds($property)
    {
        return ($property === 'bounds' ? TRUE : FALSE);
    }

    public function areAttributesFilled($attributes)
    {
        return ( ! empty($attributes) ? TRUE : FALSE);
    }

    public function fillAttributes(SimpleXMLElement $xml)
    {
        $allAttributes = array();

        $attributes = (array) $xml->attributes();

        foreach($attributes as $attribute) {
            foreach ($attribute as $index => $value) {
                $allAttributes[$index] = $value;
            }
        }

        return $allAttributes;
    }

    public function parseLink(SimpleXMLElement $xml)
    {
        $link = new Link();

        $this->fillProperties($xml, $link);

        $allAttributes = $this->fillAttributes($xml);

        if ($this->areAttributesFilled($allAttributes))
            $link->setAttributes($allAttributes);

        return $link;
    }

    public function parseCopyright(SimpleXMLElement $xml)
    {
        $copyright = new Copyright();

        $allAttributes = $this->fillAttributes($xml);

        if ($this->areAttributesFilled($allAttributes))
            $copyright->setAttributes($allAttributes);

        $this->fillProperties($xml, $copyright);

        return $copyright;
    }

    public function parseAuthor(SimpleXMLElement $xml)
    {
        $person = new Person();

        $this->fillProperties($xml, $person);

        return $person;
    }

    public function parseEmail(SimpleXMLElement $xml)
    {
        $email = new Email();

        $attributes = $this->fillAttributes($xml);

        if ($this->areAttributesFilled($attributes))
            $email->setAttributes($attributes);

        return $email;
    }

    public function parseBounds(SimpleXMLElement $xml)
    {
        $bound = new Bound();

        $attributes = $this->fillAttributes($xml);

        if ($this->areAttributesFilled($attributes))
            $bound->setAttributes($attributes);

        return $bound;
    }

    public function fillProperties(SimpleXMLElement $xml, $object)
    {
        $properties = $this->findProperties($xml);

        foreach ($properties as $property => $value) {

            if ($this->isLink($property))
                $value = $this->parseLink($xml->link);

            if ($this->isAuthor($property))
                $value = $this->parseAuthor($xml->author);

            if ($this->isCopyright($property))
                $value = $this->parseCopyright($xml->copyright);

            if ($this->isEmail($property))
                $value = $this->parseEmail($xml->email);

            if ($this->isBounds($property))
                $value = $this->parseBounds($xml->bounds);

            $this->setProperty($property, $value, $object);
        }

        $attributes = $this->fillAttributes($xml);

        if ($this->areAttributesFilled($attributes))
            $object->setAttributes($attributes);

    }

    public function parseWaypoint(SimpleXMLElement $xml)
    {
        $waypoint = new Waypoint();

        $this->fillProperties($xml, $waypoint);

        $this->document->addWaypoint($waypoint);
    }

    public function parseTrack(SimpleXMLElement $xml)
    {
        $track = new Track();

        $this->fillProperties($xml, $track);

        foreach ($xml->trkseg as $trkseg) {

            $trackSegment = new TrackSegment();

            foreach ($trkseg->trkpt as $trkpt) {
                $waypoint = new Waypoint();

                $attributes = $this->fillAttributes($trkpt);

                if ($this->areAttributesFilled($attributes))
                    $waypoint->setAttributes($attributes);

                $trackSegment->addTrack($waypoint);
            }

            $track->addTrackSegment($trackSegment);
        }

        $this->document->addTrack($track);
    }

    public function parseRoute(SimpleXMLElement $xml)
    {
        $route = new Route();

        $this->fillProperties($xml, $route);

        foreach ($xml->rtept as $rtept) {

            $waypoint = new Waypoint();

            $this->fillProperties($rtept, $waypoint);

            $route->addRoutePoint($waypoint);
        }

        $this->document->addRoute($route);
    }

    public function parseMetadata(SimpleXMLElement $xml)
    {
        $metadata = new Metadata();

        $this->fillProperties($xml, $metadata);

        $this->document->setMetadata($metadata);
    }

    public function parseGPXAsObject()
    {

        $this->document = new Document();
        //Collect all root attributes for gpx
        $attributes = $this->fillAttributes($this->xml);

        if ($this->areAttributesFilled($attributes))
            $this->document->setAttributes($attributes);

        /**
         * @var  $index
         * @var SimpleXMLElement $xml
         */
        foreach ($this->xml as $index => $xml) {

            if ($this->isMetadata($index))
                $this->parseMetadata($xml);

            if ($this->isWaypoint($index))
                $this->parseWaypoint($xml);

            if ($this->isTrack($index))
                $this->parseTrack($xml);

            if ($this->isRoute($index))
                $this->parseRoute($xml);

        }

        /*while($this->xml->read()) {

            $this->document->setCreator($this->xml->getAttribute('creator'));
            $this->document->setVersion($this->xml->getAttribute('version'));

            if($this->xml->nodeType == \XMLReader::ELEMENT) {
                $nodeName[] = $this->xml->name;
            }

            if ($this->xml->localName == 'wpt' && $this->xml->nodeType == \XMLReader::ELEMENT)
                $this->parseWaypoints();

            if ($this->xml->localName == 'trk' && $this->xml->nodeType == \XMLReader::ELEMENT)
                $this->parseTracks();

            if ($this->xml->localName == 'trkseg' && $this->xml->nodeType == \XMLReader::ELEMENT)
                $this->parseTrackSegments();
        }*/

        /*foreach ($this->document->getTracks() as $track) {
            foreach ($track->getTrkseg() as $trackSegment) {
                foreach($trackSegment->getTrkpt() as $point) {
                    $test[] = $point->getLat();
                }
            }
        }*/

        //echo 'test';

    }

    public function isValidFile()
    {
        if ($this->doesFileExist()) {
            if ($this->isValidExtension()) {

                if ($this->isValidXML())
                    return TRUE;

            } else {
                throw new InvalidFileException("ERROR invalid file extension!", InvalidFileException::FileExtensionIncorrect);
            }
        } else {
            throw new InvalidFileException("ERROR file doesn't exist!", InvalidFileException::FileDoesntExist);
        }

    }

    public function doesFileExist()
    {
        return (file_exists($this->file) ? TRUE : FALSE);
    }

    public function isValidExtension()
    {
        $ext = pathinfo($this->file, PATHINFO_EXTENSION);

        if ($ext === 'gpx')
            return TRUE;

        return FALSE;
    }

    public function isValidXML()
    {
        $xml = new \XMLReader();
        $xml->open($this->file);

        try {
            //Check if it is the right schema
            $xml->setSchema(__DIR__ . '/../gpx.xsd');

            $this->xml = $xml;

            //Read the file to GPX element and open it with simpleXML
            while ($xml->read() && $xml->name === 'gpx') {
                $this->xml = new SimpleXMLElement($xml->readOuterXml());
            }
        } catch (\Exception $e) {
            throw new InvalidFileException("ERROR invalid XML file!", InvalidFileException::FileXMLInvalid);
        }

        return TRUE;
    }

}