<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		My Ebook Collection
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('reset');
		echo $this->Html->css('adminstyle');
		echo $this->Html->css('invalid');
		
		echo $this->Html->script('jquery-1.7.min');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	
</head>
<body id="login">
	<div id="login-wrapper" class="png_bg">
		<div id="login-top">
			
			<h1>Simpla Admin</h1>
				<!-- Logo (221px width) -->
				<?php echo $this->Html->image('logo.png', array('alt' => 'Simpla Admin logo')); ?>
				<?php echo $this->Html->link('View the site', array('admin' => false, 'controller' => 'posts', 'action' => 'display'), array('class' => 'site')); ?>
			</div> <!-- End #logn-top -->
			
		<div id="login-content">
			<?php echo $this->fetch('content'); ?>
		</div> <!-- End #login-content -->
			
	</div> <!-- End #login-wrapper -->
</body>
</html>