<?php
namespace WisataKu\WisataKuAPI;

class SimpleCRMModel {
	
    public function createTransaction($args)
    {
    	$username = $args['username'];
    	$transactionInvoice = $args['transactionInvoice'];
    	$transactionDate = $args['transactionDate'];
    	$productName = $args['productName'];
    	$point = $args['point'];
    	$issuer = $args['issuer'];
        
        //==
        $message = $point." points added from $issuer (invoice: $transactionInvoice / $productName)";
        $issueDate = date("Y-m-d H:i:s");
    	
        
        $sql =
            "INSERT into crm
            (
                username,
                transaction_invoice,
                transaction_date,
                product_name,
                message,
                issuer,
                issue_date,
                point
            )
            values
            (
                '".str_replace("'","",$username)."',
                '".$transactionInvoice."',
                '".$transactionDate."',
                '".$productName."',
                '".$message."',
                '".$issuer."',
                '".$issueDate."',
                '".$point."'
            )";
        
    	
		$resSql = mysqli_query(Connection::getCon(),$sql);
		$retTransId = "fail";
		
		if($resSql) {
			$transId = mysqli_insert_id(Connection::getCon());
			$retTransId = $transId;
		}
		
		return $retTransId;
    }
    
    public function getTourPackageByTourId($id)
    {
        $tourPackage = null;

        $sql = "SELECT username,
                transaction_invoice,
                transaction_date,
                product_name,
                message,
                issuer,
                issue_date,
                point
                FROM crm where id = ".$id;
        
        $resSql = mysqli_query(Connection::getCon(),$sql);

        while($row = mysqli_fetch_assoc($resSql)) {
            $data = $row;
        }
        
        return $data;
    }
    
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
    
	
}

?>