<?php

class TransactionTour {
	private $transId;
	private $transUserId;
	private $transUserTelp;
	private $transTotalPerson;
	private $transPrefStartDate;
	private $transPrefEndDate;
	private $transPricePerson;
	private $transDate;
	private $transTotalPrice;
	private $transExpiredDate;
	private $transTourId;
	private $transInvoiceNo;
	private $transStatusId;
	private $transNotes;
	private $transPaymentType;
	private $transPaymentDate;
	private $transPaymentAccNo;
	
	public function __construct($transId, $transUserId, $transUserTelp,$transTotalPerson,$transPrefStartDate,$transPrefEndDate,$transPricePerson,$transDate,$transTotalPrice,$transExpiredDate,$transTourId,$transInvoiceNo,$transStatusId,$transNotes,
		$transPaymentType,$transPaymentDate,$transPaymentAccNo)  
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
	    $this->transPaymentType = $transPaymentType;
	    $this->transPaymentDate = $transPaymentDate;
	    $this->transPaymentAccNo = $transPaymentAccNo;
    }
    
}

?>