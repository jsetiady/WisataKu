<?php
namespace WisataKu\WisataKuAPI;

class TransactionTour {
	private $transId;
	private $transUser;
	private $transUserContactName;
	private $transUserContactNo;
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
	private $transPaymentAccName;
	private $transPaymentAccNo;
	private $transPaymentAccBank;
    
    public function __construct()
    {
    	
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
    
    public function setTransUserContactName($transUserContactName)
    {
    	$this->transUserContactName = $transUserContactName;
    	return $this;
    }

    public function setTransUserContactNo($transUserContactNo)
    {
    	$this->transUserContactNo = $transUserContactNo;
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

    public function setTransPaymentAccName($transPaymentAccName)
    {
    	$this->transPaymentAccName= $transPaymentAccName;
    	return $this;
    }
    
    public function setTransPaymentAccNo($transPaymentAccNo)
    {
    	$this->transPaymentAccNo= $transPaymentAccNo;
    	return $this;
    }
    
    public function setTransPaymentAccBank($transPaymentAccBank)
    {
    	$this->transPaymentAccBank= $transPaymentAccBank;
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
    
    public function getTransUserContactName()
    {
    	return $this->transUserContactName;
    }

    public function getTransUserContactNo()
    {
    	return $this->transUserContactNo;
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

    public function getTransPaymentAccName()
    {
    	return $this->transPaymentAccName;
    }
    
    public function getTransPaymentAccNo()
    {
    	return $this->transPaymentAccNo;
    }
    
    public function getTransPaymentAccBank()
    {
    	return $this->transPaymentAccBank;
    }

    public function toArray() {
        $util = new Util();
        return array(
            "transactionId" => $this->transId,
            "transactionUser" => $this->transUser->toArray(),
            "transactionContactInfo" => array(
                "contactName" => $this->transUserContactName,
                "contactPhoneNumber" => $this->transUserContactNo
            ),
            "transactionTour" => array(
                "tourId" => $this->transTour->getTourId(),
                "tourName" => $this->transTour->getTourName(),
                "pricePerPerson" => $this->transPricePerson,
                "totalPerson" => $this->transTotalPerson,
                "preferredStartDate" => $this->transPrefStartDate,
                "preferredEndDate" => $this->transPrefEndDate
            ),
            "transactionDate" => $this->transDate,
            "transactionTotalPrice" => $this->transTotalPrice,
            "transactionExpiryDate" => $this->transExpiredDate,
            "transactionInvoiceNumber" => $this->transInvoiceNo,
            "transactionStatus" => $this->transStatus->toArray(),
            "transactionNotes" => $this->transNotes,
            "transactionPaymentInfo" => array(
                "paymentType" => $this->transPaymentType,
                "paymentDate" => $this->transPaymentDate,
                "paymentAccountName" => $this->transPaymentAccName,
                "paymentAccountNumber" => $this->transPaymentAccNo,
                "paymentAccountBank" => $this->transPaymentAccBank
            )
        );
    }
    

}
