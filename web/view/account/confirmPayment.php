<?php
 include(ABS_PATH."templates/_header.php");
?>
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
          	<table class="form-control-sm">
          		<tr>
          			<td style="width:150px;">Invoice No</td>
          			<td style="width:30px;">:</td>
          			<td class="form-control-sm" style="width:30px;"><input type="text" name="invoiceNo" class="form-control-sm" value="" /></td>
          		</tr>
          		<tr>
          			<td style="width:150px;">Name</td>
          			<td style="width:30px;">:</td>
          			<td class="form-control-sm" style="width:30px;"><input type="text" name="invoiceNo" class="form-control-sm" value="" /></td>
          		</tr>
          		<tr>
          			<td style="width:150px;">Date Payment</td>
          			<td style="width:30px;">:</td>
          			<td class="form-control-sm" style="width:30px;"><input type="text" name="invoiceNo" class="form-control-sm" value="" /></td>
          		</tr>
          		<tr>
          			<td colspan="3"><input type="submit" class="btn-sm btn-primary" value="Confirm" /></td>
          		</tr>
          	</table>
          </div>
        </div>
      </div>
    </div>
<?php
    include(ABS_PATH."templates/_footer.php");
?>

