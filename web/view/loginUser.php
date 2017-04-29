<?php
    include("templates/_header.php");
?>



<a class="navbar-brand" href="#">
    <div class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-6"></div>
          <div class="col-md-6">
            <form class="" method="post" action="?page=login&action=login">
                <center>Login Pelanggan</center><br/>
              <div class="form-group"> <label>Username</label> <input type="text" class="form-control" placeholder="Enter username"> </div>
              <div class="form-group"> <label>Password</label> <input type="password" class="form-control" placeholder="Password"> </div> <button type="submit" class="btn btn-primary">Sign In</button> </form>
          </div>
        </div>
      </div>
    </div>
  </a>


<?php
    include("templates/_footer.php");
?>

