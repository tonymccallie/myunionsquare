<div class="admin_header">
	<h3>
		<i class="icon-folder-open"></i> Gallery
	</h3>
</div>
<div>
	<?php echo $this->Form->create() ?>
	<?php
		echo $this->Form->input('title',array('class'=>'span12'));
		echo $this->Form->input('descr',array('label'=>'Description','class'=>'span12'));
	?>
	<?php echo $this->Form->submit('Create Gallery',array('class'=>'btn')); ?>
</div>