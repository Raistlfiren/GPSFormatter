<?php

namespace Raistlfiren\GPS\Tests\GPX\Reader;

use Raistlfiren\GPS\GPX\Exception\InvalidFileException;
use Raistlfiren\GPS\GPX\Model\Bound;
use Raistlfiren\GPS\GPX\Model\Copyright;
use Raistlfiren\GPS\GPX\Model\Document;
use Raistlfiren\GPS\GPX\Model\Link;
use Raistlfiren\GPS\GPX\Model\Metadata;
use Raistlfiren\GPS\GPX\Model\Person;
use Raistlfiren\GPS\GPX\Model\Route;
use Raistlfiren\GPS\GPX\Model\Track\Track;
use Raistlfiren\GPS\GPX\Model\Track\TrackCollection;
use Raistlfiren\GPS\GPX\Model\Track\TrackSegmentCollection;
use Raistlfiren\GPS\GPX\Model\Waypoint\Waypoint;
use Raistlfiren\GPS\GPX\Model\Waypoint\WaypointCollection;
use Raistlfiren\GPS\GPX\Reader\Reader;
use Raistlfiren\GPS\GPX\Model\Route\RouteCollection;

class ReaderTest extends \PHPUnit_Framework_TestCase
{

    /** @var \Raistlfiren\GPS\GPX\Reader\Reader $reader */
    private $reader;

    public function setUp()
    {
        $file = __DIR__ . '/../../data/barret_spur.gpx';
        $this->reader = new \Raistlfiren\GPS\GPX\Reader\Reader($file);
    }

    public function testMetaData()
    {
        $file = __DIR__ . '/../../data/pytrainer.gpx';
        $this->reader = new \Raistlfiren\GPS\GPX\Reader\Reader($file);
        $dump = $this->reader->read();

        $this->assertTrue($dump->getMetadata() instanceof Metadata);
        $this->assertTrue($dump->getMetadata()->getAuthor() instanceof Person);
        $this->assertTrue($dump->getMetadata()->getCopyright() instanceof Copyright);
        $this->assertTrue($dump->getMetadata()->getLink() instanceof Link);
        $this->assertTrue($dump->getMetadata()->getTime() instanceof \DateTime);
        $this->assertTrue($dump->getMetadata()->getBounds() instanceof Bound);

    }

    public function testTrackReader()
    {
        $dump = $this->reader->read();

        $this->assertTrue($dump instanceof Document);

        $this->assertTrue($dump->getWaypointCollection() instanceof WaypointCollection);

        $this->assertTrue($dump->getWaypointCollection()->offsetGet(0) instanceof Waypoint);

        $this->assertEquals(4, $dump->getWaypointCollection()->count());

        $this->assertTrue($dump->getTrackCollection() instanceof TrackCollection);

        $this->assertEquals(2, $dump->getTrackCollection()->count());

        $this->assertTrue($dump->getTrackCollection()->offsetGet(0) instanceof Track);

        $this->assertTrue($dump->getTrackCollection()->offsetGet(0)->getTrackSegmentCollection() instanceof TrackSegmentCollection);

        $this->assertEquals(2, $dump->getTrackCollection()->offsetGet(0)->getTrackSegmentCollection()->count());

        $this->assertTrue($dump->getTrackCollection()->offsetGet(0)->getTrackSegmentCollection()->offsetGet(0)->getTrackCollection() instanceof WaypointCollection);

        $this->assertEquals(53, $dump->getTrackCollection()->offsetGet(0)->getTrackSegmentCollection()->offsetGet(0)->getTrackCollection()->count());

    }

