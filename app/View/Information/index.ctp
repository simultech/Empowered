<h2>Information Database - Upcoming Events</h2>
<?php echo $this->element('infonav',array('active'=>'events')); ?>
<?php
foreach($data as $item) {
	$itemstate = '';
	if(isset($item['state'])) {
		$itemstate = 'state-'.$item['state'];
	}
	ini_set('memory_limit','128M');
	ini_set('max_execution_time', 300);
	$date = $item['date'];
	$dates = explode(",", $date);
	$rating ="5";

	//echo $dates[1];
?>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<div class="col-sm-3">
<div class='event-item <?php echo $itemstate; ?>'>
	<h3><?php echo $item['title']; ?></h3>
	<h4 class='info-date'><?php echo $dates[1] ?></h4>
	<div class='pic'><img src="<?php echo $item['img']; ?>" /></div>
	<!-- <p><?php echo html_entity_decode($item['description']); ?></p> -->
	<div class="row">
	<div class="col-xs-8 col-sm-6">
		<div class="edit">
	<i class="fa fa-star"> <?php echo $rating ?></i>
</div>
	</div>
	<div class="col-xs-8 col-sm-6">
		<div class="edit">
	<i class="fa fa-comment"> <?php echo $rating ?></i>
</div>
</div>
</div>
</div>
</div>
<?php
}
?>
