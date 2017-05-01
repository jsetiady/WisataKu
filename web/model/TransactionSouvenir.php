<?php

class TransactionSouvenir {
	private $transSovId;
	private $transSovUserId;
	private $transSovDate;
	private $transSovPrice;
	private $transSovDelivAddr;
	private $transSovContactNo;
	private $transSovTotalQty;
	private $transSovInvoiceNo;
	private $transSovStatus;
	
	public function __construct($transSovId, $transSovUserId, $transSovDate,$transSovPrice,$transSovDelivAddr,$transSovContactNo,$transSovTotalQty,$transSovInvoiceNo,$transSovStatus)  
    {  
        $this->transSovId = $transSovId;
	    $this->transSovUserId = $transSovUserId;
	    $this->transSovDate = $transSovDate;
	    $this->transSovPrice = $transSovPrice;
	    $this->transSovDelivAddr = $transSovDelivAddr;
	    $this->transSovContactNo = $transSovContactNo;
	    $this->transSovTotalQty = $transSovTotalQty;
	    $this->transSovInvoiceNo = $transSovInvoiceNo;
	    $this->transSovStatus = $transSovStatus;
    }
    
    public static function create()
    {
    	$instance = new self();
    	return $instance;
    }

    public function setTransSovId($transSovId)
    {
    	$this->transSovId = $transSovId;
    	return $this;
    }

    public function setTransSovUserId($transSovUserId)
    {
    	$this->transSovUserId = $transSovUserId;
    	return $this;
    }

    public function setTransSovDate($transSovDate)
    {
    	$this->transSovDate = $transSovDate;
    	return $this;
    }

    public function setTransSovPrice($transSovPrice)
    {
    	$this->transSovPrice = $transSovPrice;
    	return $this;
    }

    public function setTransSovDelivAddr($transSovDelivAddr)
    {
    	$this->transSovDelivAddr = $transSovDelivAddr;
    	return $this;
    }

    public function setTransContactNo($transSovContactNo)
    {
    	$this->transSovContactNo = $transSovContactNo;
    	return $this;
    }

    public function setTransSovTotalQty($transSovTotalQty)
    {
    	$this->transSovTotalQty = $transSovTotalQty;
    	return $this;
    }

    public function setTransSovInvoiceNo($transSovInvoiceNo)
    {
    	$this->transSovInvoiceNo = $transSovInvoiceNo;
    	return $this;
    }

    public function setTransSovStatus($transSovStatus)
    {
    	$this->transSovStatus = $transSovStatus;
    	return $this;
    }

    public function getTransSovId()
    {
    	return $this->transSovId;
    }

    public function transSovUserId()
    {
    	return $this->transSovUserId;
    }

    public function getTransSovDate()
    {
    	return $this->transSovDate;
    }

    public function getTransSovPrice()
    {
    	return $this->transSovPrice;
    }

    public function getTransSovDelivAddr()
    {
    	return $this->transSovDelivAddr;
    }

    public function getTransSovContactNo()
    {
    	return $this->transSovContactNo;
    }

    public function getTransSovTotalQty()
    {
    	return $this->transSovTotalQty;
    }

    public function getTransSovInvoiceNo()
    {
    	return $this->transSovInvoiceNo;
    }

    public function getTransSovStatus()
    {
    	return $this->transSovStatus;
    }

}

?>