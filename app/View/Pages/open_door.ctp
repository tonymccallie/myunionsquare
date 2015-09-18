<h3>Open Door</h3>
<?php echo $this->Form->create(); ?>
<div class="row-fluid">
	<div class="span5">
		<?php
			echo $this->Form->input('name',array('class'=>'span12'));
			echo $this->Form->input('email',array('class'=>'span12'));	
		?>
	</div>
	<div class="span7">
		<?php echo $this->Form->input('comments',array('label'=>'Comments/Questions','type'=>'textarea','class'=>'span12')); ?>
	</div>
</div>
<?php echo $this->Form->submit('Send',array('class'=>'btn')); ?>