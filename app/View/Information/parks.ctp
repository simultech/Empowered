<h2>Information Database - Parks and Landmarks</h2>
<?php echo $this->element('infonav',array('active'=>'parks')); ?>
<?php
foreach($data as $item) {
?>
<div class='info-item state-qld'>
	<!--<h3><?php echo $item['title']; ?></h3>-->
	<h3><?php echo $item[1]; ?></h3>
	<p><?php echo $item[8] ?></p>
	<p><?php echo $item[12] . "," . $item[13] ?></p>
</div>
<?php
}
?>
