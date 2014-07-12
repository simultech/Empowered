<h2>Information Database - Upcoming Events</h2>
<?php echo $this->element('infonav',array('active'=>'events')); ?>
<?php
foreach($data as $item) {
	$itemstate = '';
	if(isset($item['state'])) {
		$itemstate = 'state-'.$item['state'];
	}
?>
<div class='info-item <?php echo $itemstate; ?>'>
	<p class='info-date'><?php echo $item['date']; ?></p>
	<h3><?php echo $item['title']; ?></h3>
	<p><?php echo html_entity_decode($item['description']); ?></p>
</div>
<?php
}
?>