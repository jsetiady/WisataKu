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
			$invNo = "TRX";
			for($i = 0;$i < (7 - $lenTransId);$i++)
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
    	
    	$sql = "UPDATE ws_transaction_tour
					set trans_payment_date='".$paymentDate."',
					trans_payment_acc_name='".str_replace("'","",$accName)."',
					trans_payment_acc_no='".$accNo."',
					trans_payment_acc_bank='".$accBank."',
					trans_status_id = 1
				where trans_invoice_no='".$invNo."'";
    	return mysqli_query(Connection::getCon(),$sql);
    }
}

?>