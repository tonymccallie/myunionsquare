<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Add Post
	</h3>
</div>
<div>
	<?php echo $this->Form->create('News',array('type'=>'file')) ?>
	<div class="row-fluid">
		<div class="span6">
			<?php
				echo $this->Form->input('category_id',array('value'=>2,'type'=>'hidden'));
				echo $this->Form->input('title',array('class'=>'span12'));
				echo $this->Form->input('image',array(
					'type'=>'file',
				));
			?>
		</div>
		<div class="span6">
			<?php
				echo $this->Form->input('body',array('class'=>'span12'));
			?>
		</div>
	</div>
	
	<?php echo $this->Form->submit('Add Announcement',array('class'=>'btn')); ?>
</div>