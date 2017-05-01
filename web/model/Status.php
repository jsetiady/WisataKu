<?php

class Status {
	private $statusId;
	private $statusDesc;
	
	public function __construct($statusId, $statusDesc)  
    {  
        $this->statusId = $statusId;
	    $this->statusDesc = $statusDesc;
    }
}

?>