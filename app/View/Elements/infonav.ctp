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
	<li <?php echo $activeareas['all']; ?>><a href="/information/">All Data</a></li>
	<li <?php echo $activeareas['events']; ?>><a href="/information/events">Events</a></li>
	<li <?php echo $activeareas['parks']; ?>><a href="/information/parks">Parks</a></li>
	<li <?php echo $activeareas['hospitals']; ?>><a href="/information/hospitals">Hospitals and Clinics</a></li>
	<li <?php echo $activeareas['allowance']; ?>><a href="/information/allowance">Carer Allowance</a></li>
	<li <?php echo $activeareas['statistics']; ?>><a href="/information/statistics">Carer Statistics</a></li>
	<li <?php echo $activeareas['needs']; ?>><a href="/information/needs">Carer Needs</a></li>
	<li <?php echo $activeareas['types']; ?>><a href="/information/types">Disability Types</a></li>
</ul>