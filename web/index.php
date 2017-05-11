
<?php 
	include_once("controller/Controller.php");
	$controller = new Controller();
	
	if(isset($_GET['cont']) && isset($_GET['action'])){
		$cont = $_GET['cont'];
		$action = $_GET['action'];
		
		if($cont== "tour")
		{
			if($action == "detail")
			{
				$controller->viewDetailTourPackage($_GET['id']);
			}
		}
		else
		{
			if($cont == "login")
			{
				if($action == "showLogin")
				{
					$controller->showLogin();
				}
				else
				{
					if($action == "doLogin")
					{
						$controller->doLogin();
					}
					else {
						$controller->doLogout();
					}
				}
			}
			else
			{
				if($cont == "transaction")
				{
					if($action == "confirmPayment")
					{
						$controller->confirmPayMent();
					}
					else {
						if($action == "doConfirmPayment")
						{
							
						}
					}
				}
			}
		}
	}
	else {
		$controller->invoke();
	}
?>