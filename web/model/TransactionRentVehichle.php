<?php

class TransactionRentVehicle {
	public $transVehTransId;
	public $transVehPlateNo;
	public $transVehStartDate;
	public $transVehEndDate;
	public $transVehDesc;
	public $transVehPickupAddr;
	public $transVehReturnAddr;
	public $transVehTotalDay;
	public $transVehPrice;
	public $transVehTotalPrice;

	
	public function __construct($transVehTransId, $transVehPlateNo,$transVehStartDate,$transVehEndDate,$transVehDesc,$transVehPickupAddr,$transVehReturnAddr,$transVehTotalDay,$transVehPrice,$transVehTotalPrice)  
    {  
        $this->transVehTransId = $transVehTransId;
	    $this->transVehPlateNo = $transVehPlateNo;
	    $this->transVehStartDate = $transVehStartDate;
	    $this->transVehEndDate = $transVehEndDate;
	    $this->transVehDesc = $transVehDesc;
	    $this->transVehPickupAddr = $transVehPickupAddr;
	    $this->transVehReturnAddr = $transVehReturnAddr;
	    $this->transVehTotalDay = $transVehTotalDay;
	    $this->transVehPrice = $transVehPrice;
	    $this->transVehTotalPrice = $transVehTotalPrice;
    }
    
}

?>