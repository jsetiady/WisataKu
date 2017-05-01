<?php

include_once("config/Connection.php");
include_once("model/TourItinerary.php");

class TourItineraryModel {

	public function getAllTourItineraryByTourId($tourId)
    {
    	$itineraries = array();

    	$sql = "SELECT itinerary_seq,itinerary_title,itinerary_desc 
                from ws_tour_itinerary
                where ";
    	$resSql = mysqli_query($sql,$con);

    	while($row = mysqli_fetch_assoc($resSql)) {
    		array_push($allStatus, new Status($row['status_id'],$row['status_desc']));
    	}

    	return $allStatus;
    }
}

?>