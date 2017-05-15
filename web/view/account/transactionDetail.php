<?php
 include(ABS_PATH."templates/_header.php");
?>
	<script type="text/javascript">
		$("document").ready(function(){
			$("#transaction-detail-table").dataTable();
			$("#order-souvenir-history-table").dataTable();

		});
	</script>

    <style type="text/css">
        #vertical-2 thead,#vertical-2 tbody{
            display:inline-block;
        }

    </style>
    <div class="py-5">
      <div class="container">
        <div class="row" style="margin:auto">
          <div class="col-md-12" style="margin:auto;text-align:center;">
          	<h5 style="margin:auto;"><b>Transaction Detail</b></h5>
          	<hr/>
          </div>
           <br/><br/>
          <div id="tour-history-tab" class="col-md-12 form-control-sm" style="margin:auto;border:1px solid black;">
          	<p><b>Tour Transaction Detail</b></p>
          	<hr style="margin-top:5px;"/>
              <a href=""> < Back to order history </a>
              <pre>
              <?php
              //print_r($transactions);
              ?>
              </pre>
              <div class="row" style="margin:auto">
                  <div class="col-md-4">
                    <h5>Transaction Detail</h5>
                      <hr/>
                  </div>
              </div>
              <div class="row" style="margin:auto">
                  <div class="col-md-3" style="text-align:right">
                      Invoice :<br/>
                      Tour package name :<br/>
                      Transaction date :<br/>
                      Preferred start date :<br/>
                      Preferred end date :<br/>
                      Price/pax :<br/>
                      Total person :<br/>
                      Transaction amount :<br/>
                      Transaction expiry date :<br/>
                  </div>
                  <div class="col-md-8">
                      <?=$transactions->getTransInvoiceNo()?><br/>
                      <?=$transactions->getTransTour()->getTourName()?><br/>
                      <?=$transactions->getTransDate()?><br/>
                      <?=$transactions->getTransPrefStartDate()?><br/>
                      <?=$transactions->getTransPrefEndDate()?><br/>
                      <?=$transactions->getTransPricePerson()?><br/>
                      <?=$transactions->getTransTotalPerson()?><br/>
                      <?=$transactions->getTransTotalPrice()?><br/>
                      <?=$transactions->getTransExpiredDate()?><br/>
                  </div>
                </div>
                  <div class="row" style="margin:auto;padding-top:50px">
                      <div class="col-md-4">
                        <h5>Transaction Status</h5>
                          <hr/>
                      </div>
                  </div>
              
              <div class="row" style="margin:auto">
                  <div class="col-md-3" style="text-align:right">
                      Payment status :<br/>
                  </div>
                  <div class="col-md-8">
                      <?=$transactions->getTransStatus()->getStatusDesc()?><br/>
                  </div>
                </div>
                  <div class="row" style="margin:auto;padding-top:50px">
                      <div class="col-md-4">
                        <h5>Contact Information</h5>
                          <hr/>
                      </div>
                  </div>
              <div class="row" style="margin:auto">
                  <div class="col-md-3" style="text-align:right">
                      Contact Name :<br/>
                      Contact Phone Number :<br/>
                      Additional note :<br/>
                  </div>
                  <div class="col-md-8">
                      <?=$transactions->getTransUserContactName()?><br/>
                      <?=$transactions->getTransUserContactNo()?><br/>
                      <?=$transactions->getTransNotes()?><br/>
                  </div>
                </div>
                <div class="row" style="margin:auto;padding-top:50px">
                </div>
            </div>
            
              
          </div>
          
        </div>
      </div>
    </div>
<?php
    include(ABS_PATH."templates/_footer.php");
?>

