<?php
include(ABS_PATH."templates/_header.php");
?>
	<script type="text/javascript">
		$("document").ready(function(){
			<?php 
			if($cartAddStatus == "true")
			{ ?>
				alert("Item added to cart");
			<?php
			}
			?>
		});
	</script>
    <div class="py-5">
      <div class="container">
        <div class="row" style="margin:auto">
          <div class="col-md-12" style="margin:auto;text-align:center;">
          	<h5 style="margin:auto;"><b>Browse Souvenir from Tokoku</b></h5>
          </div>
          <div class="col-md-12" style="margin:auto;text-align:right;">
          	<?php 
	       		$total = 0;
	       		if(isset($_SESSION['itemId']))
	       		{
	       			$total = count($_SESSION['itemId']);
	       		}
	       
	       	?>
          	<a href="?cont=souvenir&action=doCheckout" id="view-cart-btn" class="btn btn-sm btn-primary">View Cart (<?= $total ?>) and Checkout</a>
          	<hr/>
          </div>
          <div class="row" style="width:100%;">
		  <?php foreach ($listSouvenir as $souvenir)
		  {
		  ?>
		  <div class="col-md-3" style="border:1px solid black; margin-bottom:4px; margin-left:0px;">
		    <div class="thumbnail" style="text-align: center;padding-top:15px;">
		      <a href="?cont=souvenir&action=detailSouvenir&id=<?= $souvenir['idBarang'] ?>">
		        <img src="http://tokoku-itb.pe.hu/img/barang/<?= $souvenir['idBarang'] ?>.jpg" alt="Tour Package" style="width:80%"> </a>
		        <hr/>
		        <div class="caption" style="min-height:50px">
		          <p><a href="?cont=souvenir&action=detailSouvenir&id=<?= $souvenir['idBarang'] ?>"><b><?= $souvenir['namaBarang'] ?></b></a></p>
		        </div>
		        <div class="caption" style="min-height:50px">
		          <p style="font-size:12px">Available Stock : <b><?= $souvenir['stok'] ?></b></p>
		        </div>
		        <div class="caption" style="min-height:80px">
		          <p style="font-size:12px;">Order : 
		          		<select id="itemQtySov<?= $souvenir['idBarang'] ?>">
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
		          		<button type="button" id="add-cart-btn-<?= $souvenir['idBarang'] ?>" class="btn btn-sm btn-primary">Add to Cart</button>
	          			<script type="text/javascript">
	          				$("#add-cart-btn-<?= $souvenir['idBarang'] ?>").click(function(){
								var id = $(this).attr("id").split("-")[3];
								if($("#itemQtySov"+id).val()==0)
								{
									alert("Qty must > 0");
								}
								else
								{
									$("#itemQty"+id).val($("#itemQtySov"+id).val());
									$("#addToCartForm"+id).submit();			
								}
		          			});
	          			</script>
	          			</p>
		        </div>
		    </div>
		  </div>
		  <form id="addToCartForm<?=$souvenir['idBarang']?>" method="post" action="?cont=souvenir&action=addToCart&ret=1">
	 	   <input type="hidden" name="itemPrice" id="priceSouvenir" value="<?= $souvenir['harga'] ?>" />
	       <input type="hidden" name="itemId" id="itemId" value="<?= $souvenir['idBarang'] ?>" />
	       <input type="hidden" name="itemName" id="itemName" value="<?= $souvenir['namaBarang'] ?>" />
           <input type="hidden" name="itemWeight" id="itemWeight" value="<?= $souvenir['bobot'] ?>"/>
           <input type="hidden" name="qtySouvenir" id="itemQty<?= $souvenir['idBarang']?>" value="0"/>
           <input type="hidden" name="sessionCount" id="sessionCount" value="<?= $total ?>" />
	 	</form>
		  <?php
		  }?>
		 
		</div>
	 	<hr/>
	 	 
        </div>
      </div>
    </div>
<?php
    include(ABS_PATH."templates/_footer.php");
?>

