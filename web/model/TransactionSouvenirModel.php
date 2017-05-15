<?php
include_once("model/TransactionSouvenir.php");
include_once("model/TransactionSouvenirItemModel.php");

class TransactionSouvenirModel {
	
	private $transactionSouvenirItemModel;
	
	public function __construct()
	{
		$this->transactionSouvenirItemModel = new TransactionSouvenirItemModel();
	}
	
	public function getAllTransaction($transSovId = null,$userId = null)
    {
    	$transactions = array();
		
    	$sql = "SELECT trans_sov_id,trans_sov_user_id,trans_sov_date,trans_sov_price,trans_sov_deliv_addr,trans_sov_province
					,trans_sov_city,trans_sov_kecamatan,trans_sov_postal_code,trans_sov_contact_name,trans_sov_contact_no
					,trans_sov_total_qty,trans_sov_invoice_no,trans_sov_payment_type,trans_sov_payment_acc_no,
					trans_sov_payment_acc_name,trans_sov_payment_acc_bank,trans_sov_payment_date,trans_sov_expired_date,
					trans_sov_notes,c.status_id,user_name,status_desc
				from ws_transaction_souvenir a,ws_user b,ws_status c
				where a.trans_sov_user_id=b.user_id
				and a.status_id=c.status_id";
    	
    	if($transSovId != null)
    	{
    		$sql .= " and a.trans_sov_id=".$transSovId;
    	}
    	
    	if($userId != null)
    	{
    		$sql .= " and trans_sov_user_id=".$userId;
    	}
    	$resSql = mysqli_query(Connection::getCon(),$sql);
    	while($row = mysqli_fetch_assoc($resSql)) {
    		array_push($transactions,
    			TransactionSouvenir::create()
    				->setTransSovId($row['trans_sov_id'])
    				->setTransSovUser(User::create()
    						->setUserId($row['trans_sov_user_id'])
    						->setName($row['user_name']))
    				->setTransSovDate($row['trans_sov_date'])
    				->setTransSovPrice($row['trans_sov_price'])
    				->setTransSovDelivAddr($row['trans_sov_deliv_addr'])
    				->setTransSovProvince($row['trans_sov_province'])
    				->setTransSovCity($row['trans_sov_city'])
    				->setTransSovKecamatan($row['trans_sov_kecamatan'])
    				->setTransSovPostalCode($row['trans_sov_postal_code'])
    				->setTransSovContactName($row['trans_sov_contact_name'])
    				->setTransSovContactNo($row['trans_sov_contact_no'])
    				->setTransSovTotalQty($row['trans_sov_total_qty'])
    				->setTransSovInvoiceNo($row['trans_sov_invoice_no'])
    				->setTransSovPaymentType($row['trans_sov_payment_type'])
    				->setTransSovPaymentAccNo($row['trans_sov_payment_acc_no'])
    				->setTransSovPaymentAccName($row['trans_sov_payment_acc_name'])
    				->setTransSovPaymentAccBank($row['trans_sov_payment_acc_bank'])
    				->setTransSovPaymentDate($row['trans_sov_payment_date'])
    				->setTransSovExpiredDate($row['trans_sov_expired_date'])
    				->setTransSovNotes($row['trans_sov_notes'])
    				->setTransSovStatus(Status::create()
    									->setStatusId($row['status_id'])
    									->setStatusDesc($row['status_desc']))
    				->setTransSovItems($this->transactionSouvenirItemModel->getAllSouvenirByTransactionId($row['trans_sov_id']))
    			);
    	}

    	return $transactions;
    }

    public function createTransaction()
    {
    	$user = $_SESSION['user'];
    	
		$itemId = $_POST["itemId"];
		$itemName = $_POST['itemName'];
		$itemPrice = $_POST['itemPrice'];
		$itemQty = $_POST['itemQty'];
		$itemNotes = $_POST['itemNotes'];
		
		$sql = "INSERT into ws_transaction_souvenir(trans_sov_user_id,trans_sov_date,trans_sov_price,trans_sov_deliv_addr,trans_sov_province
					,trans_sov_city,trans_sov_kecamatan,trans_sov_postal_code,trans_sov_contact_name,trans_sov_contact_no
					,trans_sov_total_qty,trans_sov_payment_type,
					trans_sov_expired_date,
					trans_sov_notes,status_id)
				values(
					".$user->getUserId().",
					'".date('Y-m-d')."',
					".$_POST['totalPrice'].",
					'".str_replace("'","",$_POST['personAddress'])."',
					'".str_replace("'","",$_POST['personProvince'])."',
					'".str_replace("'","",$_POST['personCity'])."',
					'".str_replace("'","",$_POST['personKecamatan'])."',
					'".str_replace("'","",$_POST['personPostalCode'])."',
					'".str_replace("'","",($_POST['prefix']." ".$_POST['personName']))."',
					'".str_replace("'","",$_POST['personContactNo'])."',
					".$_POST['totalQty'].",
					'".$_POST['paymentMethod']."',
					'".date('Y-m-d', strtotime("+30 days"))."',
					'".str_replace("'","",$_POST['addNotes'])."',
					1)";
		$resSql = mysqli_query(Connection::getCon(), $sql);
		$resSql = true;
		$retTransId = "fail";
		$data = null;
		
