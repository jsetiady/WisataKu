<?php
namespace WisataKu\WisataKuAPI;
class TransactionRentVehicle {
	private $transVehTransId;
	private $transVehPlateNo;
	private $transVehStartDate;
	private $transVehEndDate;
	private $transVehDesc;
	private $transVehPickupAddr;
	private $transVehReturnAddr;
	private $transVehTotalDay;
	private $transVehPrice;
	private $transVehTotalPrice;

	
// 	public function __construct($transVehTransId, $transVehPlateNo,$transVehStartDate,$transVehEndDate,$transVehDesc,$transVehPickupAddr,$transVehReturnAddr,$transVehTotalDay,$transVehPrice,$transVehTotalPrice)  
//     {  
//         $this->transVehTransId = $transVehTransId;
// 	    $this->transVehPlateNo = $transVehPlateNo;
// 	    $this->transVehStartDate = $transVehStartDate;
// 	    $this->transVehEndDate = $transVehEndDate;
// 	    $this->transVehDesc = $transVehDesc;
// 	    $this->transVehPickupAddr = $transVehPickupAddr;
// 	    $this->transVehReturnAddr = $transVehReturnAddr;
// 	    $this->transVehTotalDay = $transVehTotalDay;
// 	    $this->transVehPrice = $transVehPrice;
// 	    $this->transVehTotalPrice = $transVehTotalPrice;
//     }
	
	public function __construct()
	{
		
	}
    

    public static function create()
    {
    	$instance = new self();
    	return $instance;
    }

    public function setTransVehTransId($transVehTransId)
    {
    	$this->transVehTransId = $transVehTransId;
    	return $this;
    }

    public function setTransVehPlateNo($transVehPlateNo)
    {
    	$this->transVehPlateNo = $transVehPlateNo;
    	return $this;
    }

    public function setTransVehStartDate($transVehStartDate)
    {
    	$this->transVehStartDate = $transVehStartDate;
    	return $this;
    }

    public function setTransVehEndDate($transVehEndDate)
    {
    	$this->transVehEndDate = $transVehEndDate;
    	return $this;
    }

    public function setTransVehDesc($transVehDesc)
    {
    	$this->transVehDesc = $transVehDesc;
    	return $this;
    }

    public function setTransVehPickupAddr($transVehPickupAddr)
    {
    	$this->transVehPickupAddr = $transVehPickupAddr;
    	return $this;
    }

    public function setTransVehReturnAddr($transVehReturnAddr)
    {
    	$this->transVehReturnAddr = $transVehReturnAddr;
    	return $this;
    }

    public function setTransVehTotalDay($transVehTotalDay)
    {
    	$this->transVehTotalDay = $transVehTotalDay;
    	return $this;
    }

    public function setTransVehPrice($transVehPrice)
    {
    	$this->transVehPrice = $transVehPrice;
    	return $this;
    }

    public function setTransVehTotalPrice($transVehTotalPrice)
    {
    	$this->transVehTotalPrice = $transVehTotalPrice;
    	return $this;
    }

    public function getTransVehTransId()
    {
    	return $this->transVehTransId;
    }

    public function getTransVehPlateNo()
    {
    	return $this->transVehPlateNo;
    }

    public function getTransVehStartDate()
    {
    	return $this->transVehStartDate;
    }

    public function getTransVehEndDate()
    {
    	return $this->transVehEndDate;
    }

    public function getTransVehDesc()
    {
    	return $this->transVehDesc;
    }

    public function getTransVehPickupAddr()
    {
    	return $this->transVehPickupAddr;
    }

    public function getTransVehReturnAddr()
    {
    	return $this->transVehReturnAddr;
    }

    public function getTransVehTotalDay()
    {
    	return $this->transVehTotalDay;
    }

    public function getTransVehPrice()
    {
    	return $this->transVehPrice;
    }

    public function getTransVehTotalPrice()
    {
    	return $this->transVehTotalPrice;
    }
}


?>