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

		echo $this->Html->css('style');
        echo $this->Html->css('jquery.rating');
		echo $this->Html->css('basic');
		
		echo $this->Html->script('jquery-1.7.min');
        echo $this->Html->script('jquery.rating');
		echo $this->Html->script('jquery.cookie');
		echo $this->Html->script('jquery.simplemodal');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<script type="text/javascript">
		$(document).ready(function(){
			//Turn all the select boxes into rating controls
				$(".rating").rating({showCancel: false});
			
			// Load modal dialog
				$('a.reply').click(function(e){
					e.preventDefault();
					$('#basic-modal-content').modal();
					$.cookie('reply', $(this).attr('href'));
				});
				
				$(".submit1").click(function (){
					var $form = $(this).parents('form');
					$form.attr('action', $.cookie('reply')).submit();
				});
			
			// Toggle comment view form
				$(".form_subtitle").css({ "cursor":"pointer" });
				$("#CommentViewForm").hide();
				$(".form_subtitle").click(function (){
					$("#CommentViewForm").toggle();
					var text = $(".form_subtitle").text() == "Gửi nhận xét" ? "Gửi nhận xét » Click here" : "Gửi nhận xét";
					$(".form_subtitle").text(text);
					$("p.comment_details").toggle();
				});
				
                $('ul.demolayout').each(function(){
			// For each set of tabs, we want to keep track of
			// which tab is active and it's associated content
				var $active, $content, $links = $(this).find('a');

			// Use the first link as the initial active tab
				$active = $links.first().addClass('active');
				$content = $($active.attr('href'));

			// Hide the remaining content
				$links.not(':first').each(function () {
					$($(this).attr('href')).hide();
				});

			// Bind the click event handler
				$(this).on('click', 'a', function(e){
					// Make the old tab inactive.
					$active.removeClass('active');
					$content.hide();

					// Update the variables with the new link and content
					$active = $(this);
					$content = $($(this).attr('href'));

					// Make the tab active.
					$active.addClass('active');
					$content.show();

					// Prevent the anchor's default click action
					e.preventDefault();
				});
			});
		});
	</script>
</head>
<body>
<div id="wrap">
	<div id="main_bg">
		<?php echo $this->Html->image("bg.jpg", array("alt" => "Logo"));?>
	</div>
	<div class="header">
				<div class="logo">
					<?php echo $this->Html->image("logo.gif", array("alt" => "Logo", 'url' => array('controller' => 'posts', 'action' => 'display'))); ?>
				</div>            
			<div id="menu">
				<ul>                                                                       
				<li><?php echo $this->Html->link('Trang chủ', array('controller' => 'posts', 'action' => 'display')); ?></li>
				<li><?php echo $this->Html->link('Sách', array('controller' => 'ebooks', 'action' => 'display')); ?></li>
				<li><?php echo $this->Html->link('Tìm sách', array('controller' => 'ebooks', 'action' => 'search')); ?></li>
				<li><?php echo $this->Html->link('Lời nhắn', array('controller' => 'pages', 'action' => 'request')); ?></li>
				<li><?php if (!$this->Session->read('Auth.User')) 
						echo $this->Html->link('Đăng ký', array('controller' => 'users', 'action' => 'register')); ?></li>
				</ul>
			</div>
	</div>
	<div class="center_content">
       	<div class="left_content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
			<div class="clear"></div>
		</div><!--end of left content-->
	
		<div class="right_content">
				 <div class="title"><span class="title_icon"><?php echo $this->Html->image('bullet3.gif', array('alt' => '')); ?></span>Đôi lời</div> 

				 <div class="about">
					<p>
					 <?php echo $this->Html->image('about.gif', array('alt' => '', 'class' => 'right')); ?>
					 Đây là trang lưu giữ và chia sẻ những ebook tôi đã từng đọc. Các ebook ở đây phần lớn đã được người dịch (editor) của ebook đó chia sẻ trên mạng, tuy nhiên còn có một số ebook là do tôi tự làm cho mình (chưa hỏi qua editor) nên yêu cầu người nào đó có mang truyện sang nơi khác vui lòng ghi credit thuộc về editor và người làm ebook hoặc NXB.
					 </p>
				 </div>
				 
				 <div class="right_box">
				 
					<div class="title"><span class="title_icon"><?php echo $this->Html->image('bullet4.gif', array('alt' => '')); ?></span>Top Rated</div> 
						<?php echo $this->element('top_books', array('cache'=>'+1 week'));?>
				 </div>
				 
				 <div class="right_box">
				 
					<div class="title"><span class="title_icon"><?php echo $this->Html->image('bullet5.gif', array('alt' => '')); ?></span>Phân loại</div> 
					
					<ul class="list">
						<li><?php echo $this->Html->link('Ngôn tình Trung Quốc', array('controller' => 'ebooks', 'action' => 'searchbook','1')); ?></li>
						<li><?php echo $this->Html->link('Ngôn tình phương Tây', array('controller' => 'ebooks', 'action' => 'searchbook','2')); ?></li>
						<li><?php echo $this->Html->link('Đoản văn', array('controller' => 'ebooks', 'action' => 'searchbook','3')); ?></li>
						<li><?php echo $this->Html->link('Thần thoại', array('controller' => 'ebooks', 'action' => 'searchbook','4')); ?></li>
						<li><?php echo $this->Html->link('Sách khoa học', array('controller' => 'ebooks', 'action' => 'searchbook','5')); ?></li>
					</ul>
					
					<div class="title"><span class="title_icon"><?php echo $this->Html->image('bullet6.gif', array('alt' => '')); ?></span>Kết nối</div> 
					
					<ul class="list">
					<li><a href="http://www.mistips.info">My Blog</a></li>
					<li><a href="http://kites.vn/183-1/literature.html">Kites' Literature</a></li>
					<li><a href="/ebooks/feed.rss">RSS Feed</a></li>
					</ul>      
				 
				 </div>         

			</div><!--end of right content-->
	<div class="clear"></div>
	</div><!--end of center content-->

	<div class="footer">
       	<div class="left_footer"><?php echo $this->Html->image("footer_logo.gif", array('alt' => '')); ?><br /></div>
        <div class="right_footer">
        <?php echo $this->Html->link('trang chủ', array('controller' => 'posts', 'action' => 'display')); ?>
        <?php echo $this->Html->link('liên lạc', array('controller' => 'messages', 'action' => 'request')); ?>
		<!--nocache-->
		<?php
				if ($this->Session->read('Auth.User')){
					if ($role == 1) {
						echo $this->Html->link('admin', array('controller' => 'posts', 'action' => 'index'));
					} else
						echo $this->Html->link('tài khoản', array('controller' => 'users', 'action' => 'view', $user['id']));
					echo $this->Html->link('đăng xuất', array('controller' => 'users', 'action' => 'logout'));
				} else {
					echo $this->Html->link('đăng nhập', array('controller' => 'users', 'action' => 'login'));
				}
		?>
		<!--/nocache-->
        </div>
    </div>

</div>
</body>
</html>
