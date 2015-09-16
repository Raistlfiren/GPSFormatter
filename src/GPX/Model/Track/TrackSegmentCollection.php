<?php


namespace Raistlfiren\GPS\GPX\Model\Track;


use Raistlfiren\GPS\GPX\Model\Collection;

class TrackSegmentCollection extends Collection
{

    /** @var TrackSegment[] $trackSegment */
    private $trackSegments;

    public function add(TrackSegment $trackSegment)
    {
        $this->trackSegments[] = $trackSegment;

        return $this;
    }

    public function totalTrackSegments()
    {
        return count($this->trackSegments);
    }

    public function hasTrackSegments()
    {
        if (is_array($this->trackSegments))
            return TRUE;

        return FALSE;
    }

    public function getTrackSegments()
    {
        return $this->trackSegments;
    }

    public function getIteratorConstant()
    {
        return 'getTrackSegments';
    }

    /**
     * @param integer $offset
     * @return TrackSegment
     */
    public function offsetGet($offset)
    {
        return parent::offsetGet($offset);
    }
}