<?php

class Location {
	public $locId;
	public $locName;
	
	public function __construct($locId, $locName)  
    {  
        $this->locId = $locId;
	    $this->locName = $locName;
    }
    
}

?>