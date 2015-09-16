<?php


namespace Raistlfiren\GPS\Tests\GPX\Writer;


use Raistlfiren\GPS\GPX\Model\Bound;
use Raistlfiren\GPS\GPX\Model\Copyright;
use Raistlfiren\GPS\GPX\Model\Document;
use Raistlfiren\GPS\GPX\Model\Email;
use Raistlfiren\GPS\GPX\Model\Link;
use Raistlfiren\GPS\GPX\Model\Metadata;
use Raistlfiren\GPS\GPX\Model\Person;
use Raistlfiren\GPS\GPX\Model\Track\Track;
use Raistlfiren\GPS\GPX\Model\Track\TrackSegment;
use Raistlfiren\GPS\GPX\Model\Waypoint\Waypoint;
use Raistlfiren\GPS\GPX\Writer\Writer;

class WriterTest extends \PHPUnit_Framework_TestCase
{

    /** @var Writer $document */
    private $writer;

    public function setUp()
    {
        $document = new Document();

        $attributes = array('creator' => 'John Doe', 'version' => 1.1);

        $document->setAttributes($attributes);

        $metadata = new Metadata();
        $metadata->setName('GPX File');
        $metadata->setDesc('Description');

        $author = new Person();
        $author->setName('John');

        $email = new Email();
        $attributes = array('id' => 'john', 'domain' => 'test.com');
        $email->setAttributes($attributes);
        $author->setEmail($email);
        $metadata->setAuthor($author);
        $copyright = new Copyright();
        $copyright->setYear(2005);
        $copyright->setLicense('MIT');
        $metadata->setCopyright($copyright);

        $link = new Link();
        $link->setAttributes(array('href' => 'test.com'));
        $metadata->setLink($link);
        $metadata->setKeywords('123');

        $bounds = new Bound();
        $bounds->setAttributes(array('minlat' => 1, 'minlon' => 5, 'maxlat' => 10, 'maxlon' => 20));
        $metadata->setBounds($bounds);

        $document->setMetadata($metadata);

        $waypoint = new Waypoint();

        $attributes = array('lat' => 46.57638889, 'lon' => 8.89263889);
        $waypoint->setAttributes($attributes);
        $waypoint->setEle(2372);
        $waypoint->setName('LAGORETICO');
        $document->addWaypoint($waypoint);

        $track = new Track();
        $track->setName('Example gpx');
        $track->setNumber(1);

        $ts = new TrackSegment();
        $waypoint = new Waypoint();
        $attributes = array("lat" => 46.57608333, "lon" => 8.89241667);
        $waypoint->setAttributes($attributes);
        $waypoint->setEle(2376);
        $waypoint->setTime('2007-10-14T10:09:57Z');
        $ts->addTrack($waypoint);
        $track->addTrackSegment($ts);

        $document->addTrack($track);

        $this->writer = new Writer($document);
    }

    public function testXMLParser()
    {
        $this->writer->write();
    }
}