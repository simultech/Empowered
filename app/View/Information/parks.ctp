<h2>Information Database - Parks and Landmarks</h2>
<?php echo $this->element('infonav',array('active'=>'parks')); ?>
<?php
foreach($data as $item) {
?>
<div class='info-item state-qld'>
	<h3><?php echo $item['title']; ?></h3>
</div>
<?php
}
?>
