<?php
include_once("model/Model.php");
include_once("model/UserModel.php");

class Controller {
	public $model;
	public $data;
	
	public function __construct()  
    {  
        $this->model = new Model();
        $this->userModel = new UserModel();
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
			session_destroy();
			if(!isset($_SESSION['username']))
			{
			  	//show login page
			  	$this->data['title'] = "Login Page - WisataKu";
				include 'view/loginUser.php';
			}
			else
			{
				//show user home page
				include 'view/home.php';
			}
		}

	}

	public function logout()
	{
		session_destroy();
	}


	public function login()
	{
		$userObj = $this->userModel->validateUser($_POST['username'], $_POST['password']);
		if(empty($userObj))
		{
			echo "ga ada";
			echo $_POST['username'];
			echo $_POST['password'];
			//$this->data['title'] = "Login Page";
			//$this->data['errorMessage'] = "Invalid username or password";
			//echo $data['errorMessage']
			//include 'view/loginUser.php';
		} else {
			echo "ketemu";
		}
		
		
	}

}

?>