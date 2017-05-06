<?php

include_once("ModelLoadController.php");

class Controller {
	public $locationModel;
	public $tourPackageModel;
	
	public function __construct()  
    {  
         $this->locationModel = new LocationModel();
         $this->tourPackageModel = new TourPackageModel();
	
    } 
	
	public function invoke()
	{
		session_start();
		if(isset($_SESSION['userWisataku'])) {
		  	//show login page
			include 'view/loginUser.php';
		} else {
			$listLoc = $this->locationModel->getAllLocation();
			$allTourPackage = $this->tourPackageModel->getAllTourPackages();
			include 'view/home.php';
		}
	}
}

?>