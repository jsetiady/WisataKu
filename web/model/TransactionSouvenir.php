<?php

class TransactionSouvenir {
	private $transSovId;
	private $transSovUser;
	private $transSovDate;
	private $transSovPrice;
	private $transSovDelivAddr;
	private $transSovCity;
	private $transSovKecamatan;
	private $transSovProvince;
	private $transSovPostalCode;
	private $transSovContactNo;
	private $transSovContactName;
	private $transSovTotalQty;
	private $transSovInvoiceNo;
	private $transSovPaymentType;
	private $transSovPaymentAccNo;
	private $transSovPaymentAccName;
	private $transSovPaymentAccBank;
	private $transSovPaymentDate;
	private $transSovExpiredDate;
	private $transSovNotes;
	private $transSovStatus;
	private $transSovItems;
	private $transSovIdTokoku;
	
// 	public function __construct($transSovId, $transSovUserId, $transSovDate,$transSovPrice,$transSovDelivAddr,$transSovContactNo,$transSovTotalQty,$transSovInvoiceNo,$transSovStatus)  
//     {  
//         $this->transSovId = $transSovId;
// 	    $this->transSovUserId = $transSovUserId;
// 	    $this->transSovDate = $transSovDate;
// 	    $this->transSovPrice = $transSovPrice;
// 	    $this->transSovDelivAddr = $transSovDelivAddr;
// 	    $this->transSovContactNo = $transSovContactNo;
// 	    $this->transSovTotalQty = $transSovTotalQty;
// 	    $this->transSovInvoiceNo = $transSovInvoiceNo;
// 	    $this->transSovStatus = $transSovStatus;
//     }
	
	public function __construct()
	{
		
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

    public function setTransSovUser($transSovUser)
    {
    	$this->transSovUser = $transSovUser;
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

    public function setTransSovContactNo($transSovContactNo)
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
    
    public function getTransSovCity()
    {
    	return $this->transSovCity;
    }
    
    public function setTransSovCity($transSovCity)
    {
    	$this->transSovCity = $transSovCity;
    	return $this;
    }
    
    public function getTransSovKecamatan()
    {
    	return $this->transSovKecamatan;
    }
    
    public function setTransSovKecamatan($transSovKecamatan)
    {
    	$this->transSovKecamatan = $transSovKecamatan;
    	return $this;
    }
    
    public function getTransSovProvince()
    {
    	return $this->transSovProvince;
    }
    
    public function setTransSovProvince($transSovProvince)
    {
    	$this->transSovProvince = $transSovProvince;
    	return $this;
    }
    
    public function getTransSovPostalCode()
    {
    	return $this->transSovPostalCode;
    }
    
    public function setTransSovPostalCode($transSovPostalCode)
    {
    	$this->transSovPostalCode = $transSovPostalCode;
    	return $this;
    }
    
    public function getTransSovContactName()
    {
    	return $this->transSovContactName;
    }
    
    public function setTransSovContactName($transSovContactName)
    {
    	$this->transSovContactName = $transSovContactName;
    	return $this;
    }
    
    public function getTransSovPaymentType()
    {
    	return $this->transSovPaymentType;
    }
    
    public function setTransSovPaymentType($transSovPaymentType)
    {
    	$this->transSovPaymentType = $transSovPaymentType;
    	return $this;
    }
    
    public function getTransSovPaymentAccNo()
    {
    	return $this->transSovPaymentAccNo;
    }
    
    public function setTransSovPaymentAccNo($transSovPaymentAccNo)
    {
    	$this->transSovPaymentAccNo = $transSovPaymentAccNo;
    	return $this;
    }
    
    public function getTransSovPaymentAccName()
    {
    	return $this->transSovPaymentAccName;
    }
    
    public function setTransSovPaymentAccName($transSovPaymentAccName)
    {
    	$this->transSovPaymentAccName = $transSovPaymentAccName;
    	return $this;
    }
    
    public function getTransSovPaymentAccBank()
    {
    	return $this->transSovPaymentAccBank;
    }
    
    public function setTransSovPaymentAccBank($transSovPaymentAccBank)
    {
    	$this->transSovPaymentAccBank = $transSovPaymentAccBank;
    	return $this;
    }
    
    public function getTransSovPaymentDate()
    {
    	return $this->transSovPaymentDate;
    }
    
    public function setTransSovPaymentDate($transSovPaymentDate)
    {
    	$this->transSovPaymentDate = $transSovPaymentDate;
    	return $this;
    }
    
    public function getTransSovExpiredDate()
    {
    	return $this->transSovExpiredDate;
    }
    
    public function setTransSovExpiredDate($transSovExpiredDate)
    {
    	$this->transSovExpiredDate = $transSovExpiredDate;
    	return $this;
    }
    
    public function getTransSovNotes()
    {
    	return $this->transSovNotes;
    }
    
    public function setTransSovNotes($transSovNotes)
    {
    	$this->transSovNotes = $transSovNotes;
    	return $this;
    }
    
    public function getTransSovItems()
    {
    	return $this->transSovItems;
    }
    
    public function setTransSovItems($transSovItems)
    {
    	$this->transSovItems = $transSovItems;
    	return $this;
    }
    
    public function setTransSovIdTokoku($transSovIdTokoku)
    {
    	$this->transSovIdTokoku = $transSovIdTokoku;
    	return $this;
    }
    
    public function getTransSovIdTokoku()
    {
    	return $this->transSovIdTokoku;
    }

    public function getTransSovId()
    {
    	return $this->transSovId;
    }

    public function transSovUser()
    {
    	return $this->transSovUser;
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