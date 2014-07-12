<h2>Information Database - Hospitals and Clinics</h2>
<?php echo $this->element('infonav',array('active'=>'hospitals')); ?>
<div class=" col-sm-6">
<?php
$markers = array();
foreach($data as $item) {
	$itemstate = '';
	if(isset($item['state'])) {
		$itemstate = 'state-'.$item['state'];
	}
	if(isset($item['lat'])) {
		$marker = array();
		$marker['lat'] = $item['lat'];
		$marker['lng'] = $item['lng'];
		$marker['name'] = $item['name'];
		$markers[] = $marker;
	}
?>
<div class='info-item <?php echo $itemstate; ?>'>
	<h3><?php echo $item['title']; ?></h3>
	<p><?php echo html_entity_decode($item['name']); ?></p>
</div>
<?php
}
?>
</div>
<?php echo $this->element('map',array('map_id'=>'hospitals','map_height'=>'500','map_class'=>'col-sm-6', 'map_lat'=>'-28.397', 'map_lng'=>'134.644','map_zoom'=>4,'markers'=>$markers)); ?>