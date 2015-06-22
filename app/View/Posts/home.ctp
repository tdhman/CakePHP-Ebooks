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
 * @package       Cake.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>

<h2><?php echo __d('cake_dev', 'Blog by CakePHP %s.', Configure::version()); ?></h2>
<div id="wrapper">
<div class="post" style="margin-left:50px;">
	<?php
		foreach($posts as $post):
			echo '<p><h1>', $post['Post']['title'], '</p></h1>';
			echo '<p><small>Created:', $post['Post']['created'], '</small></p>';
			echo String::truncate($post['Post']['body'], 25, array('ending' => '...', 'exact' => false));
			echo '<br/><br/>';
			echo $this->Html->link('Read more', array('controller'=>'posts', 'action'=>'view', $post['Post']['id']));
			echo '<br/>';
		endforeach; 
	?>
</div>
<div class ="pagination">
	<?php echo $this->Paginator->numbers(); ?>
</div>
</div>

<br/><br/>
<h3><?php echo __d('cake_dev', 'Lastest Posts'); ?></h3>
<p>
<?php
echo $this->element('latest_posts', array('cache'=>'+1 hour'));
?>
</p>

<h3><?php echo __d('cake_dev', 'Getting Started'); ?></h3>
<p>
	<?php
		echo $this->Html->link(
			sprintf('<strong>%s</strong> %s', __d('cake_dev', 'New'), __d('cake_dev', 'CakePHP 2.0 Docs')),
			'http://book.cakephp.org/2.0/en/',
			array('target' => '_blank', 'escape' => false)
		);
	?>
</p>
<p>
	<?php
		echo $this->Html->link(
			__d('cake_dev', 'The 15 min Blog Tutorial'),
			'http://book.cakephp.org/2.0/en/tutorials-and-examples/blog/blog.html',
			array('target' => '_blank', 'escape' => false)
		);
	?>
</p>
