<h2>Information Database - Parks and Landmarks</h2>
<?php echo $this->element('infonav',array('active'=>'parks')); ?>
<div class=" col-sm-6">
<?php
$markers = array();
foreach($data as $item) {
	$itemstate = '';
	if(isset($item['state'])) {
		$itemstate = 'state-'.$item['state'];
	}
	if(isset($item[12])) {
		$marker = array();
		$marker['lat'] = $item[13];
		$marker['lng'] = $item[12];
		$marker['name'] = 'jojo';
		$markers[] = $marker;
	}
?>
<div class='info-item state-qld'>
	<h3><?php echo $item[1]; ?></h3>
	<p><?php echo $item[8] ?></p>
	<p><?php echo $item[12] . "," . $item[13] ?></p>
</div>
<?php
}

?>
</div>
<?php echo $this->element('map',array('map_id'=>'parks','map_height'=>'500','map_class'=>'col-sm-6', 'map_lat'=>'-28.397', 'map_lng'=>'134.644','map_zoom'=>4,'markers'=>$markers)); ?>