<?php
include_once("model/TourItinerary.php");

class TourItineraryModel {

	public function getAllTourItineraryByTourId($tourId)
    {
    	$itineraries = array();

    	$sql = "SELECT itinerary_tour_id,itinerary_seq,itinerary_title,itinerary_desc 
                from ws_tour_itinerary
                where itinerary_tour_id = ".$tourId."
                order by itinerary_seq asc";
//     	echo $sql;
    	$resSql = mysqli_query(Connection::getCon(),$sql);

    	while($row = mysqli_fetch_assoc($resSql)) {
    		array_push($itineraries, new TourItinerary($row['itinerary_tour_id'],$row['itinerary_seq'],
                $row['itinerary_title'],$row['itinerary_desc']));
    	}

    	return $itineraries;
    }
}

?>