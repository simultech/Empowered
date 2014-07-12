<?php
	$activeareas = array(
		'all'=>'',
		'events'=>'',
		'parks'=>'',
		'hospitals'=>'',
		'allowance'=>'',
		'statistics'=>'',
		'needs'=>'',
		'types'=>''
	);
	$activeareas[$active] = 'class="active"';
?>
<ul class="nav nav-pills">
	<li <?php echo $activeareas['events']; ?>><a href="/information">Events</a></li>
	<li <?php echo $activeareas['parks']; ?>><a href="/information/parks">Parks</a></li>
	<li <?php echo $activeareas['hospitals']; ?>><a href="/information/hospitals">Hospitals and Clinics</a></li>
	<li <?php echo $activeareas['allowance']; ?>><a href="/information/allowance">Carer Allowance</a></li>
	<li <?php echo $activeareas['statistics']; ?>><a href="/information/statistics">Carer Statistics</a></li>
	<li <?php echo $activeareas['needs']; ?>><a href="/information/needs">Carer Needs</a></li>
	<li <?php echo $activeareas['types']; ?>><a href="/information/types">Disability Types</a></li>
</ul>
<div id='search' style='margin-top:20px;'>
<div class='row'>
	<div class='col-sm-9'>
		<div class="input-group">
		    <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch">
		    <div class="input-group-btn">
		        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
		    </div>
		</div>
	</div>
	<div class='col-sm-3'>
		<div class="input password required form-group">
			<select class="form-control" name="data[User][state]"  id="UserState" required="required">
				<option value="all">Anywhere</option>
				<option value="qld">Queensland</option>
				<option value="nsw">New South Wales</option>
				<option value="vic">Victoria</option>
				<option value="sa">South Australia</option>
				<option value="wa">Western Australia</option>
				<option value="nt">Northern Territory</option>
				<option value="tas">Tasmania</option>
				<option value="act">Australian Capital Territory</option>
			</select>
		</div>
	</div>
	
	<script>
	$('#srch').keyup(function() {
		dosearch();
	});
	$('#UserState').change(function() {
		dosearch();
	});
	function dosearch() {
		var state = $('#UserState').val().toLowerCase();
		var searchterm = $('#srch').val().toLowerCase();
		$('.info-item').each(function() {
			valid = false;
			if($(this).text().toLowerCase().indexOf(searchterm) > -1) {
				valid = true;
			}
			if(state != 'all') {
				if($(this).hasClass('state-'+state) && valid) {
					valid = true;
				} else {
					valid = false;
				}
			}
			if(valid) {
				$(this).css({'display':'block'});
			} else {
				$(this).css({'display':'none'});
			}
		})
	}
	</script>
	
</div>