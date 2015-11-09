<div class="admin_header">
	<h3>
		<i class="icon-folder-open"></i> Edit <?php echo $this->data['File']['title'] ?>
		<div class="btn-group pull-right">
			<?php echo $this->Html->link('<i class="icon-trash"></i>', array('action' => 'delete',$this->data['File']['id']),array('class'=>'btn','escape'=>false),'Are you sure you want to delete this file?'); ?>
		</div>
	</h3>
</div>
<div>
	<?php echo $this->Form->create('File',array('type'=>'file')); ?>
	<div class="row-fluid">
		<div class="span6">
			<?php
				echo $this->Form->input('id',array());
				echo $this->Form->input('title',array('class'=>'span12'));
				echo $this->Form->input('filename',array('type'=>'hidden'));
				echo $this->Form->input('folder_id',array('type'=>'hidden'));
				echo $this->Form->input('descr',array('class'=>'span12'));
			?>
		</div>
		<div class="span6">
			<?php
				echo $this->Form->input('file',array('type'=>'file','label'=>'Overwrite this file with a new one?'));
				echo $this->Html->link('<i class="icon-download"></i> Download Current File',array('action'=>'download',$this->data['File']['id'],'admin'=>false),array('class'=>'btn btn-block','escape'=>false));
			?>
		</div>
	</div>
	<?php echo $this->Form->end(array('label'=>'Save File','class'=>'btn')); ?>
</div>