<?php
    include(ABS_PATH."templates/_header.php");
?>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Monthly Tour Package Sales Report</h4>
            </div>
        </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Month</th>
                <th>Year</th>
                <th>Number of Transaction</th>
                <th>Number of Confirmed Transaction</th>
                <th>Total Nominal Transaction</th>
                <th>Total Nominal of Paid Transaction</th>
              </tr>
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