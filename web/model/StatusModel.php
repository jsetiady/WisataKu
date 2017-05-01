<?php

include_once("config/Connection.php");
include_once("model/Status.php");

class StatusModel {

	public function getAllStatus()
    {
    	$allStatus = array();

    	$sql = "SELECT status_id,status_desc from ws_status";
    	$resSql = mysqli_query($sql,$con);

    	while($row = mysqli_fetch_assoc($resSql)) {
    		array_push($allStatus, new Status($row['status_id'],$row['status_desc']));
    	}

    	return $allStatus;
    }

    public function getStatusByStatusId($statusId)
    {
    	$status = null;

    	$sql = "SELECT status_id,status_desc from ws_status
    			where status_id = ".$statusId;
    	$resSql = mysqli_query($sql,$con);

    	while($row = mysqli_fetch_assoc($resSql)) {
    		$status = new Status($row['status_id'],$row['status_name']);
    	}

    	return $status;
    }
	
}

?>