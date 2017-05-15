<?php
    include(ABS_PATH."templates/_header.php");
?>

<div class="py-5">
    
    <div class="container">
      <div class="row">
        <div class="col-md-4">
            <?php
                include(ABS_PATH."templates/_advanceSearchForm.php");
            ?>
        </div>
        <div class="col-md-8">
            <?php
            
            
            if(count($allTourPackage)==0) {
                ?><center><img src="<?=$this->imageurl."no_package.png"?>" width="220px" height="176px" alt="No Package" /></center>
            <?php
            }
            
            
              $i = 0;
              foreach ($allTourPackage as $tour)
                  {
                  if($i%3 == 0) {
                      
                      ?>
              <div class="row">
              <?php
                  }
            ?>
                  
<div class="col-md-4">
    <div class="thumbnail">
      <a href="?cont=tour&action=detail&id=<?= $tour->getTourId() ?>">
        <img src="<?=$this->imageurl.$tour->getTourImageFilename()?>" alt="Tour Package" style="width:100%"> </a>
        <hr/>
        <?php
        	$tourType = "Personal";
        	if($tour->getTourType() == "g")
        	{
        		$tourType = "Group";
        	}
        ?>
        <div class="caption">
            <a href="?cont=tour&action=detail&id=<?= $tour->getTourId() ?>"><p><b><?= $tour->getTourName() ?> (<?= $tourType ?>)</b></p></a>
        </div>
        <div class="caption" style="height:50px">
            <p style="font-size:12"><?= $tour->getTourDesc() ?></p>
        </div>
        <div class="caption" style="height:100px">
          <p style="font-size:12"><?= $tour->getTourStartDate() ?> until <?= $tour->getTourEndDate() ?></p>
          <p style="font-size:12">Get <b><?= $tour->getTourPoints() ?></b> points!</p>
          <p style="font-size:12"><b>IDR <?= number_format($tour->getTourPrice(),0,".",",") ?>/ pax</b></p>
        </div>
        <div class="caption">
            <p style="font-size:12"><a href="?cont=tour&action=doBooking&id=<?= $tour->getTourId() ?>" class="btn btn-primary form-control-sm">Book Now</a></p>
        </div>
        
    </div>
  </div>
                  
                  
                  
             <?php
            if($i%3 == 2) {
           ?> </div>  <?php  
            }
            ?>
              
            <?php 
            $i++;
                }
            ?>
          
        </div>
      </div>
    </div>
    
  </div>

<?php
include(ABS_PATH."templates/_footer.php");
?>



