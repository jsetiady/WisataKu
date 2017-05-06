
<h4>Find Tour Packages</h4>
<form class="">
	<div class="row">
		<div class="col-md-4">
			<div class="form-group"><label>Tour Type</label></div>
		</div>
		<div class="col-md-8">
			<label class="radio-inline"><input type="radio" checked="checked" name="tour_type">&nbsp;All</label>
			<label class="radio-inline"><input type="radio" name="tour_type">&nbsp;Personal</label>
			<label class="radio-inline"><input type="radio" name="tour_type">&nbsp;Group</label>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="form-group"><label>Location</label></div>
		</div>
		<div class="col-md-8">
			<div class="form-inline">
			<select class="form-control" id="location">
				<option>All</option>
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
	<div class="row">
		<div class="col-md-4">
			<div class="form-group"><label>Month</label></div>
		</div>
		<div class="col-md-8">
			<div class="form-inline">
				<select class="form-control" id="month">
					<option value="0">All</option>
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
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="form-group"><label>Year</label></div>
		</div>
		<div class="col-md-8">
			<div class="form-inline">
				<select class="form-control" id="year">
					<option value="2017">2017</option>
					<option value="2018">2018</option>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6"></div>
		<div class="col-md-6">
			<button type="submit" class="btn btn-primary">Find</button>
		</div>		
	</div>
</form>