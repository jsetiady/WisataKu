<?php

class TourPackage {
	public $tourId;
	public $tourName;
	public $tourDesc;
	public $tourMinPerson;
	public $tourMaxPerson;
	public $tourStartDate;
	public $tourEndDate;
	public $tourDuration;
	public $tourType;
	public $tourTc;
	public $tourPrice;
	public $tourPoints;
	public $tourCreatedDate;
	public $tourLoc;
	public $tourUserAdmin;
	public $tourImageFilename;
	public $tourItinerary;

	
	public function __construct($tourId,$tourName,$tourMinPerson,$tourMaxPerson,$tourStartDate,
		$tourEndDate,$tourDuration,$tourType, $tourTc, $tourPrice, $tourPoints, 
		$tourCreatedDate, $tourLoc,$tourUserAdmin,$tourImageFilename,$tourItinerary)   
    {  
        $this->tourId = $tourId;
	    $this->tourName = $tourName;
	    $this->tourDesc = $tourDesc;
	    $this->tourMinPerson = $tourMinPerson;
	    $this->tourMaxPerson = $tourMaxPerson;
	    $this->tourStartDate = $tourStartDate;
	    $this->tourEndDate = $tourEndDate;
	    $this->tourDuration = $tourDuration;
	    $this->tourType = $tourType;
	    $this->tourTc = $tourTc;
	    $this->tourPrice = $tourPrice;
	    $this->tourPoints = $tourPoints;
	    $this->tourCreatedDate = $tourCreatedDate;
	    $this->tourLoc = $tourLoc;
	    $this->tourUserAdmin = $tourUserAdmin;
	    $this->tourImageFilename = $tourImageFilename;
	    $this->tourItinerary = $tourItinerary;
    }
}

?>