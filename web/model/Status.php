<?php

class Status {
	private $statusId;
	private $statusDesc;
	
	public function __construct()  
    {  
    }

    public static function create() 
    {
    	$instance = new self();
    	return $instance;
    }

    public function setStatusId($statusId)
    {
    	$this->statusId = $statusId;
    	return $this;
    }

    public function setStatusDesc($statusDesc)
    {
    	$this->statusDesc = $statusDesc;
    	return $this;
    }

    public function getStatusId()
    {
    	return $this->statusId;
    }

    public function getStatusDesc()
    {
    	return $this->statusDesc;
    }
}

?>