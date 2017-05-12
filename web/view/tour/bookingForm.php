<?php
 include(ABS_PATH."templates/_header.php");
?>
	<script type="text/javascript">
	</script>
    <div class="py-5">
      <div class="container">
        <div class="row" style="margin:auto">
          <div class="col-md-12" style="margin:auto;text-align:center;">
          	<h5 style="margin:auto;"><b>Booking Form</b></h5>
          	<hr/>
          </div>
           <br/><br/>
          <div class="col-md-12 form-control-sm" style="margin:auto;">
          	<div class="row">
          	<form method="post" action="?cont=tour&action=confirmBooking">
          		<input type="hidden" name="tourId" value="<?= $tourDet->getTourId() ?>" />
          		<table>
          			<tr style="">
          				<td colspan="6" style=""><b>Tour Information</b></td>
          			<tr>
          			<tr>
          				<td colspan="6"><hr/></td>
          			</tr>
          			<tr>
          				<td style="width:150px;">Tour Name</td>
          				<td style="width:40px">:</td>
          				<td style="width:350px"><?= $tourDet->getTourName() ?></td>
          				<td style="width:150px;">Tour Duration</td>
          				<td style="width:40px">:</td>
          				<td><?= $tourDet->getTourDuration() ?> day(s)</td>
          			</tr>
          			<?php
			        	$tourType = "Personal";
			        	if($tourDet->getTourType() == "g")
			        	{
			        		$tourType = "Group";
			        	}
			        ?>
          			<tr >
          				<td style="width:150px;">Tour Type</td>
          				<td style="width:40px">:</td>
          				<td style="width:350px"><?= $tourType?></td>
          				<td style="width:150px;">Price per pax</td>
          				<td style="width:40px">:</td>
          				<td>IDR <?= number_format($tourDet->getTourPrice(),0,".",",") ?>,-</td>
          			</tr>
          			<tr >
          				<td style="width:150px;">Location</td>
          				<td style="width:40px">:</td>
          				<td style="width:350px"><?= $tourDet->getTourLoc()->getLocName() ?></td>
          				<td style="width:150px;">Points</td>
          				<td style="width:40px">:</td>
          				<td><?= number_format($tourDet->getTourPoints(),0,".",",") ?> point(s)</td>
          			</tr>
          			<tr>
          				<td colspan="6"><hr/></td>
          			</tr>
          			<tr style="">
          				<td colspan="6" style=""><b>Booking Information</b></td>
          			<tr>
          			<tr>
          				<td colspan="6"><hr/></td>
          			</tr>
          			<tr >
          				<td style="width:150px;">Booking Date</td>
          				<td style="width:40px">:</td>
          				<td style="width:150px">
          					<input type="checkbox" name="usePrefDate" checked="checked" /> Use default date
          				</td>
          			</tr>
          			<tr >
          				<td style="width:150px;">From Date</td>
          				<td style="width:40px">:</td>
          				<td style="width:150px">
          					<input type="text" class="form-control form-control-sm booking-date" value="<?= $tourDet->getTourStartDate() ?>" style="width:150px;background-color:lightgrey;" readonly="readonly" name="fromDate" /> 
          				</td>
          			</tr>
          			<tr >
          				<td style="width:150px;">To Date</td>
          				<td style="width:40px">:</td>
          				<td style="width:150px">
          					<input type="text" class="form-control form-control-sm booking-date" value="<?= $tourDet->getTourEndDate() ?>" style="width:150px;background-color:lightgrey;" readonly="readonly" name="toDate" />
          				</td>
          			</tr>
          			<tr >
          				<td style="width:150px;">Total Pax</td>
          				<td style="width:40px">:</td>
          				<td style="width:70px">
          					<input type="text" class="form-control form-control-sm" value="<?= $tourDet->getTourMinPerson() ?>" style="width:70px;" name="totalPax" />
          				</td>
          			</tr>
          			<tr>
          				<td colspan="2"></td>
          				<td style="font-size:11;">Min : <?= $tourDet->getTourMinPerson() ?> person, Max : <?= $tourDet->getTourMaxPerson() ?> person</td>
          			</tr>
          			<tr >
          				<td style="width:150px;">Additional Notes</td>
          				<td style="width:40px">:</td>
          				<td style="width:70px">
          					<textarea name="additionalNotes" class="form-control form-control-sm" rows="5">
          					
          					</textarea>
          				</td>
          			</tr>
          			<tr>
          				<td colspan="6"><hr/></td>
          			</tr>
          			<tr style="">
          				<td colspan="6" style=""><b>Contact Information</b></td>
          			<tr>
          			<tr>
          				<td colspan="6"><hr/></td>
          			</tr>
          			<tr>
          				<td colspan="6">
          					<input type="radio" name="prefix" value="Mr." checked="checked" /> Mr.
          					<input type="radio" name="prefix" value="Mrs."/> Mrs.
          					<input type="radio" name="prefix" value="Ms."/> Ms.
          				</td>
          			</tr>
          			<tr >
          				<td style="width:150px;">Name</td>
          				<td style="width:40px">:</td>
          				<td style="width:70px">
          					<input type="text" class="form-control form-control-sm" value="" style="width:250px;" name="personName" />
          				</td>
          			</tr>
          			<tr >
          				<td style="width:150px;">Contact No</td>
          				<td style="width:40px">:</td>
          				<td style="width:70px">
          					<input type="text" class="form-control form-control-sm" style="width:250px;" name="personContactNo" />
          				</td>
          			</tr>
          			<tr>
          				<td colspan="6"><hr/></td>
          			</tr>
          			<tr style="">
          				<td colspan="6" style=""><b>Additional Booking</b></td>
          			<tr>
          			<tr>
          				<td colspan="6"><hr/></td>
          			</tr>
          			<tr >
          				<td style="width:150px;">Rent Vehicle</td>
          				<td style="width:40px">:</td>
          				<td style="width:150px">
          					<input type="radio" name="rentVehicleStatus" value="yes" /> Yes
          					<input type="radio" name="rentVehicleStatus" value="no" checked="checked" /> No
          				</td>
          			</tr>
          			<tr>
          				<td colspan="6"><hr/></td>
          			</tr>
          			<tr>
          				<td colspan="6"><input type="submit" class="btn btn-primary" value="Next" />
          								<button type="button" class="btn">Cancel</button>
          				</td>
          			</tr>
          		</table>
          		</form>
          	</div>
          </div>
        </div>
      </div>
    </div>
<?php
    include(ABS_PATH."templates/_footer.php");
?>