    public function testRouteReader()
    {
        $file = __DIR__ . '/../../data/routes.gpx';
        $this->reader = new \Raistlfiren\GPS\GPX\Reader\Reader($file);

        $dump = $this->reader->read();

        $this->assertTrue($dump instanceof Document);

        $this->assertTrue($dump->getMetadata() instanceof Metadata);

        $this->assertTrue($dump->getRouteCollection() instanceof RouteCollection);

        $this->assertEquals(1, $dump->getRouteCollection()->count());

        $this->assertTrue($dump->getRouteCollection()->offsetGet(0)->getRoutePointCollection() instanceof WaypointCollection);

        $this->assertEquals(4, $dump->getRouteCollection()->offsetGet(0)->getRoutePointCollection()->count());

        $this->assertTrue($dump->getRouteCollection()->offsetGet(0)->getRoutePointCollection()->offsetGet(0) instanceof Waypoint);
    }

    public function testIsWaypointTrue()
    {
        $test = $this->reader->isWaypoint('wpt');
        $this->assertTrue($test);
    }

    public function testIsWaypointFalse()
    {
        $test = $this->reader->isWaypoint('trk');
        $this->assertFalse($test);
    }

    public function testIsTrackTrue()
    {
        $test = $this->reader->isTrack('trk');
        $this->assertTrue($test);
    }

    public function testIsTrackFalse()
    {
        $test = $this->reader->isTrack('wpt');
        $this->assertFalse($test);
    }

    public function testIsRouteTrue()
    {
        $test = $this->reader->isRoute('rte');
        $this->assertTrue($test);
    }

    public function testIsRouteFalse()
    {
        $test = $this->reader->isRoute('trk');
        $this->assertFalse($test);
    }

    public function testFindProperties()
    {
        $class = new \stdClass();
        $class->trkseg = TRUE;
        $class->ele = TRUE;

        $properties = $this->reader->findProperties($class);

        $this->assertEquals(array('ele' => TRUE), $properties);

    }

    public function testProperty()
    {
        $waypoint = new Waypoint();

        $this->reader->setProperty('ele', 12.3, $waypoint);

        $this->assertEquals(12.3, $waypoint->getEle());
    }

    /**
     * @expectedException \Raistlfiren\GPS\GPX\Exception\InvalidFileException
     */
    public function testExceptionForNoFileExists()
    {
        $reader = new Reader('');

        $reader->read();
    }

    public function testMessageAndCodeForNoFileExists()
    {
        $reader = new Reader('');

        try {
            $reader->read();
        } catch (InvalidFileException $e) {
            $msg = $e->getMessage();
            $code = $e->getCode();
        }

        $this->assertEquals("ERROR file doesn't exist!", $msg);
        $this->assertEquals(0, $code);
    }

    /**
     * @expectedException \Raistlfiren\GPS\GPX\Exception\InvalidFileException
     */
    public function testInvalidFileExtenstion()
    {
        $file = __DIR__ . '/../../data/invalid-extension.xml';

        $reader = new Reader($file);

        $reader->read();
    }

    public function testMessageAndCodeForInvalidFileExtension()
    {
        $file = __DIR__ . '/../../data/invalid-extension.xml';

        $reader = new Reader($file);

        try {
            $reader->read();
        } catch (InvalidFileException $e) {
            $msg = $e->getMessage();
            $code = $e->getCode();
        }

        $this->assertEquals("ERROR invalid file extension!", $msg);
        $this->assertEquals(1, $code);
    }

    /**
     * @expectedException \Raistlfiren\GPS\GPX\Exception\InvalidFileException
     */
    public function testInvalidDOMFile()
    {
        $file = __DIR__ . '/../../data/invalid-xml.gpx';

        $reader = new Reader($file);

        $reader->read();
    }

    public function testMessageAndCodeForInvalidXMLFile()
    {
        $file = __DIR__ . '/../../data/invalid-xml.gpx';

        $reader = new Reader($file);

        try {
            $reader->read();
        } catch (InvalidFileException $e) {
            $msg = $e->getMessage();
            $code = $e->getCode();
        }

        $this->assertEquals("ERROR invalid XML file!", $msg);
        $this->assertEquals(2, $code);
    }
}