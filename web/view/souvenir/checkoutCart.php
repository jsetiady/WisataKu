<?php
 include(ABS_PATH."templates/_header.php");
?>
<script type="text/javascript">
	$("document").ready(function() {
		
	});
</script>
    <div class="py-5">
      <div class="container">
        <div class="row" style="margin:auto">
          <div class="col-md-12" style="margin:auto;text-align:center;">
          	<h5 style="margin:auto;"><b>View Cart</b></h5>
          	<hr/>
          </div>
           <br/><br/>
          <div class="col-md-12 form-control-sm" style="margin:auto; text-align:center;">
          <?php 
          	if(isset($_SESSION['itemId']))
          	{
          ?>
          <form method="post" action="?cont=souvenir&action=doOrder">
          	<table border="1" style="width:100%; margin:auto; font-size:12px;">
          		<thead>
          			<tr style="background-color:black;color:white;">
          				<th>No</th>
          				<th>Item Name</th>
          				<th>Qty</th>
          				<th>Price</th>
          				<th>Total Price</th>
          				<th style="width:200px">Notes</th>
          				<th style="text-align: center;">Delete</th>
          			</tr>
          		</thead>
          		<tbody>
          			<?php
          				$no = 1;
          				$totalPrice = 0;
          				for($i=0; $i<count($_SESSION['itemId']); $i++)
          					if(isset($_SESSION['itemId'][$i])) {
          				{
          			?>
          			<tr>
          				<td style="text-align: right; padding-right:2px;"><?= $no ?></td>
          				<td style="padding-left:4px;"><a target="_blank" href="?cont=souvenir&action=detailSouvenir&id=<?= $_SESSION['itemId'][$i] ?>"><?= $_SESSION['itemName'][$i]?></a></td>
          				<td style="text-align: right;padding-right:4px"><?= $_SESSION['itemQty'][$i]?></td>	
          				<td style="text-align: right;padding-right:4px">IDR <?= number_format($_SESSION['itemPrice'][$i],0,".",",") ?>,-</td>
          				<td style="text-align: right;padding-right:4px">IDR <?php echo number_format(($_SESSION['itemPrice'][$i] * $_SESSION['itemQty'][$i]),0,".",",") ?>,-</td>
          				<td><textarea rows="2" cols="30" style="width:100%"></textarea></td>
          				<td style="text-align: center;"><button id="btn-del-item-<?= $i ?>" type="button" class="btn btn-sm btn-danger" style="font-size: smaller; height:20px;padding-top:2px;">X</button></td>
          			</tr>
          			<script type="text/javascript">
          				$("#btn-del-item-<?= $i ?>").click(function(){
							var row = $(this).attr("id").split("-")[3];
							var conf = confirm("Delete this item from cart ?");
							if(conf)
							{
								$("#row").val(row);
								$("#deleteItemCartForm").submit();
							}
                  		});
          			</script>
          			<?php
          			$no++;
          			$totalPrice += ($_SESSION['itemPrice'][$i] * $_SESSION['itemQty'][$i]);
          				}
          				
          				}
          			?>
          			<tr>
          				<td colspan="4" style="text-align: right; padding-right:4px;"><b>Total</b></td>
          				<td style="text-align:right;padding-right:4px;">IDR <?= number_format($totalPrice,0,".",",")?>,-</td>
          				<td colspan="2"></td>
          			</tr>
          		</tbody>
          	</table>
          	<hr/>
          	<h6 style="text-align: left;">Shipping Information</h6>
          	<hr/>
          		<table style="font-size:14px">
          			<tr>
          				<td style="width:150px">Address</td>
          				<td style="width:30px">:</td>
          				<td><input style="width:400px" type="text" name="personAddress" class="form-control form-control-sm" required="required" /></td>
          			</tr>
          			<tr>
          				<td style="width:150px">Province</td>
          				<td style="width:30px">:</td>
          				<td><input style="width:200px" type="text" name="personProvince" class="form-control form-control-sm" required="required" /></td>
          			</tr>
          			<tr>
          				<td style="width:150px">Kabupaten / City</td>
          				<td style="width:30px">:</td>
          				<td><input style="width:200px" type="text" name="personCity" class="form-control form-control-sm" required="required" /></td>
          			</tr>
          			<tr>
          				<td style="width:150px">Kecamatan / District</td>
          				<td style="width:30px">:</td>
          				<td><input style="width:200px" type="text" name="personKecamatan" class="form-control form-control-sm" required="required" /></td>
          			</tr>
          			<tr>
          				<td style="width:150px">Postal Code</td>
          				<td style="width:30px">:</td>
          				<td><input style="width:100px" type="text" name="personKecamatan" class="form-control form-control-sm" /></td>
          			</tr>
          			<tr>
          				<td><hr/></td>
          			</tr>
          			<tr>
          				<td colspan="3"><input type="submit" value="Checkout Now" class="btn btn-sm btn-primary" /></td>
          			</tr>
          		</table>
          		
          		</form>
          	<?php } else {
          		?>
          	<h5>Cart Empty</h5>
          	<?php 
          	}?>
          	<form method="post" id="deleteItemCartForm" action="?cont=souvenir&action=deleteItemCart">
          		<input type="hidden" name="row" id="row" />
          	</form>
          	
          </div>
        </div>
      </div>
    </div>
<?php
    include(ABS_PATH."templates/_footer.php");
?>

