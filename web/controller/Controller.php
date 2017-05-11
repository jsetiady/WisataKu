<?php
include_once("ModelLoadController.php");
class Controller {
	public $locationModel;
	public $tourPackageModel;
	public $userModel;
	public $baseurl = "http://localhost/wisataku/web";
	
	public function __construct()  
    {  
         $this->locationModel = new LocationModel();
         $this->tourPackageModel = new TourPackageModel();
         $this->userModel = new UserModel();
	
    } 
	
	public function invoke()
	{
		session_start();
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
	public function showLogin()
	{
		$title = "Login - WisataKu";
		$redirect = "false";
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
			session_start();
			$_SESSION['user'] = $user;
			
			if($redirect == "false")
			{
				header("Location:".$this->baseurl);
			}
		}
		else {
			$this->showLogin();
			echo "<script>alert('Username or password incorrect, Please Try Again')</script>";
		}
	}
	
	public function doLogout()
	{
		session_start();
		unset($_SESSION['user']);
		header("Location:".$this->baseurl);
		echo "<script>alert('Logout sucessfully')</script>";
		
	}
	//end of login
	
	
	//tour
	public function viewDetailTourPackage($tourId)
	{
		$title = "View Tour Detail - WisataKu";
		$tourDet = $this->tourPackageModel->getTourPackageByTourId($tourId);
		$allTourPackage = $this->tourPackageModel->getAllTourPackages();
		include 'view/tour/viewDetailTour.php';
	}
	
	//end of tour
	
	//transaction
	
	public function confirmPayment()
	{
		
	}
	
	//end of transaction
}
?>