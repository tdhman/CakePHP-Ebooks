
<?php if(empty($test)) 
		echo '<div class="title"><span class="title_icon">', $this->Html->image('bullet1.gif', array('alt' => '')), '</span>Không tìm thấy trang này.</div>';
	  else {
		echo '<div class="title"><span class="title_icon">', $this->Html->image('bullet6.gif', array('alt' => '')), '</span>Tài khoản của ', $test['User']['name'], '</div>';
		echo '<div class="feat_prod_box_details">';
		echo '<div class="prod_img">';
		echo $this->Html->image($test['User']['avatar'], array('alt' => '', 'border' => '0'));
		echo '<br /><br />';
		echo '</div>';
		echo '<div class="prod_det_box">';
		echo '<div class="box_top"></div>';
		echo '<div class="box_center">';
		echo '<div class="prod_title">Thông tin</div>';
		echo '<p class="details">Tên: ', $test['User']['name'], '</p>';
		echo '<p class="details">Bí danh: ', $test['User']['username'], '</p>';
		echo '<p class="details">Email: ', $test['User']['email'], '</p>';
		echo '<p class="details">Ngày tạo: ', $test['User']['created'], '</p>';
		echo '<p class="details">Đăng nhập lần cuối: ', $test['User']['last_login'], '</p>';
		echo '<p class="details">', $this->Html->link('Thay đổi', array('action' => 'account', $test['User']['id'])), '</p>';
		echo '<div class="clear"></div>';
		echo '</div>';
		echo '<div class="box_bottom"></div>';
		echo '</div>';
		echo '<div class="clear"></div>';
		echo '</div>';
	  }
?>  