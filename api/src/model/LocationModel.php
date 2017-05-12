<?php
namespace WisataKu\WisataKuAPI;
include_once("Location.php");

class LocationModel {
	
	public function getAllLocation() 
    {
    	$allLocation = array();

    	$sql = "SELECT loc_id,loc_name from ws_location";
    	
    	$resSql = mysqli_query(Connection::getCon(),$sql);

    	while($row = mysqli_fetch_assoc($resSql))
    	{
    		array_push($allLocation, new Location($row['loc_id'],$row['loc_name']));
    	}
        
    	return $allLocation;
    }
    
    public function getLocationByLocId($locId)
    {
    	$loc = null;

    	$sql = "SELECT loc_id,loc_name 
    			from ws_location
    			where loc_id=".$loc_id;
    	$resSql = mysqlli_query(Connection::getCon(),$sql);
    	
    	while($row = mysqli_fetch_assoc($resSql)){
    		$loc = new Location($row['loc_id'],$row['loc_name']);
    	}
    	
    	return $loc;
    }
	
}

?>