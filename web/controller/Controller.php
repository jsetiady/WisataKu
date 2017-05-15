<?php
include_once("ModelLoadController.php");
define("ABS_PATH", $_SERVER['DOCUMENT_ROOT']."/wisataku/web/view/");
define("ABS_PATH_ROOT", $_SERVER['DOCUMENT_ROOT']."/wisataku/web/");

class Controller {
	public $locationModel;
	public $tourPackageModel;
	public $userModel;
	//public $baseurl = "http://localhost:8888/wisataku/web";
	public $baseurl = "http://localhost/wisataku/web";
	//public $imageurl = "http://images.wisataku.jazzle.me/";
	public $apiurl = "http://api.wisataku.jazzle.me/";
	public $imageurl = "http://localhost/wisataku/assets/images/";
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
    
    
    public function browsePackage()
	{    
        $filter = array();
        if(!empty($_POST)) {
            $filter = array(
                "keyword" => $_POST['keyword'],
                "tourType" => $_POST['tour_type'],
                "location" => $_POST['location'],
                "month" => $_POST['month'],
                "year" => $_POST['year'],
                "duration" => $_POST['durationGroup'],
                "participant" => $_POST['participantGroup'],
                "price" => $_POST['priceGroup'],
                "point" => $_POST['pointGroup']
            );
        }
        else
        {
        	$filter = array(
        			"keyword" => "",
        			"tourType" => "all",
        			"location" => "",
        			"month" => "",
        			"year" => "",
        			"duration" => 0,
        			"participant" => 0,
        			"price" => 0,
        			"point" => 0
        	);
        }
            
		$title = "Browse Package - WisataKu";
		$listLoc = $this->locationModel->getAllLocation();
        
        $allTourPackage = $this->tourPackageModel->getAllTourPackages(null, $filter);
                
		include 'view/tour/browsePackage.php';
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
		}
		
		include 'view/account/confirmPayment.php';
		if($confirm == "ok")
		{
			echo "<script>alert('Payment has been confirmed, thank you.');</script>";
		}
		else
		{
			if($confirm == "notfound")
			{
				echo "<script>alert('Data not found');</script>";
			}
			else
			{
				echo "<script>alert('Payment already confirmed');</script>";
			}
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
	public function browseSouvenir($cartAdd = false)
	{
		$title = "Browse Souvenir Tokoku - WisataKu";
		$url = "http://tokoku.kilatiron.com/api/v1/barang/kategori/souvenir";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url);
		$result=curl_exec($ch);
		curl_close($ch);
		
		$cartAddStatus = $cartAdd;
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
	
	public function storeCartSouvenir($ret = 0)
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
		
		if($ret == 0)
		{
			$this->viewDetailSouvenir($_POST['itemId'],"true");
		}
		else
		{
			$this->browseSouvenir("true");
			
		}
		
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
		if(!isset($_SESSION['user']))
		{
			$this->showLogin($tourId);
		}
		else
		{
			include 'view/souvenir/checkoutCart.php';
		}
		
	}
	
	public function doOrder()
	{
		$transactionId = $this->transactionSouvenirModel->createTransaction();
		
		if($transactionId != "fail")
		{
			unset($_SESSION['itemId']);
			unset($_SESSION['itemName']);
			unset($_SESSION['itemPrice']);
			unset($_SESSION['itemQty']);
			
			header("Location:".$this->baseurl."?cont=tour&action=orderHistory&status=paid&type=souvenir&id=".$transactionId);
		}
	}
    
    
    public function reportTourPackageSales() {
        $title = "Report - Monthly Tour Package Sales - WisataKu";
        $transactions = $this->transactionTourModel->getMonthlyTransaction();
        
        include 'view/report/monthlyTourPackageSales.php';
        
    }
    
    public function reportSouvenirSales() {
        $title = "Report - Monthly Souvenir Sales - WisataKu";
        
        
    }
    
}
?>