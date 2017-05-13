<?php
 include(ABS_PATH."templates/_header.php");
?>
	<script type="text/javascript">
		$("document").ready(function() {
			$("#ccRadio").click(function(){
				$("#cc-div").show();
				$("#trf-div").hide();
				$("#paymentType").val("cc");
				$(".cc-input").each(function(){
					$(this).attr("required","required");
				});
			});

			$("#trfRadio").click(function(){
				$("#trf-div").show();
				$("#cc-div").hide();
				$("#paymentType").val("trf");
				$(".cc-input").each(function(){
					$(this).removeAttr("required");
				});
			});

			$("#agreeCheck").click(function(){
				if($(this).is(":checked")){
					$("#confirmButton").prop("disabled",false);
				}
				else
				{
					$("#confirmButton").prop("disabled",true);
				}
					
			});
		});
	
	</script>
    <div class="py-5">
      <div class="container">
        <div class="row" style="margin:auto">
          <div class="col-md-12" style="margin:auto;text-align:center;">
          	<h5 style="margin:auto;"><b>Booking Confirmation Form</b></h5>
          	<hr/>
          </div>
           <br/><br/>
          <div class="col-md-12 form-control-sm" style="margin:auto;">
          <form method="post" action="?cont=tour&action=doTransaction"> 
          	<div class="row">
          		<p><b>Items to Book</b></p>
          	</div>
          	<div class="row">
          		<table border="1" style="width:90%;font-size:13;">
          			<thead>
          				<tr style="background-color:black;color:white;line-height:25px;">
          					<th style="width:200px;padding-left:4px;">Item</th>
          					<th style="width:120px;padding-left:4px;">Price</th>
          					<th style="width:90px;padding-left:4px;">Total pax</th>
          					<th style="width:40px;padding-left:4px;">Duration</th>
          					<th style="width:100px;padding-left:4px;">Total</th>
          					<th style="padding-left:4px;">Notes</th>
          				</tr>
          			</thead>
          			<tbody>
						<tr>
							<?php 
								if($addNotes == "")
								{
									$addNotes = "-";
								}
							?>
							<td style="padding-left:4px"><?= $tourDet->getTourName() ?></td>
							<td style="text-align:right; padding-right:4px;">IDR <?= number_format($tourDet->getTourPrice(),0,".",",") ?></td>
							<td style="text-align:right; padding-right:4px;"><?= $totalPax?></td>
							<td style="text-align:center;">-</td>
							<td style="text-align:right; padding-right:4px;">IDR <?php echo number_format(($totalPax * $tourDet->getTourPrice()),0,",",".") ?></td>
							<td style="padding-left:4px;"><b>Trip Duration : </b><?= $tourDet->getTourDuration() ?> days
								<br/>
								<?= $tourDet->getTourStartDate() ?> - <?= $tourDet->getTourEndDate() ?>
								<br/>
								<b>Additional Notes</b> <br/>
								<?= $addNotes ?>
							</td>
						</tr>          				
          			</tbody>
          		</table>
          	</div>
          	<hr/>
          	
          	<div class="row">
          		<p><b>Contact Information</b></p>
          	</div>
          	<div class="row">
          		<table>
          			<tr>
          				<td style="width:120px">Name</td>
          				<td style="width:30px">:</td>
          				<td><?= $prefix." ".$personName ?></td>
          			</tr>
          			<tr>
          				<td style="width:120px">Phone Number</td>
          				<td style="width:30px">:</td>
          				<td><?= $personContactNo ?></td>
          			</tr>
          		</table>
          	</div>
          	<hr/>
          	<div class="row">
          		<p><b>Select Payment Method</b></p>
          	</div>
          	<div class="row">
          		<input type="radio" value="cc" id="ccRadio" name="paymentMethod" checked="checked" /> &nbsp; Credit Card
          		&nbsp; &nbsp;<input type="radio" id="trfRadio" value="trf" name="paymentMethod" /> &nbsp; Bank Transfer
          	</div>
          	<div class="row" id="cc-div" style="border:1px solid black; width:420px;padding-left:5px;margin-top:10px;">
          		<table>
          			<tr>
          				<td style="width:160px">CC Holder Name</td>
          				<td style="width:30px">:</td>
          				<td><input type="text" name="ccHolderName" class="cc-input form-control form-control-sm" required="required" /></td>
          			</tr>
          			<tr>
          				<td style="width:120px">Credit Card Number</td>
          				<td style="width:30px">:</td>
          				<td><input type="text" name="ccCreditCardNumber" class="cc-input form-control form-control-sm" required="required" /></td>
          			</tr>
          			<tr>
          				<td style="width:120px">Expired Date</td>
          				<td style="width:30px">:</td>
          				<td><input type="text" name="ccExpiredDate" class="cc-input form-control form-control-sm" required="required" /></td>
          			</tr>
          			<tr>
          				<td style="width:120px">CVV</td>
          				<td style="width:30px">:</td>
          				<td><input type="text" name="ccCvv" class="cc-input form-control form-control-sm" required="required" /></td>
          			</tr>
          		</table>
          	</div>
          	<hr/>
          	<div class="row">
          		<div class="col-md-6"></div>
          		<div class="col-md-6"><p>You Get <b><?= $tourDet->getTourPoints() ?> bonus points</b> after payment confirmed</p>
          		<p><input type="checkbox" value="agreeCheck" id="agreeCheck" /> <b>I agree with the terms and condition</b>
          		   <br/>
          		   <hr/>
          		   <input type="submit" disabled="disabled" value="Confirm" id="confirmButton" class="btn btn-primary btn-sm" />
          		</p>
          		</div>
          	</div>
          	<input type="hidden" name="tourId" value="<?= $tourDet->getTourId() ?>" />
          	<input type="hidden" name="fromDate" value="<?= $fromDate ?>" />
          	<input type="hidden" name="toDate" value="<?= $toDate ?>" />
          	<input type="hidden" name="totalPax" value="<?= $totalPax ?>" />
          	<input type="hidden" name="addNotes" value="<?= $addNotes ?>" />
          	<input type="hidden" name="prefix" value="<?= $prefix ?>" />
          	<input type="hidden" name="personName" value="<?= $personName ?>" />
          	<input type="hidden" name="personContactNo" value="<?= $personContactNo ?>" />
          	<input type="hidden" name="rentVehicleStat" value="<?= $rentVehicleStat ?>" />
          	<input type="hidden" name="paymentType" id="paymentType" value="cc" />
          	<input type="hidden" name="pricePerson" id="pricePerson" value="<?= $tourDet->getTourPrice() ?>" />
          	<input type="hidden" name="totalPrice" id="totalPrice" value="<?php echo ($tourDet->getTourPrice() * $totalPax) ?>" />
          	</form>
          </div>
        </div>
      </div>
    </div>
<?php
    include(ABS_PATH."templates/_footer.php");
?>

