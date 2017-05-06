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
  <?php foreach ($allTourPackage as $tour)
  {
  ?>
  <div class="col-md-4">
    <div class="thumbnail">
      <a href="/w3images/lights.jpg">
        <img src="../assets/images/1.jpg" alt="Tour Package" style="width:100%">
        <div class="caption">
          <p><?= $tour->getTourName() ?></p>
          <p><?= $tour->getTourDesc() ?></p>
          <p><?= $tour->getTourStartDate() ?> - <?= $tour->getTourEndDate() ?></p>
        </div>
      </a>
    </div>
  </div>
  <?php
  }?>
</div>
<br/>
<h4>Best Seller</h4>    <br/>
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