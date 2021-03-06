<?php
include_once("model/TransactionTour.php");

class TransactionTourModel {

	public function getAllTransactions($transId = null,$userId = null)
    {
    	$transactions = array();

    	$sql = "SELECT trans_id,trans_user_id,trans_user_contact_name,trans_user_contact_no,trans_total_person,trans_pref_startdate,
    			trans_pref_enddate,trans_price_person,trans_date,trans_total_price,trans_payment_type,
    			trans_payment_acc_name,trans_payment_date,trans_expired_date,trans_tour_id,trans_invoice_no,
    			(select status_desc from ws_status where status_id = trans_status_id) status_desc,
				(select tour_name from ws_tour where tour_id=trans_tour_id) tour_name,
    			trans_notes,user_name,trans_status_id
                from ws_transaction_tour,ws_user
                where trans_user_id = user_id";
    	
    	if($transId != null)
    	{
    		$sql .= " and trans_id=".$transId;
    	}
    	if($userId != null)
    	{
    		$sql .= " and trans_user_id=".$userId;
    	}
    	
        $sql .= " order by trans_id,trans_date asc";
    	$resSql = mysqli_query(Connection::getCon(),$sql);
		
    	while($row = mysqli_fetch_assoc($resSql)) {
    		array_push($transactions, 
                TransactionTour::create()
                    ->setTransId($row['trans_id'])
                    ->setTransUser(User::create()
                    				->setUserId($row['trans_user_id'])
                    				->setUserName($row['user_name']))
    				->setTransUserContactName($row['trans_user_contact_name'])
                    ->setTransUserContactNo($row['trans_user_contact_no'])
                    ->setTransTotalPerson($row['trans_total_person'])
                    ->setTransPrefStartDate($row['trans_pref_startdate'])
                    ->setTransPrefEndDate($row['trans_pref_enddate'])
                    ->setTransPricePerson($row['trans_price_person'])
                    ->setTransDate($row['trans_date'])
                    ->setTransTotalPrice($row['trans_total_price'])
                    ->setTransPaymentType($row['trans_payment_type'])
                    ->setTransPaymentAccName($row['trans_payment_acc_name'])
                    ->setTransPaymentDate($row['trans_payment_date'])
                    ->setTransExpiredDate($row['trans_expired_date'])
                    ->setTransInvoiceNo($row['trans_invoice_no'])
                    ->setTransStatus(Status::create()
                    				->setStatusId($row['trans_status_id'])
                    				->setStatusDesc($row['status_desc']))
                    ->setTransNotes($row['trans_notes'])
                    ->setTransTour(TourPackage::create()
                    				->setTourId($row['trans_tour_id'])
                    				->setTourName($row['tour_name']))
            );
    	}

    	return $transactions;
    }

    public function createTransaction()
    {
    	$user = $_SESSION['user'];
    	$userId = $user->getUserId();
    	
    	$fromDate = $_POST['fromDate'];
    	$toDate = $_POST['toDate'];
    	$totalPax = $_POST['totalPax'];
    	$addNotes = $_POST['addNotes'];
    	$prefix = $_POST['prefix'];
    	$personName = $_POST['personName'];
    	$personContactNo = $_POST['personContactNo'];
    	$rentVehicleStat = $_POST['rentVehicleStat'];
    	$paymentType = $_POST['paymentType'];
    	$tourId = $_POST['tourId'];
    	$pricePerson= $_POST['pricePerson'];
    	$totalPrice = $_POST['totalPrice'];
    	$statusId = 0; //for transfer payment method
    	
    	if($paymentType == "cc")
    	{
    		$statusId = 1; //for credit card payment method
    	}
    	
		$sql = "INSERT into ws_transaction_tour(trans_user_id,trans_user_contact_name,trans_user_contact_no,trans_total_person
				,trans_pref_startdate,trans_pref_enddate,trans_price_person,trans_date,
				trans_total_price,trans_payment_type,trans_expired_date,trans_tour_id,
				trans_status_id,trans_notes)
				values(
					'".$userId."',
					'".str_replace("'","",$personName)."',
					'".$personContactNo."',
					".$totalPax.",
					'".$fromDate."',
					'".$toDate."',
					".$pricePerson.",
					'".date('Y-m-d')."',
					".$totalPrice.",
					'".$paymentType."',
					'".$fromDate."',
					'".$tourId."',
					".$statusId.",
					'".str_replace("'","",$addNotes)."'
				)";
		$resSql = mysqli_query(Connection::getCon(),$sql);
		$retTransId = "fail";
		
		if($resSql)
		{
			$transId = mysqli_insert_id(Connection::getCon());
			$retTransId = $transId;
			
			$transIdStr = $transId."";
			$lenTransId = strlen($transIdStr);
			
			//generate invoice no, format : TRX0000001.. dst
			$invNo = "TRX".date('Ym');
			for($i = 0;$i < (4 - $lenTransId);$i++)
			{
				$invNo .= "0";
			}
			$invNo .= $transIdStr;
			
			$sql = "UPDATE ws_transaction_tour
					set trans_invoice_no='".$invNo."'
					where trans_id = ".$transId;
			$resSql = mysqli_query(Connection::getCon(), $sql);
		}
		
