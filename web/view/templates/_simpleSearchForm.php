<hr/>
<h6>Find Tour Packages</h6>
<hr/>
<form class="search-form" style="line-height: 2px;" method="post" action="?cont=tour&action=browse">
	<input type="hidden" name="keyword" value=""/>
	<input type="hidden" name="durationGroup" value="0"/>
	<input type="hidden" name="participantGroup" value="0"/>
	<input type="hidden" name="priceGroup" value="0"/>
	<input type="hidden" name="pointGroup" value="0"/>
	<div class="row row-bottom-margin">
		<div class="col-sm-3">
			<div class="form-group form-control-sm"><label>Tour Type</label></div>
		</div>
		<div class="col-sm-8">
			<label class="radio-inline form-control-sm"><input type="radio" value="all" checked="checked" name="tour_type">All</label>
			<label class="radio-inline form-control-sm"><input type="radio" value="p" name="tour_type">&nbsp;Personal</label>
			<label class="radio-inline form-control-sm"><input type="radio" value="g" name="tour_type">&nbsp;Group</label>
		</div>
	</div>
	<div class="row row-bottom-margin">
		<div class="col-sm-3">
			<div class="form-group form-control-sm"><label>Location</label></div>
		</div>
		<div class="col-sm-8">
			<div class="form-inline form-control-sm">
			<select class="form-control form-control-sm" name="location" style="width:235px;">
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
		<div class="col-sm-3">
			<div class="form-group form-control-sm"><label>Month</label></div>
		</div>
		<div class="col-sm-8">
			<div class="form-inline form-control-sm">
				<select class="form-control form-control-sm" name="month">
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
	<div class="row">
		<div class="col-md-6">
			<button type="submit" class="btn btn-primary form-control-sm">Find</button>
		</div>		
	</div>
</form>