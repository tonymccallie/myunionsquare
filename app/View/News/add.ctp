<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Add a Post
	</h3>
</div>
<div>
	<?php echo $this->Form->create('News') ?>
	<div class="row-fluid">
		<div class="span6">
			<?php
				echo $this->Form->input('category_id',array('value'=>3,'type'=>'hidden'));
				echo $this->Form->input('title',array('class'=>'span12'));
				echo $this->Form->input('body',array('class'=>'span12','rows'=>10));
			?>
		</div>
		<div class="span6">
			<?php
				
			?>
		</div>
	</div>
	
	<?php echo $this->Form->submit('Add Post',array('class'=>'btn')); ?>
</div>