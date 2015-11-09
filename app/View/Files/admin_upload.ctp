<div class="admin_header">
	<h3>
		<i class="icon-folder-open"></i> Upload to <?php echo $folder['Folder']['title'] ?>
		<div class="btn-group pull-right">
			<?php echo $this->Html->link('<i class="icon-folder-open"></i> View', array('action' => 'view',$folder['Folder']['id']),array('class'=>'btn','escape'=>false)); ?>
		</div>
	</h3>
</div>
<div>
	<?php echo $this->Form->create('File',array('type'=>'file')); ?>
	<div class="row-fluid">
		<div class="span6">
			<?php
				echo $this->Form->input('folder_id',array('type'=>'hidden','value'=>$folder['Folder']['id']));
				echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$USER['User']['id']));
				echo $this->Form->input('title',array('class'=>'span12'));
				echo $this->Form->input('descr',array('class'=>'span12'));
			?>
		</div>
		<div class="span6">
			<?php
				echo $this->Form->input('file',array('type'=>'file'));
			?>
		</div>
	</div>
	<?php echo $this->Form->end(array('label'=>'Upload File','class'=>'btn')); ?>
</div>