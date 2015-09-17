<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Add Department
	</h3>
</div>
<div>
	<?php echo $this->Form->create() ?>
	<?php
		echo $this->Form->input('title',array('class'=>'span12'));
	?>
	<?php echo $this->Form->submit('Add Department',array('class'=>'btn')); ?>
</div>