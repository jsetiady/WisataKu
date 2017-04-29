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
		if(isset($_GET['page']))
		{
			switch ($_GET['page']) {
				case 'login':
					$this->login();
					break;
				
				default:
					include 'view/home.php';
					break;
			}
		}
		else
		{
			session_start();
			if(!isset($_SESSION['username']))
			{
			  	//show login page
				include 'view/loginUser.php';
			}
			else
			{
				//show user home page
				include 'view/home.php';
			}
		}

	}


	public function login()
	{
		include 'view/loginUser.php';
	}

}

?>