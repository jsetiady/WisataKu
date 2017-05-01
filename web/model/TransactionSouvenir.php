<?php

class TransactionSouvenir {
	public $transSovId;
	public $transSovUserId;
	public $transSovDate;
	public $transSovPrice;
	public $transSovDelivAddr;
	public $transSovContactNo;
	public $transSovTotalQty;
	public $transSovInvoiceNo;
	public $statusId;
	
	public function __construct($transSovId, $transSovUserId, $transSovDate,$transSovPrice,$transSovDelivAddr,$transSovContactNo,$transSovTotalQty,$transSovInvoiceNo,$statusId)  
    {  
        $this->transSovId = $transSovId;
	    $this->transSovUserId = $transSovUserId;
	    $this->transSovDate = $transSovDate;
	    $this->transSovPrice = $transSovPrice;
	    $this->transSovDelivAddr = $transSovDelivAddr;
	    $this->transSovContactNo = $transSovContactNo;
	    $this->transSovTotalQty = $transSovTotalQty;
	    $this->transSovInvoiceNo = $transSovInvoiceNo;
	    $this->statusId = $statusId;
    }
    
}

?>