<?php
include_once("model/Model.php");

class Controller {
	public $model;
	
	public function __construct()  
    {  
        $this->model = new Model();

    } 
	
	public function invoke()
	{
		session_start();
		if(isset($_SESSION['userWisataku'])) {
		  	//show login page
			include 'view/loginUser.php';
		} else {
			//show user home page
			include 'view/home.php';
		}

	}

}

?>