<?php
 include(ABS_PATH."templates/_header.php");
?>
	<script type="text/javascript">
		$("document").ready(function(){
			$("#paymentDate").datepicker({
				format : 'yyyy-mm-dd'
			});
		});

	</script>
	
    <div class="py-5">
      <div class="container">
        <div class="row" style="margin:auto">
          <div class="col-md-12" style="margin:auto;text-align:center;">
          	<h5 style="margin:auto;"><b>Confirm Payment</b></h5>
          	<hr/>
          </div>
           <br/><br/>
          <div class="col-md-8 form-control-sm" style="margin:auto;border:1px solid black;">
          	<p style="margin-bottom: 4px;"><b>Transfer Information</b></p>
          	<hr style="margin-top:5px;"/>
          	<form method="post" action="?cont=account&action=doConfirmPayment">
          		<?php 
          			$invNo = "";
          			if(isset($_GET['inv']))
          			{
          				$invNo = $_GET['inv'];
          			}
          		?>
	          	<table class="form-control-sm">
	          		<tr>
	          			<td style="width:150px;">Invoice No</td>
	          			<td style="width:30px;">:</td>
	          			<td class="form-control-sm" style="width:30px;"><input type="text" name="invNo" class="form-control-sm" value="<?= $invNo ?>" required="required" /></td>
	          		</tr>
	          		<tr>
	          			<td style="width:150px;">Name</td>
	          			<td style="width:30px;">:</td>
	          			<td class="form-control-sm" style="width:30px;"><input type="text" name="accName" class="form-control-sm" value="" required="required" /></td>
	          		</tr>
	          		<tr>
	          			<td style="width:150px;">Bank Name</td>
	          			<td style="width:30px;">:</td>
	          			<td class="form-control-sm" style="width:30px;"><input type="text" name="accBank" class="form-control-sm" value="" required="required" /></td>
	          		</tr>
	          		<tr>
	          			<td style="width:150px;">Bank Account No</td>
	          			<td style="width:30px;">:</td>
	          			<td class="form-control-sm" style="width:30px;"><input type="text" name="accNo" class="form-control-sm" value="" required="required" /></td>
	          		</tr>
	          		<tr>
	          			<td style="width:150px;">Date Payment</td>
	          			<td style="width:30px;">:</td>
	          			<td class="form-control-sm" style="width:30px;"><input type="text" id="paymentDate" name="paymentDate" class="form-control-sm" value="" required="required" /></td>
	          		</tr>
	          		<tr>
	          			<td colspan="3"><input type="submit" class="btn-sm btn-primary" value="Confirm" /></td>
	          		</tr>
	          	</table>
          	</form>
          </div>
        </div>
      </div>
    </div>
<?php
    include(ABS_PATH."templates/_footer.php");
?>

