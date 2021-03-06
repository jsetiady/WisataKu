<?php
include(ABS_PATH."templates/_header.php");
?>
<div class="py-5">
  <div class="container" style="margin-top:0px;clear:both;">
    <div class="row" style="margin-top:0px;margin-bottom:0px;">
      <div class="col-md-3">
        <?php
          include(ABS_PATH."templates/_simpleSearchForm.php");
        ?>
      </div>
        
        <div class="col-md-6" style="margin-top:0px;">
            <?php include(ABS_PATH."templates/_ads.php");?>
        </div>
    </div>
    <hr/>
<h4>All Trips</h4>    
<hr/>
<div class="row">
  <?php foreach ($allTourPackage as $tour)
  {
  ?>
  <div class="col-md-4">
    <div class="thumbnail">
      <a href="?cont=tour&action=detail&id=<?= $tour->getTourId() ?>">
        <img src="../assets/images/1.jpg" alt="Tour Package" style="width:100%"> </a>
        <hr/>
        <?php
        	$tourType = "Personal";
        	if($tour->getTourType() == "g")
        	{
        		$tourType = "Group";
        	}
        ?>
        <div class="caption" style="height:150px">
          <a href="?cont=tour&action=detail&id=<?= $tour->getTourId() ?>"><p><b><?= $tour->getTourName() ?> (<?= $tourType ?>)</b></p></a>
          <p style="font-size:12"><?= $tour->getTourDesc() ?></p>
          <p style="font-size:12">Date : <?= $tour->getTourStartDate() ?> - <?= $tour->getTourEndDate() ?></p>
          
        </div>
        <div class="caption" style="border-top:1px solid grey; border-bottom:1px solid grey;padding-top:4px;">
        	<p style="margin-bottom: 4px;"><b>Starts from IDR <?= number_format($tour->getTourPrice(),0,".",",") ?>/ person</b></p>
        </div>
        <br/>
        <div class="caption" >
        	<a href="?cont=tour&action=doBooking&id=<?= $tour->getTourId() ?>" class="btn btn-primary form-control-sm">Book Now</a>
        </div>
    </div>
  </div>
  <?php
  }?>
  
</div>
<br/>
</div>
</div>
<?php
include(ABS_PATH."templates/_footer.php");
?>