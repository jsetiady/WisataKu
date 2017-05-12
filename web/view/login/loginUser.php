<?php
    include(ABS_PATH."templates/_header.php");
?>



<a class="navbar-brand" href="#">
    <div class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
          	
          </div>
          <div class="col-md-6">
            <form class="" method="post" action="?cont=login&action=doLogin">
                <center>Customer Login</center><br/>
              <div class="form-group"> <label>Username</label> 
              <input name="username" type="text" class="form-control" placeholder="Enter username"> </div>
              <div class="form-group"> <label>Password</label> 
              <input name="password" type="password" class="form-control" placeholder="Password"> </div> <button type="submit" class="btn btn-primary">Sign In</button> 
              <input name="redirect" type="hidden" value="<?= $redirect ?>" />
              </form>
          	  
          </div>
        </div>
      </div>
    </div>
  </a>


<?php
	include(ABS_PATH."templates/_footer.php");
?>

