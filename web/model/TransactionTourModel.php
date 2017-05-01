<?php

require_once("config/Connection.php");
include_once("model/TransactionTour.php");

class TransactionTourModel {

	public function getAllTransaction()
    {
    	$transactions = array();

    	$sql = "";
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