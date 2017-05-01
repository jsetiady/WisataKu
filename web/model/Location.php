<?php

class Location {
	private $locId;
	private $locName;
	
	public function __construct($locId, $locName)  
    {  
        $this->locId = $locId;
	    $this->locName = $locName;
    }
    
}

?>