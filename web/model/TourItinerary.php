<?php

class TourItinerary {
	public $itineraryTourId;
	public $itinerarySeq;
	public $itineraryTitle;
	public $itineraryDesc;

	
	public function __construct($itineraryTourId, $itinerarySeq, $itineraryTitle, $itineraryDesc)  
    {  
        $this->itineraryTourId = $itineraryTourId;
        $this->itinerarySeq = $itinerarySeq;
	    $this->itineraryTitle = $itineraryTitle;
	    $this->itineraryDesc = $itineraryDesc;
    }
    
}

?>