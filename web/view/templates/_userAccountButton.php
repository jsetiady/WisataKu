<?php

	if(!isset($_SESSION['user'])) {
		echo '
			<a href="?cont=login&action=showLogin"><button class="mx-auto mx-md-0 btn btn-primary" type="submit">Sign in</button></a>
		';
	} else {
		$user = $_SESSION['user'];
		echo '
			<div class="dropdown">
			  <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="menu1" data-toggle="dropdown">'.$user->getName().'
			  <span class="caret"></span></button>
			  <ul class="dropdown-menu form-control-sm" role="menu" aria-labelledby="menu1">
			    <li style="padding-left:10px" role="presentation"><a role="dropdown-item" href="?cont=transaction&action=confirmPayment">Confirm payment</a></li>
			    <li style="padding-left:10px" role="presentation"><a role="dropdown-item" href="?cont=transaction&action=showHistory">Order history</a></li>
			    <li style="padding-left:10px" role="presentation" class="dropdown-divider"></li>
			    <li style="padding-left:10px" role="presentation"><a role="dropdown-item" href="?cont=login&action=doLogout">Sign out</a></li>
			  </ul>
			</div>
		';
	}


?>