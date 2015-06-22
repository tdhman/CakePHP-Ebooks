<div class="title"><span class="title_icon"><?php echo $this->Html->image('bullet2.gif', array('alt' => '')); ?></span>Danh mục sách</div>
	
	<form action="#">
		<fieldset>
			<input type="text" name="search" value="" id="id_search" placeholder="Tìm kiếm" autofocus />
		</fieldset>
	</form>
	
	<table id="table_example">
		<thead>
			<tr>
				<th>Tên sách</th> 
				<th>Tác giả</th>
				<th>Thể loại</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($ebooks as $ebook): ?>
			<tr>
				<td>
					<?php echo $this->Html->link($ebook['Ebook']['title'], array('controller' => 'ebooks', 'action' => 'view', $ebook['Ebook']['id'])); ?>
				</td>
				<td><?php echo $ebook['Ebook']['author']; ?></td>
				<td><?php echo $ebook['Ebook']['genre']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>  
    
        

