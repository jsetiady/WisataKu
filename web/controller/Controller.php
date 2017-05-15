<?php
include_once("ModelLoadController.php");
define("ABS_PATH", $_SERVER['DOCUMENT_ROOT']."/wisataku/web/view/");
define("ABS_PATH_ROOT", $_SERVER['DOCUMENT_ROOT']."/wisataku/web/");

class Controller {
	public $locationModel;
	public $tourPackageModel;
	public $userModel;
	public $baseurl = "http://localhost/wisataku/web";
	public $transactionTourModel;
	public $transactionSouvenirModel;
	
	public function __construct()  
    {  
    	 session_start();
         $this->locationModel = new LocationModel();
         $this->tourPackageModel = new TourPackageModel();
         $this->userModel = new UserModel();
         $this->transactionTourModel = new TransactionTourModel();
         $this->transactionSouvenirModel = new TransactionSouvenirModel();
    } 
	
	public function invoke()
	{
		if(isset($_SESSION['userWisataku'])) {
		  	//show login page
			include 'view/loginUser.php';
		} else {
			$title = "Home - WisataKu";
			$listLoc = $this->locationModel->getAllLocation();
			$allTourPackage = $this->tourPackageModel->getAllTourPackages();
			include 'view/home.php';
		}
	}
	
	//login page
	public function showLogin($redirectVal = "false")
	{
		$title = "Login - WisataKu";
		$redirect = $redirectVal;
		include 'view/login/loginUser.php';
	}
	
	public function doLogin()
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$redirect = $_POST['redirect'];
		
		$user = $this->userModel->validateUser($username, $password);
		
