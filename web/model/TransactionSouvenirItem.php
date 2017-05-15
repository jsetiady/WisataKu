<?php

class TransactionSouvenirItem {
	private $itemId;
	private $itemName;
	private $itemPrice;
	private $itemQty;
	private $itemTotalPrice;
	private $itemNotes;
	
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
	
	public function getItemId(){
		return $this->itemId;
	}
	
	public function setItemId($itemId){
		$this->itemId = $itemId;
		return $this;
	}
	
	public function getItemName(){
		return $this->itemName;
	}
	
	public function setItemName($itemName){
		$this->itemName = $itemName;
		return $this;
	}
	
	public function getItemPrice(){
		return $this->itemPrice;
	}
	
	public function setItemPrice($itemPrice){
		$this->itemPrice = $itemPrice;
		return $this;
	}
	
	public function getItemQty(){
		return $this->itemQty;
	}
	
	public function setItemQty($itemQty){
		$this->itemQty = $itemQty;
		return $this;
	}
	
	public function getItemTotalPrice(){
		return $this->itemTotalPrice;
	}
	
	public function setItemTotalPrice($itemTotalPrice){
		$this->itemTotalPrice = $itemTotalPrice;
		return $this;
	}
	
	public function getItemNotes(){
		return $this->itemNotes;
	}
	
	public function setItemNotes($itemNotes){
		$this->itemNotes = $itemNotes;
		return $this;
	}
	
}

?>