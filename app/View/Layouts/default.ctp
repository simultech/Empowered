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
		echo $this->Html->css('style');
		echo $this->Html->css('animate');
		//echo $this->Html->css('bootstrap-theme.min');

		echo $this->Html->script('jquery-1.11.1.min');
		echo $this->Html->script('bootstrap.min');


	?>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body class="layout_<?php echo $active; ?>">
<header class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="/" class="navbar-brand">Empowered</a>
		</div>
		<div class="navbar-collapse collapse" id="navbar-main">
			<ul class="nav navbar-nav">
				<?php
					$homeactive = '';
					$awarenessactive = '';
					$informationactive = '';
					$communityactive = '';
					$profileactive = '';
					$loginactive = '';
					$registeractive = '';
					switch($active) {
						case 'profile': $profileactive = 'active'; break;
						case 'community': $communityactive = 'active'; break;
						case 'information': $informationactive = 'active'; break;
						case 'awareness': $awarenessactive = 'active'; break;
						case 'login': $loginactive = 'active'; break;
						case 'register': $registeractive = 'active'; break;
						default: $homeactive = 'active'; break;
					}
				?>
				<li class='<?php echo $homeactive; ?>'>
					<a href="/">Home</a>
				</li>
				<li class='<?php echo $awarenessactive; ?>'>
					<a href="/awareness">Not alone</a>
				</li>
				<li class='<?php echo $informationactive; ?>'>
					<a href="/information">Information Database</a>
				</li>
				<li class='<?php echo $communityactive; ?>'>
					<a href="/community">Community</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php
				if(!$loggedIn) {
				?>
				<li class='<?php echo $registeractive; ?>'>
					<a href="/register">Register</a>
				</li>
				<li class='<?php echo $loginactive; ?>'>
					<a href="/users/login">Login</a>
				</li>
				<?php
				} else {
				?>
				<li class='<?php echo $profileactive; ?>'>
					<a href="/profile"><?php echo $user['username'];?> (Profile)</a>
				</li>
				<li>
					<a href="/users/logout">Logout</a>
				</li>
				<?php
				}
				?>
			</ul>
		</nav>
	</div>
</header>
	<div id='main'>
	<div class="container">
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
	</div>
	<div id="footer">
		Copyright &copy; 2014 empowered.net.au
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
