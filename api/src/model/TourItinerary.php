<?php
namespace WisataKu\WisataKuAPI;
class TourItinerary {
	private $itineraryTourId;
	private $itinerarySeq;
	private $itineraryTitle;
	private $itineraryDesc;

	
	public function __construct($itineraryTourId, $itinerarySeq, $itineraryTitle, $itineraryDesc)  
    {  
        $this->itineraryTourId = $itineraryTourId;
        $this->itinerarySeq = $itinerarySeq;
	    $this->itineraryTitle = $itineraryTitle;
	    $this->itineraryDesc = $itineraryDesc;
    }

    public static function create()
    {
    	$instance = new self();
    	return $instance;
    }

    public function setItineraryTourId($itineraryTourId)
    {
    	$this->itineraryTourId = $itineraryTourId;
    	return $this;
    }

    public function setItinerarySeq($itinerarySeq)
    {
    	$this->itinerarySeq = $itinerarySeq;
    	return $this;
    }

    public function setItineraryTitle($itineraryTitle) 
    {
    	$this->itineraryTitle = $itineraryTitle;
    	return $this;
    }

    public function setItineraryDesc($setItineraryDesc) 
    {
    	$this->itineraryDesc = $setItineraryDesc;
    	return $this;
    }

    public function getItineraryTourId()
    {
    	return $this->itineraryTourId;
    }

    public function getItinerarySeq()
    {
    	return $this->itinerarySeq;
    }

    public function getItineraryTitle()
    {
    	return $this->itineraryTitle;
    }

    public function getItineraryDesc()
    {
    	return $this->itineraryDesc;
    }
}

?>