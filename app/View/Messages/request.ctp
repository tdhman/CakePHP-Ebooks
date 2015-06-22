<div class="left_content">
	<div class="title"><span class="title_icon"><?php echo $this->Html->image('bullet1.gif', array('alt' => '')); ?></span>Gửi lời nhắn</div>
        
        <div class="feat_prod_box_details">
			<p class="details">Bạn muốn hỏi về ebook, link download hoặc góp ý về nội dung trang web...</p>
			<div class="register_form">
                <div class="form_subtitle">Lời nhắn</div>
					<?php

					echo $this->Form->create('Message', array('controller' => 'messages', 'action' => 'request'));
					echo $this->Form->input('name', array('label' => 'Tên'));
					echo $this->Form->input('email', array('label' => 'Email'));
					echo $this->Form->input('content', array('label' => 'Nội dung', 'rows' => '10'));
					echo $this->Form->end('Gửi');

					?>
				</div>  
            </div>	
    <div class="clear"></div>
</div><!--end of left content-->
