<?php

require_once("config/Connection.php");
include_once("model/TransactionTour.php");

class TransactionTourModel {

	public function getAllTransaction()
    {
    	$transactions = array();

    	$sql = "SELECT itinerary_tour_id,itinerary_seq,itinerary_title,itinerary_desc 
                from ws_tour_itinerary
                where ititerary_tour_id = ".$tourId."
                order by itinerary_seq asc";
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