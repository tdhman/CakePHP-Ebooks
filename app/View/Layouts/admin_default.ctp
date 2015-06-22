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

		echo $this->Html->css('jquery.rating');
		echo $this->Html->css('reset');
		echo $this->Html->css('adminstyle');
		echo $this->Html->css('invalid');
		
		echo $this->Html->script('ckeditor/ckeditor');
		echo $this->Html->script('jquery-1.7.min');
		echo $this->Html->script('facebox');
		echo $this->Html->script('jquery.rating');
		echo $this->Html->script('jquery.cookie');
		echo $this->Html->script('simpla.jquery.configuration');
		echo $this->Html->script('jquery.quicksearch');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<script type="text/javascript">
		jQuery(document).ready(function() {
            $('input#id_search').quicksearch('table tbody tr');
            });
	</script>
</head>
<body>
<div id="wrap">
	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
		
		<div id="sidebar"><div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
			
			<h1 id="sidebar-title"><a href="#">Bookstore Admin</a></h1>
		  
			<!-- Logo (221px wide) -->
			<?php echo $this->Html->image('logo.png', array('alt' => 'Admin')); ?>
		  
			<!-- Sidebar Profile links -->
			<div id="profile-links">
				Hello, <a href="#" title="Edit your profile"><?php echo $user['name']; ?></a>, view <a href="#messages" rel="modal" title="View Messages">your Messages</a><br />
				<br />
				<?php echo $this->Html->link('View the site', array('controller' => 'posts', 'action' => 'display'))?> | <?php echo $this->Html->link('Sign Out', array('admin' => true, 'controller' => 'users', 'action' => 'logout'))?>
			</div>        
			
			<ul id="main-nav">  <!-- Accordion Menu -->
				
				<li>
					<a href="javascript: void(0)" class="nav-top-item no-submenu" id="0">
						Dashboard
					</a>       
				</li>
				
				<li> 
					<a href="#" id="P" class="nav-top-item">
					Posts
					</a>
					<ul>
						<li><?php echo $this->Html->link('Write a new Post', array('controller' => 'posts', 'action' => 'add'), array('id' => "P|P1")); ?></li>
						<li><?php echo $this->Html->link('Manage Posts', array('controller' => 'posts', 'action' => 'index'), array('id' => "P|P2")); ?></li>
					</ul>
				</li>
				
				<li>
					<a href="#" id="E" class="nav-top-item">
						Ebooks
					</a>
					<ul>
						<li><?php echo $this->Html->link('Add a new Ebook', array('controller' => 'ebooks', 'action' => 'add'), array('id' => "E|E1")); ?></li>
						<li><?php echo $this->Html->link('Manage Ebooks', array('controller' => 'ebooks', 'action' => 'index'), array('id' => "E|E2")); ?></li>
						<li><?php echo $this->Html->link('Manage Comments', array('controller' => 'comments', 'action' => 'index'), array('id' => "E|E3")); ?></li>
					</ul>
				</li>
				
				<li>
					<a href="#" id="U" class="nav-top-item">
						Users
					</a>
					<ul>
						<li><?php echo $this->Html->link('Add a new User', array('controller' => 'users', 'action' => 'add'), array('id' => "U|U1")); ?></li>
						<li><?php echo $this->Html->link('Manage Users', array('controller' => 'users', 'action' => 'index'), array('id' => "U|U3")); ?></li>
						<li><?php echo $this->Html->link('Search Users', array('controller' => 'users', 'action' => 'search'), array('id' => "U|U4")); ?></li>
					</ul>
				</li>
				
				<li>
					<a href="#" id="S" class="nav-top-item">
						Settings
					</a>
					<ul>
						<li><a href="#" id="0">General</a></li>
						<li><li><?php echo $this->Html->link('Your Profile', array('controller' => 'users', 'action' => 'index'), array('id' => "S|S3")); ?></li></li>
						<li><a href="#" id="0">Users and Permissions</a></li>
					</ul>
				</li>      
				
			</ul> <!-- End #main-nav -->

			<div id="messages" style="display: none"> <!-- Messages -->
				<?php echo $this->element('new_messages', array('cache'=>'+1 hour'));?>
			</div> <!-- End #messages -->

		</div></div> <!-- End #sidebar -->
		
		<div id="main-content"> <!-- Main Content Section with everything -->
			
			<noscript> <!-- Show a notification if the user has disabled javascript -->
				<div class="notification error png_bg">
					<div>
						Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
					</div>
				</div>
			</noscript>
			
			<!-- Page Head -->
			<h2>Welcome <?php echo $user['name']; ?></h2>
			<p id="page-intro">What would you like to do?</p>
			
			<ul class="shortcut-buttons-set">
				
				<li><a class="shortcut-button" href="/posts/add"><span>
					<?php echo $this->Html->image('icons/pencil_48.png', array('alt' => 'icon')); ?><br />
					Write a new Post
				</span></a></li>
				
				<li><a class="shortcut-button" href="/ebooks/add"><span>
					<?php echo $this->Html->image('icons/paper_content_pencil_48.png', array('alt' => 'icon')); ?><br />
					Add a new Ebook
				</span></a></li>
				
				<li><a class="shortcut-button" href="/users/add"><span>
					<?php echo $this->Html->image('icons/user_add_48.png', array('alt' => 'icon')); ?><br />
					Add a new User
				</span></a></li>
				
				<li><a class="shortcut-button" href="#"><span>
					<?php echo $this->Html->image('icons/clock_48.png', array('alt' => 'icon')); ?><br />
					Add an Event
				</span></a></li>
				
				<li><a class="shortcut-button" href="#messages" rel="modal"><span>
					<?php echo $this->Html->image('icons/comment_48.png', array('alt' => 'icon')); ?><br />
					Send a Message
				</span></a></li>
				
			</ul><!-- End .shortcut-buttons-set -->
			
			<div class="clear"></div> <!-- End .clear -->
			
			<div class="content-box"><!-- Start Content Box -->
				
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
				
			</div> <!-- End .content-box -->
			
			<div id="footer">
				<small>
						&#169; Copyright 2012 Bookstore Mistips | Powered by <a href="http://themeforest.net/item/simpla-admin-flexible-user-friendly-admin-skin/46073">Bookstore Admin</a> | <a href="#">Top</a>
				</small>
			</div><!-- End #footer -->
			
		</div> <!-- End #main-content -->
	</div>

</div>
</body>
</html>
