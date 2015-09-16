GPS Formatter
==========

The purpose of this package is to read and write GPX files based off of PHP classes. Currently, there
is no way of reading extensions that are a part of another namespace without extending the library. Viewing 
the tests should give you great examples of how to use the current library.

Reading a GPX file
------------

Reading GPX files are trivial. In order to do this you can do the following: 

```php
    use Raistlfiren\GPS\GPX\Reader;
    
    $file = 'test.gpx';
    $reader = new Reader($file);
    
    $reader->read();
    
```

Once read() is invoked it checks to make sure the file is valid. First it checks to see if the file 
exists. Second it checks if the file has a valid gpx extension. Thirdly, it check if the gpx file matches 
the gpx 1.1 schema. If the file is invalid it throws an InvalidFileException and returns the appropriate 
error message.

After the file is validated, then the parser is invoked. The parser loops through all of the attributes 
and adds the properties and attributes to the appropriate object. Once the parsing is done it returns the 
document object that contains all of the properties from the GPX 1.1 specification. Attributes are stored 
in an array of the object and can be obtained by using.

```php
    $attributes = $object->getAttributes();
```
    
Properties of the document can be quickly obtained by doing the following.
    
```php

    //Returns metadata type
    $metadata = $object->getMetadata();
    
    //Returns person type
    $author = $metadata->getAuthor();
```

Waypoints, tracks, routes, and track segments can be quickly iterated through as an array. For example:

```php

    $document = $reader->read();
    
    foreach($document->getWaypoints() as $index => $value) {
        //$value returns Waypoint
        echo $waypoint->getName();
    }
    
    //Individual waypoints can be grabbed as well
    //Internally offsetGet checks to see if the key exists. If it doesn't then FALSE is returned. Otherwise, 
    //  the value is returned...
    $firstWaypoint = $document->getWaypoint()->offsetGet(0)
    
    
```

Writing a GPX file
------------

Writing a GPX file is very simple as well. All you need to do is create a new instance of Document 
and start using the classes in an OOP fashion. Example below -

```php

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
    
    $this->writer->write();
    
```

TODO
------------

Resolve writer issues...