<?php
namespace WisataKu\WisataKuAPI;
include_once("TransactionTour.php");

class TransactionTourModel {

	public function getAllTransaction()
    {
    	$transactions = array();

    	$sql = "SELECT trans_id,trans_user_id,trans_user_telp,trans_total_person,trans_pref_startdate,
    			trans_pref_enddate,trans_price_person,trans_date,trans_total_price,trans_payment_type,
    			trans_payment_acc_no,trans_payment_date,trans_expired_date,trans_tour_id,trans_invoice_no,
    			(select status_desc from ws_status where status_id = trans_status_id) status_desc,
    			trans_notes,user_name,trans_status_id
                from ws_transaction_tour,ws_user
                where trans_user_id = user_id
                order by trans_id";
    	$resSql = mysqli_query(Connection::getCon(),$sql);

    	while($row = mysqli_fetch_assoc($resSql)) {
    		array_push($transactions, 
                TransactionTour::create()
                    ->setTransId($row['trans_id'])
                    ->setTransUser(User::create()
                    				->setUserId($row['trans_user_id'])
                    				->setUserName($row['user_name']))
                    ->setTransUserTelp($row['trans_user_telp'])
                    ->setTransTotalPerson($row['trans_total_person'])
                    ->setTransPrefStartDate($row['trans_pref_startdate'])
                    ->setTransPrefEndDate($row['trans_pref_enddate'])
                    ->setTransPricePerson($row['trans_price_person'])
                    ->setTransDate($row['trans_date'])
                    ->setTransTotalPrice($row['trans_total_price'])
                    ->setTransPaymentType($row['trans_payment_type'])
                    ->setTransPaymentAccNo($row['trans_payment_acc_no'])
                    ->setTransPaymentDate($row['trans_payment_date'])
                    ->setTransExpiredDate($row['trans_expired_date'])
                    ->setTransInvoiceNo($row['trans_invoice_no'])
                    ->setTransStatus(Status::create()
                    				->setStatusId($row['trans_status_id'])
                    				->setStatusDesc($row['status_desc']))
                    ->setTransNotes($row['trans_notes'])
                    ->setTransTour(TransactionTour::create()
                    				->setTourId($row['transaction_tour_id'])
                    				->setTourName($row['tour_name']))
            );
    	}

    	return $transactions;
    }

    public function getTransactionByTransactionId($transId) 
    {
        
    }

    public function getTransactionByUserId($userId) 
    {

    }

    public function createTransaction($transactionData)
    {

    }

    public function updateTransactionData($transactionData) 
    {

    }
    
    public function updateTransactionStatus($transId,$statusId) 
    {
        
    }
	
    public function paymentConfirmation()
    {
    	
    }

}

?>