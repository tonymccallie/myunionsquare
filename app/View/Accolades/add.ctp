<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Feedback
	</h3>
</div>
<div>
	<?php echo $this->Form->create() ?>
	<?php
		echo $this->Form->input('user_id',array('type'=>'hidden','value'=>Authsome::get('User.id')));
		echo $this->Form->input('body',array('class'=>'span12','label'=>'High Five'));
	?>
	<?php echo $this->Form->submit('Add',array('class'=>'btn')); ?>
</div>