<?php
namespace WisataKu\WisataKuAPI;
include_once("TransactionRentVehicle.php");

class TransactionRentVehicleModel {

	public function getRentVehicleByTransactionId($transId)
    {
    	$rentVehicles = array();

    	$sql = "SELECT trans_veh_trans_id,trans_veh_plate_no,trans_veh_start_date,trans_veh_end_date,
                        trans_veh_desc,trans_veh_pickup_addr,trans_veh_return_addr,trans_veh_total_day,
                        trans_veh_price,trans_veh_total_price
                from ws_transaction_rent_vehicle
                where trans_veh_trans_id = ".$transId;

    	$resSql = mysqli_query(Connection::getCon(),$sql);

    	while($row = mysqli_fetch_assoc($resSql)) {
    		array_push($rentVehicles, new TransactionRentVehicle($row['trans_veh_trans_id'],$row['trans_veh_plate_no'],$row['trans_veh_start_date'],$row['trans_veh_end_date'],$row['trans_veh_desc'],$row['trans_veh_pickup_addr'],$row['trans_veh_return_addr'],$row['trans_veh_total_day'],$row['trans_veh_price'],$row['trans_trans_veh_total_price']));
    	}
    	return $rentVehicles;
    }
}

?>