<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Edit Post
		<div class="btn-group pull-right">
			<?php echo $this->Html->link('<i class="icon-trash"></i> ', array('action' => 'marketing_delete', $this->data['News']['id']), array('escape'=>false,'class'=>'btn'),'Are you sure you want to delete this announcement?'); ?>
		</div>
	</h3>
</div>
<div>
	<?php echo $this->Form->create('News',array('type'=>'file')) ?>
	<div class="row-fluid">
		<div class="span6">
			<?php
				echo $this->Form->input('id',array('class'=>'span12'));
				echo $this->Form->input('title',array('class'=>'span12'));
				echo $this->Form->input('image',array('label' => 'New Image',
					'type'=>'file',
				));
			?>
			<?php echo !empty($this->data['News']['photo'])?'<label>Current Image</label><br />'.$this->Html->image('thumb/'.$this->data['News']['photo'].'/width:800/height:600/crop:true/zoom:auto'):'' ?>
		</div>
		<div class="span6">
			<?php
				echo $this->Form->input('body',array('class'=>'span12'));
			?>
		</div>
	</div>
	<p><br /></p>
	<?php echo $this->Form->submit('Save Announcement',array('class'=>'btn')); ?>
</div>