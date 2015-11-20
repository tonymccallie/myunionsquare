<div class="admin_header">
	<h3>
		<i class="icon-folder-open"></i> Gallery
		<div class="btn-group pull-right">
			<?php echo $this->Html->link('<i class="icon-trash"></i>', array('action' => 'delete',$this->data['Gallery']['id']),array('class'=>'btn','escape'=>false),'Are you sure you want to delete this gallery?'); ?>
		</div>
	</h3>
</div>
<div>
	<?php echo $this->Form->create() ?>
	<?php
		echo $this->Form->input('id',array('class'=>'span12'));
		echo $this->Form->input('title',array('class'=>'span12'));
		echo $this->Form->input('descr',array('label'=>'Description','class'=>'span12'));
	?>
	<?php echo $this->Form->submit('Save Gallery',array('class'=>'btn')); ?>
</div>