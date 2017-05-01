<?php

class TransactionTour {
	public $transId;
	public $transUserId;
	public $transUserTelp;
	public $transTotalPerson;
	public $transPrefStartDate;
	public $transPrefEndDate;
	public $transPricePerson;
	public $transDate;
	public $transTotalPrice;
	public $transExpiredDate;
	public $transTourId;
	public $transInvoiceNo;
	public $transStatusId;
	public $transNotes;
	
	public function __construct($transId, $transUserId, $transUserTelp,$transTotalPerson,$transPrefStartDate,$transPrefEndDate,$transPricePerson,$transDate,$transTotalPrice,$transExpiredDate,$transTourId,$transInvoiceNo,$transStatusId,$transNotes)  
    {  
        $this->transId = $transId;
	    $this->transUserId = $transUserId;
	    $this->transUserTelp = $transUserTelp;
	    $this->transTotalPerson = $transTotalPerson;
	    $this->transPrefStartDate = $transPrefStartDate;
	    $this->transPrefEndDate = $transPrefEndDate;
	    $this->transPricePerson = $transPricePerson;
	    $this->transDate = $transDate;
	    $this->transTotalPrice = $transTotalPrice;
	    $this->transExpiredDate = $transExpiredDate;
	    $this->transTourId = $transTourId;
	    $this->transInvoiceNo = $transInvoiceNo;
	    $this->transStatusId = $transStatusId;
	    $this->transNotes = $transNotes;
    }
    
}

?>