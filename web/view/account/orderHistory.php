<?php
 include(ABS_PATH."templates/_header.php");
?>
	<script type="text/javascript">
		$("document").ready(function(){
			$("#order-history-table").dataTable();
		});

	</script>
    <div class="py-5">
      <div class="container">
        <div class="row" style="margin:auto">
          <div class="col-md-12" style="margin:auto;text-align:center;">
          	<h5 style="margin:auto;"><b>Transaction History</b></h5>
          	<hr/>
          </div>
           <br/><br/>
          <div class="col-md-12 form-control-sm" style="margin:auto;border:1px solid black;">
          	<hr style="margin-top:5px;"/>
          	<table class="form-control-sm" id="order-history-table">
          		<thead>
	          		<head>
	          			<tr>
	          				<th style="width:40px;">No</th>
	          				<th style="width:150px;">Invoice No</th>
	          				<th style="width:250px;">Tour Name</th>
	          				<th>Type</th>
	          				<th>Transaction Date</th>
	          				<th>Status</th>
	          				<th style="width:40px">Options</th>
	          			</tr>
	          		</head>
	          		<tbody>
	          			<?php 
	          			$no = 1;
	          			foreach($transactions as $trans) {
	          			?>
	          			<tr>
	          				<td style="text-align:right; padding-right:50px;"><?= $no ?></td>
	          				<td style="padding-left:20px"><?= $trans->getTransInvoiceNo() ?></td>
	          				<td style="padding-left:20px"><?= $trans->getTransTour()->getTourName() ?></td>
	          				<td style="padding-left:20px">Tour</td>
	          				<td style="padding-left:20px"><?= $trans->getTransDate() ?></td>
	          				<td style="padding-left:20px"><?= strtoupper($trans->getTransStatus()->getStatusDesc()) ?></td>
	          				<td style="padding-left:20px"><a href="?cont=tour&action=viewTransaction&id=<?= $trans->getTransId() ?>" class="btn btn-primary btn-sm" style="width:30px; height:15px; font-size:12px; padding-top:0px;">View</a></td>
	          			</tr>
	          			<?php	
	          			}?>
	          		</tbody>
          		</thead>
          	</table>
          </div>
        </div>
      </div>
    </div>
<?php
    include(ABS_PATH."templates/_footer.php");
?>

