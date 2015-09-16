<?php


namespace Raistlfiren\GPS\GPX\Model\Track;


use Raistlfiren\GPS\GPX\Model\Collection;

class TrackCollection extends Collection
{

    private $tracks;

    public function add(Track $track)
    {
        $this->tracks[] = $track;

        return $this;
    }

    public function totalTracks()
    {
        return count($this->tracks);
    }

    public function hasTracks()
    {
        if (is_array($this->tracks))
            return TRUE;

        return FALSE;
    }

    public function getTracks()
    {
        return $this->tracks;
    }

    public function getIteratorConstant()
    {
        return 'getTracks';
    }

    /**
     * @param integer $offset
     * @return Track
     */
    public function offsetGet($offset)
    {
        return parent::offsetGet($offset);
    }
}