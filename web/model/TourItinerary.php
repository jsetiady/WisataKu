<?php

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
}

?>