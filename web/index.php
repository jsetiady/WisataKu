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
                case "browse" :
					$controller->browsePackage();
					break;
				case "detail" :
					$controller->viewDetailTourPackage($_GET['id']);
					break;
				case "doBooking" :
					$controller->doBooking($_GET['id']);
					break;
                case "addRental" :
					$controller->addRental($_GET['id']);
					break;
				case "confirmBooking" :
					$controller->confirmBooking();
					break;
				case "doTransaction" :
					$controller->doTransaction();
					break;
				case "transactionConfirm" :
					$controller->transactionCreatedView($_GET['id']);
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
				if($cont == "account")
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
				else
				{
					if($cont == "souvenir")
					{
						switch($action)
						{
							case "browseSouvenir" :
								$controller->browseSouvenir();
								break;
							case "detailSouvenir" :
								$controller->viewDetailSouvenir($_GET['id']);
								break;
							case "addToCart" :
								$controller->storeCartSouvenir();
								break;
							case "doCheckout" :
								$controller->checkoutSouvenir();
								break;
							case "deleteItemCart" :
								$controller->deleteItemCart();
								break;
							case "doOrder" :
								$controller->doOrder();
								break;
							case "doTransaction" :
								$controller->doSouvenirTransaction();
								break;
						}
					}
                    else {
                        if($cont == "report")
                        {
                            switch($action)
                            {
                                case "tourPackageSales" :
                                    $controller->reportTourPackageSales();
                                    break;
                                case "souvenirSales" :
                                    $controller->reportSouvenirSales($_GET['id']);
                                    break;
                            }
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