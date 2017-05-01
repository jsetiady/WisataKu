<?php

class TourPackage {
	private $tourId;
	private $tourName;
	private $tourDesc;
	private $tourMinPerson;
	private $tourMaxPerson;
	private $tourStartDate;
	private $tourEndDate;
	private $tourDuration;
	private $tourType;
	private $tourTc;
	private $tourPrice;
	private $tourPoints;
	private $tourCreatedDate;
	private $tourLoc;
	private $tourUserAdmin;
	private $tourImageFilename;
	private $tourItinerary;

	
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

    public static function create()
    {
    	$instance = new self();
    	return $instance;
    }

    public function setTourId($tourId)
    {
    	$this->tourId = $tourId;
    	return $this;
    }

    public function setTourName($tourName)
    {
    	$this->tourName = $tourName;
    	return $this;
    }

    public function setTourDesc($tourDesc)
    {
    	$this->tourDesc = $tourDesc;
    	return $this;
    }

    public function setTourMinPerson($tourMinPerson)
    {
    	$this->tourMinPerson = $tourMinPerson;
    	return $this;
    }

    public function setTourMaxPerson($tourMaxPerson)
    {
    	$this->tourMaxPerson = $tourMaxPerson;
    	return $this;
    }

    public function setTourStartDate($tourStartDate)
    {
    	$this->tourStartDate = $tourStartDate;
    }
}

?>