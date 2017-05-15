<?php
 include(ABS_PATH."templates/_header.php");
?>
	<script type="text/javascript">
		$("document").ready(function(){
			$("#report-tour-sales-table").dataTable();

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
          	<h5 style="margin:auto;"><b>Monthly Tour Package Sales Report</b></h5>
          	<hr/>
          </div>
           <br/><br/>
          <div id="tour-history-tab" class="col-md-12 form-control-sm" style="margin:auto;border:1px solid black;">
          	<p><b>Monthly Tour Package Sales Report</b></p>
          	<hr style="margin-top:5px;"/>
          	
          	<table class="form-control-sm" id="report-tour-sales-table">
          		<thead>
	          		<head>
	          			<tr>
                            <th>#</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Number of Transaction</th>
                            <th>Number of Confirmed Transaction</th>
                            <th>Total Nominal of Transaction</th>
                            <th>Total Nominal of Paid Transaction</th>
	          				
	          			</tr>
	          		</head>
                </thead>
	          		<tbody>
                        <?php
                        $i = 1;
                        foreach($transactions as $transaction):
                        ?>
                            <tr>
                                <td><?=$i?></td>
                                <td><?=$transaction["month"]?></td>
                                <td><?=$transaction["year"]?></td>
                                <td><?=$transaction["numTransaction"]?></td>
                                <td><?=$transaction["numConfirmTransaction"]?></td>
                                  <?php setlocale(LC_MONETARY, 'it_IT'); ?>
                                <td><?=str_replace("Eu", "Rp", money_format('%.2n', $transaction["totalPrice"]))?></td>
                                <td><?=str_replace("Eu", "Rp", money_format('%.2n', $transaction["totalConfirmedPrice"]))?></td>
                            </tr>
                            <?php
                            $i++;
                            endforeach;
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
