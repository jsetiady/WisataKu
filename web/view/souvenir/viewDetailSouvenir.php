<?php
    include(ABS_PATH."templates/_header.php");
?>

<script type="text/javascript">
	$("document").ready(function(){
		$("#qtySouvenir").change(function(){
			var qty = parseFloat($(this).val());
			var price = parseFloat($("#priceSouvenir").val());

			var total = parseFloat(qty * price);
			$("#totalPriceSouvenir").html("IDR "+total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+",-");
		});

		<?php 
			if($cartStatus != null)
			{
				?>
		alert("Item added to cart");
		<?php 
			}
		?>
	});
	
</script>
<div class="py-5">
<hr/>
<div class="" style="text-align: right;padding-right:130px;">
<?php 
       		$total = 0;
       		if(isset($_SESSION['itemId']))
       		{
       			$total = count($_SESSION['itemId']);
       		}
       
?>
<a href="?cont=souvenir&action=doCheckout" id="view-cart-btn" class="btn btn-sm btn-primary">View Cart (<?= $total ?>)</a>      	
</div>
<h4 style="margin-left:120px;"><a href="javascript:history.go('-1')">&lt; Back</a>&nbsp; Souvenir Details</h4>    
<hr/>
<div class="row">
  <div class="container">
  	<div class="row" style="margin-top:0px;margin-bottom:0px;">
      <div class="col-md-6">
        <img src="http://tokoku-itb.pe.hu/img/barang/<?= $souvenir['idBarang'] ?>.jpg" alt="<?= $souvenir['namaBarang'] ?>" style="width:100%"> </a>
      </div>
        <div class="col-md-6" style="margin-top:0px;">
        	<form id="cart-form" method="post" action="?cont=souvenir&action=addToCart">
	        	<p style="font-size: 14px;">Tokoku Souvenir</p>
	            <h3>"<?= $souvenir['namaBarang'] ?>"</h3>
	            <p style="font-size:14;"><?= $souvenir['deskripsi'] ?></p>
	            <p>Available Stock : <b><?= $souvenir['stok'] ?> qty(s)</b></p>
	            <p>Weight : <b><?= $souvenir['bobot']?> gram(s)</b></p>
	            <p><b>Price</b></p>
	            <h4>IDR <?= number_format($souvenir['harga'],0,".",",") ?>,- / pcs</h4>
	            <hr/>
	            <p style="font-size:16px;">Order : 
		          		<select name="qtySouvenir" id="qtySouvenir">
		          			<?php
		          				for($i=0;$i <= $souvenir['stok'];$i++)
		          				{
		          					?>
		          			<option <?php if($i==1){ echo "selected='selected'";} ?> value="<?= $i ?>"><?= $i ?></option>	
		          			<?php
		          				}
		          			?>
		          		</select> qty(s)</p>
		       <p>
		       Total Price : <span style="font-weight: bold;" id="totalPriceSouvenir"> IDR <?= number_format($souvenir['harga'],0,".",",") ?>,-</span>
		       </p>
		       <p>
		       	<input type="submit" class="btn btn-sm btn-primary" id="cart-button" value="Add to cart" />
		       	<a href="?cont=souvenir&action=doCheckout" type="button" class="btn btn-sm btn-danger">Checkout Now</a>
		       </p>
		       <input type="hidden" name="itemPrice" id="priceSouvenir" value="<?= $souvenir['harga'] ?>" />
		       <input type="hidden" name="itemId" id="itemId" value="<?= $souvenir['idBarang'] ?>" />
		       <input type="hidden" name="itemName" id="itemName" value="<?= $souvenir['namaBarang'] ?>" />
	           <input type="hidden" name="itemWeight" id="itemWeight" value="<?= $souvenir['bobot'] ?>"/>
	           <input type="hidden" name="sessionCount" id="sessionCount" value="<?= $total ?>" />
           </form>
        </div>
    </div>
    <hr/>
  </div>
  
  
</div>
<br/>
</div>
<?php
include(ABS_PATH."templates/_footer.php");
?>