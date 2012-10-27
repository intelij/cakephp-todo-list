<!DOCTYPE html>
<html lang="en">
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $title_for_layout; ?> | Todo.ly</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(array('bootstrap', 'jquery.notifybar', 'ui-lightness/jquery-ui-1.9.0.custom.min', 'todoly'));
		echo $this->Html->script(array('jquery.min', 'mustache.min', 'jquery.notifybar', 'jquery-ui-1.9.0.custom.min', 'todoly'));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<header class="navbar navbar-static-top">
		<div class="navbar-inner">
			<div class="container">
				<a href="/" class="brand">Todo.ly</a>
			<?php if(AuthComponent::user('id')): ?>
				<ul class="nav">
					<li class="active"><a href="/items">Items</a></li>
				</ul>

				<ul class="nav pull-right">
					<li><a href="/pages/about">About</a></li>
					<li class="divider-vertical"></li>
					<li><a href="/users/logout">Get off my lawn!</a></li>
				</ul>
			</div>
			<?php else: ?>
				<ul class="nav pull-right">
					<li><a href="/pages/about">About</a></li>
					<li class="divider-vertical"></li>
					<li><a href="/users/login">Login</a></li>
				</ul>
			<?php endif; ?>
		</div>
	</header>
	<div class="container main-container">
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
