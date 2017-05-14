<?php
include(ABS_PATH."templates/_header.php");
?>
    <div class="py-5">
      <div class="container">
        <div class="row" style="margin:auto">
          <div class="col-md-12" style="margin:auto;text-align:center;">
          	<h5 style="margin:auto;"><b>Browse Souvenir</b></h5>
          </div>
          <div class="col-md-12" style="margin:auto;text-align:right;">
          	<button type="button" id="view-cart-btn" class="btn btn-sm btn-primary">View Cart</button>
          	<hr/>
          </div>
          <div class="row" style="width:100%;">
  <?php foreach ($listSouvenir as $souvenir)
  {
  ?>
	  <div class="col-md-3" style="border:1px solid black; margin-bottom:4px; margin-left:0px;">
	    <div class="thumbnail" style="text-align: center;padding-top:15px;">
	      <a href="?cont=tour&action=detail&id=<?= $souvenir['idBarang'] ?>">
	        <img src="http://tokoku-itb.pe.hu/img/barang/<?= $souvenir['idBarang'] ?>.jpg" alt="Tour Package" style="width:80%"> </a>
	        <hr/>
	        
	        <div class="caption" style="height:50px">
	          <p><b><?= $souvenir['namaBarang'] ?></b></p>
	        </div>
	        <div class="caption" style="height:50px">
	          <p style="font-size:12px">Available Stock : <b><?= $souvenir['stok'] ?></b></p>
	        </div>
	        <div class="caption" style="height:80px">
	          <p style="font-size:12px;">Order : 
	          		<select>
	          			<?php
	          				for($i=0;$i <= $souvenir['stok'];$i++)
	          				{
	          					?>
	          			<option value="<?= $i ?>"><?= $i ?></option>	
	          			<?php
	          				}
	          			?>
	          		</select> qty(s)</p>
	          		<p>
	          		<button type="button" id="view-cart-btn" class="btn btn-sm btn-primary">Add to Cart</button>
          			</p>
	        </div>
	    </div>
	  </div>
	  <?php
	  }?>
	  
	</div>
        </div>
      </div>
    </div>
<?php
    include(ABS_PATH."templates/_footer.php");
?>

