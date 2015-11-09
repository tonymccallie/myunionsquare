<div class="admin_header">
	<h3>
		<i class="icon-folder-open"></i> Folder
	</h3>
</div>
<div>
	<?php echo $this->Form->create() ?>
	<?php
		echo $this->Form->input('title',array('class'=>'span12'));
		echo $this->Form->input('category_id',array('class'=>'span12','options'=>$categories));
		echo $this->Form->input('descr',array('label'=>'Description','class'=>'span12'));
	?>
	<?php echo $this->Form->submit('Create Folder',array('class'=>'btn')); ?>
</div>