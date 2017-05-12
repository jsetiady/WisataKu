<?php
namespace WisataKu\WisataKuAPI;
include_once("config/Util.php");
/**
 * @author Michael
 *
 */
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

	public function __construct()
	{
		
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
    
    public function getTourId()
    {
    	return $this->tourId;
    }

    public function setTourName($tourName)
    {
    	$this->tourName = $tourName;
    	return $this;
    }
    
    public function getTourName()
    {
    	return $this->tourName;
    }

    public function setTourDesc($tourDesc)
    {
    	$this->tourDesc = $tourDesc;
    	return $this;
    }
    
    public function getTourDesc()
    {
    	return $this->tourDesc;
    }

    public function setTourMinPerson($tourMinPerson)
    {
    	$this->tourMinPerson = $tourMinPerson;
    	return $this;
    }
    
    public function getTourMinPerson()
    {
    	return $this->tourMinPerson;
    }

    public function setTourMaxPerson($tourMaxPerson)
    {
    	$this->tourMaxPerson = $tourMaxPerson;
    	return $this;
    }
    
    public function getTourMaxPerson()
    {
    	return $this->tourMaxPerson;
    }

    public function setTourStartDate($tourStartDate)
    {
    	$this->tourStartDate = $tourStartDate;
    	return $this;
    }
    
    public function getTourStartDate()
    {
    	return $this->tourStartDate;
    }
    
    public function setTourEndDate($tourEndDate)
    {
    	$this->tourEndDate = $tourEndDate;
    	return $this;
    }
    
    public function getTourEndDate()
    {
    	return $this->tourEndDate;
    }
    
    public function setTourDuration($tourDuration)
    {
    	$this->tourDuration = $tourDuration;
    	return $this;
    }
    
    public function getTourDuration()
    {
    	return $this->tourDuration;
    }
    
    public function setTourType($tourType)
    {
    	$this->tourType = $tourType;
    	return $this;
    }
    
    public function getTourType()
    {
    	return $this->tourType;
    }
    
    public function setTourTc($tourTc)
    {
    	$this->tourTc = $tourTc;
    	return $this;
    }
    
    public function getTourTc()
    {
    	return $this->tourTc;
    }
    
    public function setTourPrice($tourPrice)
    {
    	$this->tourPrice = $tourPrice;
    	return $this;
    }
    
    public function getTourPrice()
    {
    	return $this->tourPrice;
    }
    
    public function setTourPoints($tourPoints)
    {
    	$this->tourPoints = $tourPoints;
    	return $this;
    }
    
    public function getTourPoints()
    {
    	return $this->tourPoints;
    }
    
    public function setTourCreatedDate($tourCreatedDate)
    {
    	$this->tourCreatedDate = $tourCreatedDate;
    	return $this;
    }
    
    public function getTourCreatedDate()
    {
    	return $this->tourCreatedDate;
    }
    
    public function setTourLoc($tourLoc)
    {
    	$this->tourLoc = $tourLoc;
    	return $this;
    }
    
    public function getTourLoc()
    {
    	return $this->tourLoc;
    }
    
    public function setTourUserAdmin($tourUserAdmin)
    {
    	$this->tourUserAdmin = $tourUserAdmin;
    	return $this;
    }
    
    public function getTourUserAdmin()
    {
    	return $this->tourUserAdmin;
    }
    
    public function setTourImageFilename($tourImageFilename)
    {
    	$this->tourImageFilename = $tourImageFilename;
    	return $this;
    }
    
    public function getTourImageFilename()
    {
    	return $this->tourImageFilename;
    }
    
    public function setTourItinerary($tourItinerary)
    {
    	$this->tourItinerary = $tourItinerary;
    	return $this;
    }
    
    public function getTourItinerary()
    {
    	return $this->tourItinerary;
    }
    
    
    public function toArray() {
        $util = new Util();
        return array(
            "tourId" => $this->tourId,
            "tourName" => $this->tourName,
            "tourMinPerson" => $this->tourMinPerson,
            "tourMaxPerson" => $this->tourMaxPerson,
            "tourStartDate" => $this->tourStartDate,
            "tourEndDate" => $this->tourEndDate,
            "tourDuration" => $this->tourDuration,
            "tourType" => ($this->tourType == "p" ? "Personal" : "Group"),
            "tourTc" => $this->tourTc,
            "tourPrice" => $this->tourPrice,
            "tourPoints" => $this->tourPoints,
            "tourCreatedDate" => $this->tourCreatedDate,
            "tourLoc" => array(
                "locId" => $this->tourLoc->getLocId(),
                "locName" => $this->tourLoc->getLocName()
            ),
            //"tourUserAdmin" => $this->tourUserAdmin,
            "tourImageFilename" => $this->tourImageFilename,
            "tourItinerary" => $util->objectsToArray($this->tourItinerary)
        );
        
    }
    
}

?>