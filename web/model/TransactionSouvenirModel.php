<?php

require_once("config/Connection.php");
include_once("model/TransactionSouvenir.php");

class TransactionSouvenirModel {

	public function getAllTransaction()
    {
    	$transactions = array();

    	$sql = "SELECT trans_id,trans_user_id,trans_user_telp,trans_total_person,trans_pref_startdate,
    			trans_pref_enddate,trans_price_person,trans_date,trans_total_price,trans_payment_type,
    			trans_payment_acc_no,trans_payment_date,trans_expired_date,trans_tour_id,trans_invoice_no,";
    	$resSql = mysqli_query($con,$sql);

    	while($row = mysqli_fetch_assoc($resSql)) {
    		array_push($itineraries, new TourItinerary($row['itinerary_tour_id'],$row['itinerary_seq'],
                $row['itinerary_title'],$row['itinerary_desc']));
    	}

    	return $itineraries;
    }

    public function getTransactionByTransactionId($transId) 
    {
        
    }

    public function getTransactionByUserId($userId) 
    {

    }

    public function createTransaction($transactionData)
    {

    }

    public function updateTransactionData($transactionData) 
    {

    }
    
    public function updateTransactionStatus($transId,$statusId) 
    {
        
    }


}

?>