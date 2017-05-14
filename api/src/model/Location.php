<?php
namespace WisataKu\WisataKuAPI;
class Location {
	private $locId;
	private $locName;
	
	public function __construct($locId,$locName)  
    {
		$this->locId = $locId;
		$this->locName = $locName;
    }

    public static function create() 
    {
    	$instance = new self();
    	return $instance;
    }

    public function setLocId($locId)
    {
    	$this->locId = $locId;
    	return $this;
    }

    public function setLocName($locName) 
    {
    	$this->locName = $locName;
    	return $this;
    }

    public function getLocId() 
    {
    	return $this->locId;
   	}

    public function getLocName() 
    {
    	return $this->locName;

    }
    
    public function toArray() {
        return array(
            "locId" => $this->locId,
            "locName" =>$this->locName
        );
    }

    
}

?>