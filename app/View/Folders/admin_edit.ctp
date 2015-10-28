<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Folder
		<div class="btn-group pull-right">
			<?php echo $this->Html->link('<i class="icon-trash"></i>', array('action' => 'delete',$this->data['Folder']['id']),array('class'=>'btn','escape'=>false),'Are you sure you want to delete this folder?'); ?>
		</div>
	</h3>
</div>
<div>
	<?php echo $this->Form->create() ?>
	<?php
		echo $this->Form->input('id',array('class'=>'span12'));
		echo $this->Form->input('title',array('class'=>'span12'));
		echo $this->Form->input('category_id',array('class'=>'span12','options'=>$categories));
		echo $this->Form->input('descr',array('label'=>'Description','class'=>'span12'));
	?>
	<?php echo $this->Form->submit('Save Folder',array('class'=>'btn')); ?>
</div>