		return $retTransId;
    }
    
    public function updateTransactionStatus($transId,$statusId) 
    {
    	$sql = "UPDATE ws_transaction_tour
					set trans_status_id='".$statusId."'
					where trans_id = ".$transId;
    	
    	return mysqli_query(Connection::getCon(), $sql);
    }
	
    public function paymentConfirmation()
    {
    	$invNo = $_POST['invNo'];
    	$accName = $_POST['accName'];
    	$paymentDate = $_POST['paymentDate'];
    	$accNo = $_POST['accNo'];
    	$accBank = $_POST['accBank'];
    	$user = $_SESSION['user'];
    	
    	$sql = "SELECT trans_status_id,trans_user_contact_no,trans_total_price,trans_date,
						(select tour_points from ws_tour where trans_tour_id=tour_id) tour_points
				from ws_transaction_tour
				where trans_invoice_no='".$invNo."'";
    	$resSql = mysqli_query(Connection::getCon(), $sql);
    	
    	$retMessage = "";
    	
    	if(mysqli_num_rows($resSql) > 0)
    	{
    		$stat = "";
    		$phoneNo = "";
    		$totalPrice = 0;
    		$tourPoints = 0;
    		$transDate ="";
    		while($row = mysqli_fetch_assoc($resSql))
    		{
    			$stat = $row['trans_status_id'];
    			$phoneNo = $row['trans_user_contact_no'];
    			$totalPrice = $row['trans_total_price'];
    			$tourPoints = $row['tour_points'];
    			$transDate = $row['trans_date'];
    		}
    		
    		if($stat == "0")
    		{
    			$url = "http://api.wisataku.jazzle.me/payment";
    			$ch = curl_init();
    			curl_setopt($ch, CURLOPT_POST, 1);
    			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    			curl_setopt($ch, CURLOPT_POSTFIELDS,
    					"invoice=".$invNo."&origin=".$accBank."&destination=Mandiri&nominal=".$totalPrice);
    			
    			curl_setopt($ch, CURLOPT_URL,$url);
    			$result=curl_exec($ch);
    			
    			$data = json_decode($result);
    			curl_close($ch);
    			
    			if($data->status == "OK")
    			{
    				$sql = "UPDATE ws_transaction_tour
								set trans_payment_date='".$paymentDate."',
								trans_payment_acc_name='".str_replace("'","",$accName)."',
								trans_payment_acc_no='".$accNo."',
								trans_payment_acc_bank='".$accBank."',
								trans_status_id = 1
							where trans_invoice_no='".$invNo."'";
    				
    				$resSqlUpd = mysqli_query(Connection::getCon(),$sql);
    				$retMessage="ok";
    				
    				//send sms to customer
    				$url = "http://api.wisataku.jazzle.me/notification/sms";
    				$message = "[WisataKu] Payment for inv no : ".$invNo." has been confirmed, thank you.";
    				
    				$ch = curl_init();
    				curl_setopt($ch, CURLOPT_POST, 1);
    				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    				curl_setopt($ch, CURLOPT_POSTFIELDS,
    						"number=".$phoneNo."&message=".$message);
    				
    				curl_setopt($ch, CURLOPT_URL,$url);
    				$result=curl_exec($ch);
    				curl_close($ch);
    				
    				//send data to crm
    				$url = "http://api.wisataku.jazzle.me/crm";
    				$ch = curl_init();
    				curl_setopt($ch, CURLOPT_POST, 1);
    				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    				curl_setopt($ch, CURLOPT_POSTFIELDS,
    						"username=".$user->getUserName()."&transactionInvoice=".$invNo."&transactionDate=".$transDate.
    						"&productName=tour&issuer=WisataKu&point=".$tourPoints."&contactPhoneNumber=".$phoneNo);
    				
    				curl_setopt($ch, CURLOPT_URL,$url);
    				$result=curl_exec($ch);
    				curl_close($ch);
    			}
    		}
    		else
    		{
    			$retMessage = "paid";
    		}
    	}
    	else
    	{
    		$retMessage = "notfound";
    	}
    	
    	
    	return $retMessage;
    }
    
    
    
    public function getMonthlyTransaction()
    {
    	$data = array();

    	$sql = "SELECT * from ( select
                    MONTHNAME(trans_date) month,
                    YEAR(trans_date) year,
                    count(trans_id) numTransaction,
               		sum(trans_total_price) totalPrice
                FROM ws_transaction_tour
                group by MONTHNAME(trans_date)) a1
                
                JOIN
                
               ( Select MONTHNAME(`trans_date`), count(`trans_id`) numConfirmTransaction, sum(trans_total_price) totalConfirmedPrice  from ws_transaction_tour  where trans_status_id = 1 group by MONTHNAME(trans_date)) a2
               
                ";
    	
    	$resSql = mysqli_query(Connection::getCon(),$sql);
		
    	while($row = mysqli_fetch_assoc($resSql)) {
    		array_push($data, $row);
    	}

    	return $data;
    }
    
    
}

?>