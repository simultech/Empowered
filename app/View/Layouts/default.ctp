<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		Empowered:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

/* 		echo $this->Html->css('cake.generic'); */

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('bootstrap-theme.min');
		
		echo $this->Html->script('jquery-1.11.1.min');
		echo $this->Html->script('bootstrap.min');
		
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1>Empowered</h1>
		</div>
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			Copyright &copy; 2014 empowered.net.au
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>