		if($resSql)
		{
			$retTransId = mysqli_insert_id(Connection::getCon());
			
			//prepare data for send to tokoku
			$data['alamat']['provinsi'] = str_replace("'","",$_POST['personProvince']);
			$data['alamat']['kabupaten'] = str_replace("'","",$_POST['personCity']);
			$data['alamat']['kecamatan'] = str_replace("'","",$_POST['personKecamatan']);
			$data['alamat']['detail'] = str_replace("'","",$_POST['personAddress']);
			$data['alamat']['kodepos'] = str_replace("'","",$_POST['personPostalCode']);
			$data['kodeVoucher'] = "sou123456";
			
			$itemId = $_POST["itemId"];
			$itemName = $_POST['itemName'];
			$itemPrice = $_POST['itemPrice'];
			$itemQty = $_POST['itemQty'];
			$itemNotes = $_POST['itemNotes'];
			
			for($i=0;$i<count($itemId);$i++)
			{
				$sql = "INSERT into ws_transaction_souvenir_item(item_trans_sov_id,item_id,item_name,
						item_price,item_qty,item_total_price,item_notes)
						values(
							".$retTransId.",
							".$itemId[$i].",
							'".str_replace("'","",$itemName[$i])."',
							".$itemPrice[$i].",
							".$itemQty[$i].",
							".($itemQty[$i] * $itemPrice[$i]).",
							'".str_replace("'","",$itemNotes[$i])."'
						)";
				$resSqlDet = mysqli_query(Connection::getCon(), $sql);
				
				if($resSqlDet)
				{
					$barang=null;
					$barang['idBarang'] = $itemId[$i];
					$barang['kuantitas'] = $itemQty[$i];
					
					$data['pesanan'][] = $barang;
				}
			}
			
			//generate invoice no
			$transIdStr = $retTransId."";
			$lenTransId = strlen($transIdStr);
			
			//generate invoice no, format : TRX0000001.. dst
			$invNo = "SOV".date('Ym');
			for($i = 0;$i < (4 - $lenTransId);$i++)
			{
				$invNo .= "0";
			}
			$invNo .= $transIdStr;
			
			$sql = "UPDATE ws_transaction_souvenir
					set trans_sov_invoice_no='".$invNo."'
					where trans_sov_id = ".$retTransId;
			$resSql = mysqli_query(Connection::getCon(), $sql);
			
			//send transaction to tokoku
			$url = "http://tokoku.kilatiron.com/api/v1/pembelian";
			$username = "wisataku.if5122@gmail.com";
			$pwd = "wisataku";
			
			//update payment confirmation to Tokoku
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_USERPWD, "$username:$pwd");
			curl_setopt($ch, CURLOPT_POSTFIELDS,
					json_encode($data));
			
			curl_setopt($ch, CURLOPT_URL,$url);
			$result=curl_exec($ch);
			curl_close($ch);
			
		}
		return $retTransId;
    }
    
    public function paymentConfirmation()
    {
    	$invNo = $_POST['invNo'];
    	$accName = $_POST['accName'];
    	$paymentDate = $_POST['paymentDate'];
    	$accNo = $_POST['accNo'];
    	$accBank = $_POST['accBank'];
    	
    	$sql = "SELECT trans_sov_id_tokoku,trans_sov_payment_type
				from ws_transaction_souvenir
				where trans_sov_invoice_no='".$invNo."'";
    	$resSql = mysqli_query(Connection::getCon(), $sql);
    	
    	$idTokoku = "";
    	$payType = "";
    	
    	while($row = mysql_fetch_assoc($resSql))
    	{
    		$idTokoku = $row['trans_sov_id_tokoku'];
    		$payType = $row['trans_sov_payment_type'];
    	}
    	
    	$sql = "UPDATE ws_transaction_souvenir
					set trans_sov_payment_date='".$paymentDate."',
					trans_sov_payment_acc_name='".str_replace("'","",$accName)."',
					trans_sov_payment_acc_no='".$accNo."',
					trans_sov_payment_acc_bank='".$accBank."',
					status_id = 1
				where trans_sov_invoice_no='".$invNo."'";
    	$resSql = mysqli_query(Connection::getCon(),$sql);
    	
    	$url = "http://tokoku.kilatiron.com/api/v1/pembayaran";
    	
    	//update payment confirmation to Tokoku
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_POST, 1);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($ch, CURLOPT_POSTFIELDS,
    			"idTransaksi=".$idTokoku."&metodePembayaran=".$payType."&bank=".$accBank);
    	
    	curl_setopt($ch, CURLOPT_URL,$url);
    	$result=curl_exec($ch);
    	curl_close($ch);
    	
    	return $resSql;
    }
}

?>