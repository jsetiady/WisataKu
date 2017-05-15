<?php
?>
<div class="collapse navbar-collapse justify-content-start" id="navbarSupportedContent">
    <ul class="nav navbar-nav ">
      <li class="nav-item" style="padding-left:10px"> <a class="nav-link" href="?">Home</a> 
      <li class="nav-item"> <a class="nav-link" href="?cont=tour&action=browse">Tour Package</a> 
      <li class="nav-item"> <a class="nav-link" href="?cont=souvenir&action=browseSouvenir">Souvenir</a> </li>
              
<?php
    //check is admin
    //$this->userModel = new UserModel();
	if(isset($_SESSION['user']) &&$_SESSION['user']->getIsAdmin()) {
    
?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Report
            <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="nav-item"><a class="nav-link" style="font-size:0.9rem" href="?cont=report&action=tourPackageSales">Tour Package Sales</a></li>
              <li class="nav-item"><a class="nav-link" style="font-size:0.9rem" href="?cont=souvenir&action=tourPackageSales">Souvenir Sales</a></li>
            </ul>
      </li>
<?php
    }
?>
      <li class="nav-item"> <a class="nav-link" href="#">About us</a> </li>
      <li class="nav-item"> <a class="nav-link" href="#">&nbsp;</a> </li>
    </ul>
</div>
<?php       