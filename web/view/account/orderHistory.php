<?php
 include(ABS_PATH."templates/_header.php");
?>
	<script type="text/javascript">
		$("document").ready(function(){
			$("#order-history-table").dataTable();
			$("#order-souvenir-history-table").dataTable();

			$("#tour-transaction-btn").click(function(){
				$("#tour-history-tab").show();
				$("#souvenir-history-tab").hide();
			});

			$("#souvenir-transaction-btn").click(function(){
				$("#tour-history-tab").hide();
				$("#souvenir-history-tab").show();
			});
		});
	</script>
    <div class="py-5">
      <div class="container">
        <div class="row" style="margin:auto">
          <div class="col-md-12" style="margin:auto;text-align:center;">
          	<h5 style="margin:auto;"><b>Transaction History</b></h5>
          	<hr/>
          	<div style="text-align:left">
          	<button type="button" id="tour-transaction-btn" class="btn btn-sm btn-primary">Show Tour Transaction</button>
          	<button type="button" id="souvenir-transaction-btn" class="btn btn-sm btn-primary">Show Souvenir Transaction</button>
          	<hr/>
          	</div>
          </div>
           <br/><br/>
          <div id="tour-history-tab" <?php 
          	$display = "";
          	if(isset($_GET['type']) && $_GET['type'] == "souvenir")
          		$display = "display:none;";
          ?> class="col-md-12 form-control-sm" style="<?= $display ?>margin:auto;border:1px solid black;">
          	<p><b>Tour Transaction History</b></p>
          	<hr style="margin-top:5px;"/>
          	
          	<table class="form-control-sm" id="order-history-table">
          		<thead>
	          		<head>
	          			<tr>
	          				<th style="width:40px;">No</th>
	          				<th style="width:150px;">Invoice No</th>
	          				<th style="width:250px;">Tour Name</th>
	          				<th>Transaction Date</th>
	          				<th>Total price</th>
	          				<th>Status</th>
	          				<th style="display:none"></th>
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
	          				<td style="padding-left:20px"><a href="?cont=tour&action=viewTransaction&id=<?=$trans->getTransId()?>"><?= $trans->getTransInvoiceNo() ?></a></td>
	          				<td style="padding-left:20px"><?= $trans->getTransTour()->getTourName() ?></td>
	          				<td style="padding-left:20px"><?= $trans->getTransDate() ?></td>
	          				<td style="text-align:left;">IDR <?= number_format($trans->getTransTotalPrice(),0,".",",") ?>,-</td>
	          				<td style="padding-left:20px"><?= strtoupper($trans->getTransStatus()->getStatusDesc()) ?></td>
	          				<td style="display:none;padding-left:20px"></td>
	          				<td style="padding-left:20px">
	          				<?php 
	          					if($trans->getTransStatus()->getStatusId() == "0"){
	          				?>
	          				<a href="?cont=account&action=confirmPayment&inv=<?= $trans->getTransInvoiceNo() ?>" class="btn btn-primary btn-sm" style="width:40px; height:15px; font-size:12px; padding-top:0px;">Confirm Payment</a>
	          				<?php
	          					} ?>
	          				<a href="?cont=tour&action=viewTransaction&id=<?= $trans->getTransId() ?>" class="btn btn-primary btn-sm" style="width:30px; height:15px; font-size:12px; padding-top:0px;">View</a>
	          				</td>
	          			</tr>
	          			<?php	
	          			}?>
	          		</tbody>
          		</thead>
          	</table>
          </div>
          <div id="souvenir-history-tab" <?php 
          	$display = "display:none;";
          	if(isset($_GET['type']) && $_GET['type'] == "souvenir")
          		$display = "";
          ?>  class="col-md-12 form-control-sm" style="<?= $display ?>margin:auto;border:1px solid black;">
          	<p><b>Souvenir Transaction History</b></p>
          	<hr style="margin-top:5px;"/>
          	
          	<table class="form-control-sm" id="order-souvenir-history-table">
          		<thead>
	          			<tr>
	          				<th style="width:40px;">No</th>
	          				<th style="width:150px;">Invoice No</th>
	          				<th style="text-align: center">Transaction Date</th>
	          				<th>Total Price</th>
	          				<th>Status</th>
	          				<th>Payment Date</th>
	          				<th style="width:40px">Options</th>
	          			</tr>
          		</thead>
          		<tbody>
          			<?php 
          				$no=1;
          				foreach($transactionSouvenir as $transSov)
          				{
	          			?>
	          			<tr>
	          				<td><?= $no ?></td>
	          				<td><?= $transSov->getTransSovInvoiceNo() ?></td>
	          				<td style="text-align:center;"><?= $transSov->getTransSovDate() ?></td>
	          				<td style="text-align:right;padding-right:40px;">IDR <?= number_format($transSov->getTransSovPrice(),0,".",",") ?>,-</td>
	          				<td style="padding-left:20px"><?= strtoupper($transSov->getTransSovStatus()->getStatusDesc()) ?></td>
	          				<td style="text-align:center;"><?= $transSov->getTransSovPaymentDate() ?></td>
	          				<td style="padding-left:20px">
	          				<?php 
	          					if($transSov->getTransSovStatus()->getStatusId() == "0"){
	          				?>
	          				<a href="?cont=account&action=confirmPayment&inv=<?= $transSov->getTransSovInvoiceNo() ?>" class="btn btn-primary btn-sm" style="width:100px; height:15px; font-size:12px; padding-top:0px;">Confirm Payment</a>
	          				<?php
	          					}
	          					else
	          					{
	          						?>
	          				<td style="text-align:center;">
	          				<?php
	          					}
	          				?>
	          				<a href="?cont=souvenir&action=viewTransactionSouvenir&id=<?= $transSov->getTransSovId() ?>" class="btn btn-primary btn-sm" style="width:30px; height:15px; font-size:12px; padding-top:0px;">View</a>
	          				</td>
	          			</tr>
	          			<?php
	          			$no++;
	          				}
	          			?>
          		</tbody>
          	</table>
          </div>
          
        </div>
      </div>
    </div>
<?php
    include(ABS_PATH."templates/_footer.php");
?>

