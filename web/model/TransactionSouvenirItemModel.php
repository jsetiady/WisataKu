<?php
include_once("model/TransactionSouvenirItem.php");

class TransactionSouvenirItemModel {
	
	public function getAllSouvenirByTransactionId($tourSovId)
	{
		$items = array();
		
		$sql = "SELECT item_trans_sov_id,item_id,item_name,item_price,item_qty,item_total_price,item_notes
                from ws_transaction_souvenir_item
                where item_trans_sov_id = ".$tourSovId."
                order by item_id asc";
		//     	echo $sql;
		$resSql = mysqli_query(Connection::getCon(),$sql);
		
		while($row = mysqli_fetch_assoc($resSql)) {
			array_push($items, TransactionSouvenirItem::create()
									->setItemId($row['item_id'])
									->setItemName($row['item_name'])
									->setItemNotes($row['item_notes'])
									->setItemPrice($row['item_price'])
									->setItemQty($row['item_qty'])
									->setItemTotalPrice($row['item_total_price'])
			);
		}
		
		return $items;
	}
}

?>