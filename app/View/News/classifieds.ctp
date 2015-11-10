<div class="admin_header">
	<h3>
		Classifieds
		<div class="btn-group pull-right">
			<?php echo $this->Html->link('Create a New Post',array('action'=>'add'),array('escape'=>false,'class'=>'btn')); ?>
		</div>
	</h3>
</div>
<?php echo $this->element('classifieds') ?>
