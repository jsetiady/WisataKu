<?php
 include(ABS_PATH."templates/_header.php");
?>
    <div class="py-5">
      <div class="container">
        <div class="row" style="margin:auto">
          <div class="col-md-12" style="margin:auto;text-align:center;">
          	<h5 style="margin:auto;"><b>Transaction Created</b></h5>
          	<hr/>
          </div>
           <br/><br/>
          <div class="col-md-8 form-control-sm" style="margin:auto;border:1px solid black; text-align:center;">
          	<p style="margin-bottom: 4px;">Your Invoice Number is <b><?= $transaction->getTransInvoiceNo() ?></b><br/>
          	Please transfer IDR <?= number_format($transaction->getTransTotalPrice(),0,".",",") ?>,- to the following account.
          	</p>
          	<hr/>
          	<div style="border:1px solid black;margin:auto;width:300px;text-align:center;">
          		<b>Bank Mandiri</b>
          		<p><b>123-1-000-123-12345</b>
          		<br/>
          		A/N : PT. Wisataku Indonesia
          		<br/>
          		KCP Martadinata Bandung <br/>
          		(Please note your invoice number)
          	</div>
          	<hr/>
          	<p><a href="?cont=account&action=confirmPayment&inv=<?= $transaction->getTransInvoiceNo() ?>">Click here to confirm your payment</a></p>
          </div>
        </div>
      </div>
    </div>
<?php
    include(ABS_PATH."templates/_footer.php");
?>

