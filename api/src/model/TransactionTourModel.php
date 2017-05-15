<?php
namespace WisataKu\WisataKuAPI;
include_once("TransactionTour.php");

class TransactionTourModel {
	public function getAllTransactions($args)
    {
    	$transactions = array();
    	$sql = "SELECT trans_id,trans_user_id,trans_user_contact_name,trans_user_contact_no,trans_total_person,trans_pref_startdate,
    			trans_pref_enddate,trans_price_person,trans_date,trans_total_price,trans_payment_type,
    			trans_payment_acc_name, trans_payment_acc_no, trans_payment_acc_bank,trans_payment_date,trans_expired_date,trans_tour_id,trans_invoice_no,
    			(select status_desc from ws_status where status_id = trans_status_id) status_desc,
				(select tour_name from ws_tour where tour_id=trans_tour_id) tour_name,
    			trans_notes,user_name,user_username, trans_status_id
                from ws_transaction_tour,ws_user
                where trans_user_id = user_id";
        
        
        if(isset($args['username'])) {
            $sql .= " and LCASE(user_username) = '".strtolower($args['username'])."'";
        }
        
        if(isset($args['id'])) {
            $sql .= " and trans_id = '".$args['id']."'";
        }
        
        if(isset($args['transactionstartdate'])) {
            $sql .= " and trans_date >= '".$args['transactionStartDate']."'";
        }
        
        if(isset($args['transactionenddate'])) {
            $sql .= " and trans_date <= '".$args['transactionEndDate']."'";
        }
        
        if(isset($args['invoicenumber'])) {
            $sql .= " and LCASE(trans_invoice_no) = '".strtolower($args['invoiceNumber'])."'";
        }
        
        if(isset($args['paymentstatus'])) {
            $sql .= " and LCASE(status_desc) = '".strtolower($args['paymentStatus'])."'";
        }        
    	
        $sql .= " order by trans_id,trans_date asc";
    	$resSql = mysqli_query(Connection::getCon(),$sql);
		
    	while($row = mysqli_fetch_assoc($resSql)) {
    		array_push($transactions, 
                TransactionTour::create()
                    ->setTransId($row['trans_id'])
                    ->setTransUser(User::create()
                    				->setUserId($row['trans_user_id'])
                    				->setUserName($row['user_username'])
                    				->setName($row['user_name']))
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
                    ->setTransPaymentAccNo($row['trans_payment_acc_no'])
                    ->setTransPaymentAccBank($row['trans_payment_acc_bank'])
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
    public function createTransaction($args)
    {
    	$user = $args['user'];
        $userModel = new UserModel();
    	$userId = $userModel->getUserByUserName($user)->getUserId();
    	
    	$fromDate = $args['fromDate'];
    	$toDate = $args['toDate'];
    	$totalPax = $args['totalPax'];
    	$addNotes = $args['notes'];
    	$prefix = $args['prefixName'];
    	$personName = $args['personName'];
    	$personContactNo = $args['personContactNo'];
    	$rentVehicleStat = $args['rentVehicleStat'];
    	$paymentType = $args['paymentType'];
    	$tourId = $args['tourId'];
    	$pricePerson= $args['pricePerson'];
    	$totalPrice = $args['totalPrice'];
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
			
			//generate invoice no, format : TRXYYYYMM0001.. dst
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
    
    	
    public function paymentConfirmation($args)
    {
    	$invNo = $args['invNo'];
    	$accName = $args['accName'];
    	$paymentDate = $args['paymentDate'];
    	$accNo = $args['accNo'];
    	$accBank = $args['accBank'];
    	
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