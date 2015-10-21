<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> View Feedback
		<div class="btn-group pull-right">
			<?php echo $this->Html->link('<i class="icon-trash"></i>', array('action' => 'delete',$this->data['Feedback']['id']),array('class'=>'btn','escape'=>false),'Are you sure you want to delete this feedback?'); ?>
		</div>
	</h3>
</div>
<div>
	<?php echo $this->data['Feedback']['body'] ?>
</div>