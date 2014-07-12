<h2>Information Database - Social Services</h2>
<?php echo $this->element('infonav',array('active'=>'types')); ?>
<div class=" col-sm-6">
<?php
$markers = array();
foreach($data as $item) {
	$itemstate = '';
	if(isset($item['state'])) {
		$itemstate = 'state-'.$item['state'];
	}
	if(isset($item[24]) && $item[24] != '') {
		$marker = array();
		$marker['lat'] = $item[25];
		$marker['lng'] = $item[24];
		$marker['name'] = str_replace("'",'',$item[1].' - '.$item[8]);
		$markers[] = $marker;
	}
?>
<div class='info-item state-qld'>
	<?php echo $this->element('social'); ?>
	<h3><?php echo $item[1]; ?></h3>
	<p><strong><?php echo $item[8]; ?></strong></p>
	<p><strong>Received from:</strong> <?php echo $item[9]; ?></p>
	<p><strong>Categories:</strong> <?php echo $item[16]; ?>, <?php echo $item[17]; ?></p>
	<p><strong>Address:</strong> <?php echo $item[22]; ?></p>
	<p><?php echo $item[18]; ?></p>
</div>
<?php
}

?>
</div>
<?php echo $this->element('map',array('map_id'=>'parks','map_height'=>'500','map_class'=>'col-sm-6', 'map_lat'=>'-28.397', 'map_lng'=>'134.644','map_zoom'=>4,'markers'=>$markers)); ?>