<?php

	if(isset($_SESSION['username']))
	{
		echo '
			<div class="collapse navbar-collapse justify-content-start" id="navbarSupportedContent">
			    <ul class="nav navbar-nav ">
			      <li class="active nav-item" style="padding-left:10px"> <a class="nav-link" href="#">Home</a> 
			      <li class="nav-item"> <a class="nav-link" href="#">Tour Package</a> 
			      <li class="nav-item"> <a class="nav-link" href="#">Souvenir</a> </li>
			      <li class="nav-item"> <a class="nav-link" href="#">About us</a> </li>
			      <li class="nav-item"> <a class="nav-link" href="#">&nbsp;</a> </li>
			    </ul>
			</div>
		';
	}