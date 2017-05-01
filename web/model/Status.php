<?php

class Status {
	public $statusId;
	public $statusDesc;
	
	public function __construct($statusId, $statusDesc)  
    {  
        $this->statusId = $statusId;
	    $this->statusDesc = $statusDesc;
    }
}

?>