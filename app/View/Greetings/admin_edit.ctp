<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Edit Greeting
	</h3>
</div>
<div>
	<?php echo $this->Form->create() ?>
	<?php
		echo $this->Form->input('id',array('class'=>'span12'));
		echo $this->Form->input('title',array('class'=>'span12'));
	?>
	<?php echo $this->Form->submit('Save Greeting',array('class'=>'btn')); ?>
</div>