		if($user != null)
		{
			$_SESSION['user'] = $user;
			
			if($redirect == "false")
			{
				header("Location:".$this->baseurl);
			}
			else
			{
				header("Location:".$this->baseurl."/?cont=tour&action=doBooking&id=".$redirect);
			}
		}
		else {
			$this->showLogin();
			echo "<script>alert('Username or password incorrect, Please Try Again')</script>";
		}
	}
	
	public function doLogout()
	{
		unset($_SESSION['user']);
		unset($_SESSION['itemId']);
		unset($_SESSION['itemName']);
		unset($_SESSION['itemPrice']);
		unset($_SESSION['itemQty']);
		unset($_SESSION['itemWeight']);
		
		header("Location:".$this->baseurl);
		echo "<script>alert('Logout sucessfully')</script>";
		
	}
	//end of login
	
	
	//tour
	public function findTour()
	{
		$title = "Home - WisataKu";
		$listLoc = $this->locationModel->getAllLocation();
		$allTourPackage = $this->tourPackageModel->getAllTourPackages();
		include 'view/tour/findTour.php';
	}
	
	
	public function viewDetailTourPackage($tourId)
	{
		$title = "View Tour Detail - WisataKu";
		$tourDet = $this->tourPackageModel->getAllTourPackages($tourId)[0];
		$allTourPackage = $this->tourPackageModel->getAllTourPackages();
		include 'view/tour/viewDetailTour.php';
	}
	
	//end of tour
	
	//transaction
	public function doBooking($tourId)
	{
		$title = "Booking - WisataKu";
		
		if(!isset($_SESSION['user']))
		{
			$this->showLogin($tourId);
		}
		else
		{
			$tourDet = $this->tourPackageModel->getAllTourPackages($tourId)[0];
			include 'view/tour/bookingForm.php';
		}
	}
	
	public function confirmBooking()
	{
		$title = "Booking Confirmation - WisataKu";
		
		$tourDet = $this->tourPackageModel->getAllTourPackages($_POST['tourId'])[0];
		$fromDate = $_POST['fromDate'];
		$toDate = $_POST['toDate'];
		$totalPax = $_POST['totalPax'];
		$addNotes = $_POST['additionalNotes'];
		$prefix = $_POST['prefix'];
		$personName = $_POST['personName'];
		$personContactNo = $_POST['personContactNo'];
		$rentVehicleStat = $_POST['rentVehicleStatus'];
		
		include 'view/tour/bookingConfirmationForm.php';
	}
	
	public function doTransaction()
	{
		$transactionId = $this->transactionTourModel->createTransaction();
		
		if($transactionId != "fail")
		{
			if($_POST['paymentType'] == "trf")
			{
				header("Location:".$this->baseurl."?cont=tour&action=transactionConfirm&id=".$transactionId);
			}
			else 
			{
				header("Location:".$this->baseurl."?cont=tour&action=orderHistory&status=paid&id=".$transactionId);
			}
		}
	}
	
	public function transactionCreatedView($transId)
	{
		$title = "Transaction Created - WisataKu";
		$transaction = $this->transactionTourModel->getAllTransactions($transId,null)[0];
		include 'view/tour/transactionCreatedViewer.php';
	}
	
	public function confirmPayment()
	{
		$title= "Confirm Payment - WisataKu";
		include 'view/account/confirmPayment.php';
	}
	
	public function doConfirmPayment()
	{
		$title= "Confirm Payment - WisataKu";
		$confirm = "";
		if(substr($_POST['invNo'],0,3)== 'TRX')
		{
			$confirm = $this->transactionTourModel->paymentConfirmation();
		}
		else
		{
			$confirm = $this->transactionSouvenirModel->paymentConfirmation();
			if($confirm)
			{
			}
		}
		
		include 'view/account/confirmPayment.php';
		if($confirm)
		{
			echo "<script>alert('Payment has been confirmed, thank you.');</script>";
		}
	}
	
	public function viewOrderHistory()
	{
		$title= "View Order History - WisataKu";
		$user = $_SESSION['user'];
		$transactions = $this->transactionTourModel->getAllTransactions(null,$user->getUserId());
		$transactionSouvenir = $this->transactionSouvenirModel->getAllTransaction(null,$user->getUserId());
		include 'view/account/orderHistory.php';
	}
	
	//end of transaction
	
	//souvenir
	public function browseSouvenir()
	{
		$title = "Browse Souvenir Tokoku - WisataKu";
		$url = "http://tokoku.kilatiron.com/api/v1/barang/kategori/souvenir";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url);
		$result=curl_exec($ch);
		curl_close($ch);
		
		$listSouvenir = json_decode($result,true);
		include 'view/souvenir/browseSouvenir.php';
	}
	
	public function viewDetailSouvenir($souvenirId,$cartAdd = null)
	{
		$title = "View Detail Souvenir - WisataKu";
		$url = "http://tokoku.kilatiron.com/api/v1/barang/".$souvenirId;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url);
		$result=curl_exec($ch);
		curl_close($ch);
		
		$cartStatus = $cartAdd;
		$souvenir = json_decode($result,true);
		include 'view/souvenir/viewDetailSouvenir.php';
	}
	
	public function storeCartSouvenir()
	{
		$key = -1;
		if(isset($_SESSION['itemId']))
		{
			for($i = 0;$i<count($_SESSION['itemId']);$i++)
			{
				if(isset($_SESSION['itemId']) && $_SESSION['itemId'][$i] == $_POST['itemId'])
				{
					$key = $i;
				}
			}
		}
		
		if($key == "-1")
		{
			$_SESSION['itemId'][]= $_POST['itemId'];
			$_SESSION['itemName'][]=$_POST['itemName'];
			$_SESSION['itemPrice'][]=$_POST['itemPrice'];
			$_SESSION['itemQty'][]=$_POST['qtySouvenir'];
			$_SESSION['itemWeight'][]=$_POST['itemWeight'];
		}
		else {
			$_SESSION['itemQty'][$key] += $_POST['qtySouvenir'];
			$_SESSION['itemWeight'][$key] += $_POST['itemWeight'];
		}
		
		$this->viewDetailSouvenir($_POST['itemId'],"true");
	}
	
	public function deleteItemCart()
	{
		$title = "View cart and checkout - WisataKu";
		$_POST['row'] = 0;
		unset($_SESSION['itemId'][$_POST['row']]);
		unset($_SESSION['itemName'][$_POST['row']]);
		unset($_SESSION['itemPrice'][$_POST['row']]);
		unset($_SESSION['itemQty'][$_POST['row']]);
		
		include 'view/souvenir/checkoutCart.php';
	}
	
	public function checkoutSouvenir()
	{
		$title = "View cart and checkout - WisataKu";
		include 'view/souvenir/checkoutCart.php';
	}
	
	public function doOrder()
	{
		$transactionId = $this->transactionSouvenirModel->createTransaction();
		
		if($transactionId != "fail")
		{
// 			if($_POST['paymentType'] == "trf")
// 			{
// 			//	header("Location:".$this->baseurl."?cont=tour&action=transactionConfirm&id=".$transactionId);
// 			}
// 			else
// 			{
// 			//	header("Location:".$this->baseurl."?cont=tour&action=orderHistory&status=paid&id=".$transactionId);
// 			}
		}
	}
}
?>