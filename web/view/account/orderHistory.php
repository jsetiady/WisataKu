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
          	<h5 style="margin:auto;"><b>Order History</b></h5>
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
	          				<th style="width:250px;">Invoice No</th>
	          				<th>Order Type</th>
	          				<th>Date</th>
	          				<th>Status</th>
	          				<th style="width:40px">View</th>
	          			</tr>
	          		</head>
          		</thead>
          	</table>
          </div>
        </div>
      </div>
    </div>
<?php
    include(ABS_PATH."templates/_footer.php");
?>

