<?php

	if(!isset($_SESSION['username'])) {
		echo '
			<a href="?page=login"><button class="mx-auto mx-md-0 btn btn-primary" type="submit">Sign in</button></a>
		';
	} else {
		echo '
			<div class="dropdown">
			  <button class="btn btn-primary dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">John Due
			  <span class="caret"></span></button>
			  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
			    <li style="padding-left:10px" role="presentation"><a role="dropdown-item" href="#">Confirm payment</a></li>
			    <li style="padding-left:10px" role="presentation"><a role="dropdown-item" href="#">Order history</a></li>
			    <li style="padding-left:10px" role="presentation" class="dropdown-divider"></li>
			    <li style="padding-left:10px" role="presentation"><a role="dropdown-item" href="#">Sign out</a></li>
			  </ul>
			</div>
		';
	}


?>