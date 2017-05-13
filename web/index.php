<?php 
	include_once("controller/Controller.php");
	$controller = new Controller();
	
	if(isset($_GET['cont']) && isset($_GET['action'])){
		$cont = $_GET['cont'];
		$action = $_GET['action'];
		if($cont == "tour")
		{
			switch($action)
			{
				case "find" :
					$controller->findTour();
					break;
				case "detail" :
					$controller->viewDetailTourPackage($_GET['id']);
					break;
				case "doBooking" :
					$controller->doBooking($_GET['id']);
					break;
				case "confirmBooking" :
					$controller->confirmBooking($_GET['id']);
					break;
			}
		}
		else
		{
			if($cont == "login")
			{
				switch($action)
				{
					case "showLogin" :
						$controller->showLogin();
						break;
					case "doLogin" :
						$controller->doLogin();
						break;
					case "doLogout" :
						$controller->doLogout();
						break;
				}
			}
			else
			{
				if($cont == "transaction")
				{
					switch($action)
					{
						case "confirmPayment" :
							$controller->confirmPayment();
							break;
						case "doConfirmPayment" :
							$controller->doConfirmPayment();
							break;
						case "showHistory" :
							$controller->viewOrderHistory();
							break;
					}
				}
			}
		}
	}
	else {
		$controller->invoke();
	}
?>