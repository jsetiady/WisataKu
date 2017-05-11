<?php
    include("templates/_header.php");
?>
<div class="py-5">
    <hr/>
<h4 style="margin-left:120px;"><a href="#">&lt; Back</a>&nbsp; Tour Details</h4>    
<hr/>
<div class="row">
	
  <div class="container">
  	<div class="row" style="margin-top:0px;margin-bottom:0px;">
      <div class="col-md-6">
        <img src="../assets/images/1.jpg" alt="Tour Package" style="width:100%"> </a>
      </div>
      <?php
        	$tourType = "Personal";
        	if($tourDet->getTourType() == "g")
        	{
        		$tourType = "Group";
        	}
        ?>
        <div class="col-md-6" style="margin-top:0px;">
            <h3>"<?= $tourDet->getTourName() ?>"</h3>
            <p><b>Location : <?= $tourDet->getTourLoc()->getLocName() ?></b></p>
            <p style="font-size:14;"><?= $tourDet->getTourDesc() ?></p>
            <p><b><u><?= $tourType ?> Tour</u></b> ( From <?= $tourDet->getTourMinPerson() ?> to 
            <?= $tourDet->getTourMaxPerson() ?> person(s) )</p>
            <p style="font-size:14;">From <?= $tourDet->getTourStartDate() ?> to <?= $tourDet->getTourEndDate() ?>
             <b>( <?= $tourDet->getTourDuration() ?> day(s) )</b></p>
             
             <h5><b>Price : IDR <?= number_format($tourDet->getTourPrice(),0,",",".") ?>,- / person</b></h5>
        	 <br/>
        	 <p><a href="cont=tour&action=book&id=<?= $tourDet->getTourId() ?>" class="btn btn-primary form-control-sm">Book Now</a></p>
        </div>
    </div>
    <hr/>
    <div class="row">
    	<h5 style="margin-left:15px;">Tour Itineraries</h5>
    	<hr/>
    	<?php
    		foreach($tourDet->getTourItinerary() as $itinerary)
    		{
    			?>
    	<div style="padding-left:15px;width:100%;">
    		<p><b><?= $itinerary->getItineraryTitle() ?></b></p>
    		<p><?= $itinerary->getItineraryDesc() ?></p>
    		<hr/>
    	</div>
    	<?php
    		}
    	?>
    </div>
    <div class="row">
    	<h5 style="margin-left:15px;">Term and Conditions</h5>
    	<p style="margin-left:15px;"><?= $tourDet->getTourTc() ?></p>
    </div>
    <hr/>
    <div class="row">
    	<h5 style="margin-left:15px;">Other Tour Package Recommended for you :</h5><br/><br/>
    </div>
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
    </div>
  </div>
  <?php
  }?>
    	
    </div>
    
  </div>
  
  
</div>
<br/>
</div>
</div>
<?php
    include("templates/_footer.php");
?>