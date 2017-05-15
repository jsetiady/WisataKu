<hr/>
<h6>Advance Search</h6>
<hr/>
<form class="search-form" style="line-height: 2px;" method="post" action="?cont=tour&action=browse">
    <div class="row row-bottom-margin">
        <div class="col-sm-4">
			<div class="form-group form-control-sm"><label>Keyword</label></div>
		</div>
		<div class="col-sm-8">
            <input type="text" name="keyword" class="form-control form-control-sm" placeholder="Enter keyword">
		</div>
    </div>
    
    
	<div class="row row-bottom-margin">
		<div class="col-sm-4">
			<div class="form-group form-control-sm"><label>Tour Type</label></div>
		</div>
		<div class="col-sm-8">
			<label class="radio-inline form-control-sm"><input type="radio" checked="checked" name="tour_type" value="0">&nbsp;All</label>
			<label class="radio-inline form-control-sm"><input type="radio" name="tour_type" value="p">&nbsp;Personal</label>
			<label class="radio-inline form-control-sm"><input type="radio" name="tour_type" value="g">&nbsp;Group</label>
		</div>
	</div>
	<div class="row row-bottom-margin">
		<div class="col-sm-4">
			<div class="form-group form-control-sm"><label>Location</label></div>
		</div>
		<div class="col-sm-8">
			<div class="form-inline form-control-sm">
			<select class="form-control form-control-sm" id="location" style="width:235px;" name="location">
				<option value="">All</option>
				<?php 
				foreach($listLoc as $loc) 
				{
				?>
				<option value=<?= $loc->getLocId() ?>><?= $loc->getLocName() ?></option>
				<?php
				}
				?>
			</select>
			</div>
		</div>
	</div>
	<div class="row row-bottom-margin">
		<div class="col-sm-4">
			<div class="form-group form-control-sm"><label>Month</label></div>
		</div>
		<div class="col-sm-8">
			<div class="form-inline form-control-sm"><select class="form-control form-control-sm" name="month">
					<option value="">All</option>
					<option value="1">January</option>
					<option value="2">February</option>
					<option value="3">March</option>
					<option value="4">April</option>
					<option value="5">Mei</option>
					<option value="6">June</option>
					<option value="7">July</option>
					<option value="8">August</option>
					<option value="9">September</option>
					<option value="10">October</option>
					<option value="11">November</option>
					<option value="12">December</option>
				</select>
				&nbsp;&nbsp;
				<select class="form-control form-control-sm" name="year">
					<option value="2017">2017</option>
					<option value="2018">2018</option>
				</select>
			</div>
			<div class="form-inline form-control-sm">
				
			</div>
		</div>
	</div>
    <div class="row row-bottom-margin">
        <div class="col-sm-4">
			<div class="form-group form-control-sm"><label>Duration</label></div>
		</div>
		<div class="col-sm-8">
            <div class="form-inline form-control-sm"><select class="form-control form-control-sm" name="durationGroup">
                    <option value="0">All</option>
                    <option value="1">1-2 days</option>
                    <option value="2">3-5 days</option>
                    <option value="3">7-10 days</option>
                    <option value="4">>10 days</option>
                </select>
            </div>
		</div>
    </div>
    <div class="row row-bottom-margin">
        <div class="col-sm-4">
			<div class="form-group form-control-sm"><label>Participants</label></div>
		</div>
		<div class="col-sm-8">
            <div class="form-inline form-control-sm"><select class="form-control form-control-sm" name="participantGroup">
                    <option value="0">All</option>
                    <option value="1">1-2 persons</option>
                    <option value="2">1-5 persons</option>
                    <option value="3">5-10 persons</option>
                    <option value="4">10-20 persons</option>
                    <option value="5">>20 persons</option>
                </select>
            </div>
		</div>
    </div>
    <div class="row row-bottom-margin">
		<div class="col-sm-4">
			<div class="form-group form-control-sm"><label>Price/pax</label></div>
		</div>
        <div class="col-sm-8">
            <div class="form-inline form-control-sm"><select class="form-control form-control-sm" name="priceGroup">
                    <option value="0">All</option>
                    <option value="1">Rp 50.000 - Rp 100.000</option>
                    <option value="2">Rp 100.000 - Rp 300.000</option>
                    <option value="3">Rp 300.000 - Rp 500.000</option>
                    <option value="4">Rp 500.000 - Rp 1.000.000</option>
                    <option value="5">>Rp 1.000.000</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row row-bottom-margin">
		<div class="col-sm-4">
			<div class="form-group form-control-sm"><label>Points</label></div>
		</div>
        <div class="col-sm-8">
            <div class="form-inline form-control-sm"><select class="form-control form-control-sm" name="pointGroup">
                    <option value="0">All</option>
                    <option value="1">0-100</option>
                    <option value="2">100-500</option>
                    <option value="3">500-1000</option>
                    <option value="4">1000-5000</option>
                    <option value="5">>>5000</option>
                </select>
            </div>
        </div>
    </div>
	<div class="row">
		<div class="col-md-6">
			<button type="submit" class="btn btn-primary form-control-sm">Find</button>
		</div>		
	</div>
</form>