<?php
include_once("ModelLoadController.php");
define("ABS_PATH", $_SERVER['DOCUMENT_ROOT']."/wisataku/web/view/");

class Controller {
	public $locationModel;
	public $tourPackageModel;
	public $userModel;
	public $baseurl = "http://localhost/wisataku/web";
	public $transactionTourModel;
	
	public function __construct()  
    {  
    	 session_start();
         $this->locationModel = new LocationModel();
         $this->tourPackageModel = new TourPackageModel();
         $this->userModel = new UserModel();
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
		$this->transactionTourModel = new TransactionTourModel();
		$transactionId = $this->transactionTourModel->createTransaction();
		
		if($transactionId != "fail")
		{
			header("Location:".$this->baseurl."?cont=tour&action=transactionConfirm&id=".$transactionId);
		}
	}
	
	public function confirmPayment()
	{
		$title= "Confirm Payment - WisataKu";
		include 'view/account/confirmPayment.php';
	}
	
	public function doConfirmPayment()
	{
		
	}
	
	public function viewOrderHistory()
	{
		$title= "View Order History - WisataKu";
		include 'view/account/orderHistory.php';
	}
	
	//end of transaction
	
}
?>