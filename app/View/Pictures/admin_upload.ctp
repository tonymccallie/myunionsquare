<div class="admin_header">
	<h3>
		<i class="icon-folder-open"></i> Upload to <?php echo $gallery['Gallery']['title'] ?>
		<div class="btn-group pull-right">
			<?php echo $this->Html->link('<i class="icon-gallery-open"></i> View', array('action' => 'view',$gallery['Gallery']['id']),array('class'=>'btn','escape'=>false)); ?>
		</div>
	</h3>
</div>
<div>
	<?php echo $this->Form->create('Picture',array('type'=>'file')); ?>
	<div class="row-fluid">
		<div class="span12">
			<?php
				echo $this->Form->input('gallery_id',array('type'=>'hidden','value'=>$gallery['Gallery']['id']));
				echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$USER['User']['id']));
				echo $this->Form->input('pictures.',array('type'=>'file','multiple'));
			?>
		</div>
	</div>
	<?php echo $this->Form->end(array('label'=>'Upload Pictures','class'=>'btn')); ?>
</div>