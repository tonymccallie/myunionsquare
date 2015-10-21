<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Feedback
	</h3>
</div>
<div>
	<?php echo $this->Form->create() ?>
	<?php
		echo $this->Form->input('body',array('class'=>'span12'));
	?>
	<?php echo $this->Form->submit('Send',array('class'=>'btn')); ?>
</div>