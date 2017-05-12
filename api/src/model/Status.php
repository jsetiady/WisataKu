<?php
namespace WisataKu\WisataKuAPI;
class Status {
	private $statusId;
	private $statusDesc;
	
	public function __construct($statusId, $statusDesc)  
    {  
        $this->statusId = $statusId;
	    $this->statusDesc = $statusDesc;
    }

    public static function create() 
    {
    	$instance = new self();
    	return $this;
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