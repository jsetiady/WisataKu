<?php
    include("templates/_header.php");
?>


<div class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <?php
        	include("simple_search_form.php");
        ?>
      </div>
        
        <div class="col-md-6">
            <?php include("ads.php");?>
        </div>
      
    </div>
      
      
      
      
<h4>Upcoming Trips</h4>    
<div class="row">
  <div class="col-md-4">
    <div class="thumbnail">
      <a class="tour-item" href="../assets/images/1.jpg">
        <img src="../assets/images/1.jpg" alt="Tour Package" style="width:100%">
        <div class="caption">
          <span class="tour-title">Sailing Trip Komodo (Personal)</span>
          <span class="tour-date">20 May 2017 - 24 May 2017</span>
          <span class="tour-price">Rp 3.456.000,-</span><span class="tour-pax">/pax</span>
          <span class="tour-bonus">Bonus: 5000 points</span>
          </ul>
        </div>
      </a>
    </div>
  </div>
  <div class="col-md-4">
    <div class="thumbnail">
      <a href="/w3images/nature.jpg">
        <img src="../assets/images/2.jpg" alt="Tour Package" style="width:100%">
        <div class="caption">
          <p>Lorem ipsum...</p>
        </div>
      </a>
    </div>
  </div>
  <div class="col-md-4">
    <div class="thumbnail">
      <a href="/w3images/fjords.jpg">
        <img src="../assets/images/3.jpeg" alt="Tour Package" style="width:100%">
        <div class="caption">
          <p>Lorem ipsum...</p>
        </div>
      </a>
    </div>
  </div>
</div>

<br/>

<h4>Best Seller</h4>    
<div class="row">
  <div class="col-md-4">
    <div class="thumbnail">
      <a href="/w3images/lights.jpg">
        <img src="../assets/images/1.jpg" alt="Tour Package" style="width:100%">
        <div class="caption">
          <p>Lorem ipsum...</p>
        </div>
      </a>
    </div>
  </div>
  <div class="col-md-4">
    <div class="thumbnail">
      <a href="/w3images/nature.jpg">
        <img src="../assets/images/2.jpg" alt="Tour Package" style="width:100%">
        <div class="caption">
          <p>Lorem ipsum...</p>
        </div>
      </a>
    </div>
  </div>
  <div class="col-md-4">
    <div class="thumbnail">
      <a href="/w3images/fjords.jpg">
        <img src="../assets/images/3.jpeg" alt="Tour Package" style="width:100%">
        <div class="caption">
          <p>Lorem ipsum...</p>
        </div>
      </a>
    </div>
  </div>
</div>


</div>
<?php
    include("templates/_footer.php");
?>
