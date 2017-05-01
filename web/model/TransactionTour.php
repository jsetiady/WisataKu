<?php

class TransactionTour {
	private $transId;
	private $transUser;
	private $transUserTelp;
	private $transTotalPerson;
	private $transPrefStartDate;
	private $transPrefEndDate;
	private $transPricePerson;
	private $transDate;
	private $transTotalPrice;
	private $transExpiredDate;
	private $transTour;
	private $transInvoiceNo;
	private $transStatus;
	private $transNotes;
	private $transPaymentType;
	private $transPaymentDate;
	private $transPaymentAccNo;
	
	public function __construct($transId, $transUser, $transUserTelp,$transTotalPerson,$transPrefStartDate,
		$transPrefEndDate,$transPricePerson,$transDate,$transTotalPrice,$transExpiredDate,$transTour,
		$transInvoiceNo,$transStatus,$transNotes,
		$transPaymentType,$transPaymentDate,$transPaymentAccNo)  
    {  
        $this->transId = $transId;
	    $this->transUser = $transUser;
	    $this->transUserTelp = $transUserTelp;
	    $this->transTotalPerson = $transTotalPerson;
	    $this->transPrefStartDate = $transPrefStartDate;
	    $this->transPrefEndDate = $transPrefEndDate;
	    $this->transPricePerson = $transPricePerson;
	    $this->transDate = $transDate;
	    $this->transTotalPrice = $transTotalPrice;
	    $this->transExpiredDate = $transExpiredDate;
	    $this->transTour = $transTour;
	    $this->transInvoiceNo = $transInvoiceNo;
	    $this->transStatus = $transStatus;
	    $this->transNotes = $transNotes;
	    $this->transPaymentType = $transPaymentType;
	    $this->transPaymentDate = $transPaymentDate;
	    $this->transPaymentAccNo = $transPaymentAccNo;
    }

    public static function create()
    {
    	$instance = new self();
    	return $instance;
    }

    public function setTransId($transId)
    {
    	$this->transId = $transId;
    	return $this;
    }    

    public function setTransUser($transUser)
    {
    	$this->transUser = $transUser;
    	return $this;
    }

    public function setTransUserTelp($transUserTelp)
    {
    	$this->transUserTelp = $transUserTelp;
    	return $this;
    }

    public function setTransTotalPerson($transTotalPerson)
    {
    	$this->transTotalPerson = $transTotalPerson;
    	return $this;
    }

    public function setTransPrefStartDate($transPrefStartDate)
    {
    	$this->transPrefStartDate = $transPrefStartDate;
    	return $this;
    }

    public function setTransPrefEndDate($transPrefEndDate)
    {
    	$this->transPrefEndDate = $transPrefEndDate;
    	return $this;
    }

    public function setTransPricePerson($transPricePerson)
    {
    	$this->transPricePerson = $transPricePerson;
    	return $this;
    }

    public function setTransDate($transDate)
    {
    	$this->transDate = $transDate;
    	return $this;
    }

    public function setTransTotalPrice($transTotalPrice)
    {
    	$this->transTotalPrice = $transTotalPrice;
    	return $this;
    }

    public function setTransExpiredDate($transExpiredDate)
    {
    	$this->transExpiredDate = $transExpiredDate;
    	return $this;
    }

    public function setTransTour($transTour)
    {
    	$this->transTour = $transTour;
    	return $this;
    }

    public function setTransInvoiceNo($transInvoiceNo)
    {
    	$this->transInvoiceNo = $transInvoiceNo;
    	return $this;
    }

    public function setTransStatus($transStatus)
    {
    	$this->transStatus = $transStatus;
    	return $this;
    }

    public function setTransNotes($transNotes)
    {
    	$this->transNotes = $transNotes;
    	return $this;
    }

    public function setTransPaymentType($transPaymentType)
    {
    	$this->transPaymentType = $transPaymentType;
    	return $this;
    }

    public function setTransPaymentDate($transPaymentDate)
    {
    	$this->transPaymentDate = $transPaymentDate;
    	return $this;
    }

    public function setTransPaymentAccNo($transPaymentAccNo)
    {
    	$this->transPaymentAccNo = $transPaymentAccNo;
    	return $this;
    }

    public function getTransId()
    {
    	return $this->transId;
    }

    public function getTransUser()
    {
    	return $this->transUser;
    }

    public function getTransUserTelp()
    {
    	return $this->transUserTelp;
    }

    public function getTransTotalPerson()
    {
    	return $this->transTotalPerson;
    }

    public function getTransPrefStartDate()
    {
    	return $this->transPrefStartDate;
    }

    public function getTransPrefEndDate()
    {
    	return $this->transPrefEndDate;
    }

    public function getTransPricePerson()
    {
    	return $this->transPricePerson;
    }

    public function getTransDate()
    {
    	return $this->transDate;
    }

    public function getTransTotalPrice()
    {
    	return $this->transTotalPrice;
    }

    public function getTransExpiredDate()
    {
    	return $this->transExpiredDate;
    }

    public function getTransTour()
    {
    	return $this->transTour;
    }

    public function getTransInvoiceNo()
    {
    	return $this->transInvoiceNo;
    }

    public function getTransStatus()
    {
    	return $this->transStatus;
    }

    public function getTransNotes()
    {
    	return $this->transNotes;
    }

    public function getTransPaymentType()
    {
    	return $this->transPaymentType;
    }

    public function getTransPaymentDate()
    {
    	return $this->transPaymentDate;
    }

    public function getTransPaymentAccNo()
    {
    	return $this->transPaymentAccNo;
    }

}
