<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Edit User
		<div class="btn-group pull-right">
			<?php echo $this->Html->link('<i class="icon-trash"></i> ', array('action' => 'delete', $this->data['User']['id']), array('escape'=>false,'class'=>'btn'),'Are you sure you want to delete this User?'); ?>
		</div>
	</h3>
</div>
<div class="">
	<?php echo $this->Form->create('User',array('type'=>'file')); ?>
	<div class="row-fluid">
		<div class="span6">
			<div class="row-fluid">
				<div class="span6">
					<?php echo $this->Form->input('first_name',array('class'=>'span12')); ?>
				</div>
				<div class="span6">
					<?php echo $this->Form->input('last_name',array('class'=>'span12')); ?>
				</div>
			</div>
			<?php
				echo $this->Form->input('id',array());
				echo $this->Form->input('email',array('class'=>'span12'));
				echo $this->Form->input('department_id',array('class'=>'span12'));
				echo $this->Form->input('position',array('class'=>'span12'));
				echo $this->Form->input('passwd',array('label'=>'Change Password','class'=>'span12'));
				echo $this->Form->input('passwd_verify',array('type'=>'password','label'=>'Password Verify','class'=>'span12'));
			?>
		</div>
		<div class="span6">
			<?php
				echo $this->Form->input('active',array('class'=>''));
				echo $this->Form->input('birthday',array('class'=>'span4','minYear'=>1920,'maxYear'=>date('Y'),'empty' => true));
				echo $this->Form->input('hire_date',array('class'=>'span4','minYear'=>1920,'maxYear'=>date('Y'),'empty' => true));
				echo $this->Form->input('role_id',array('class'=>'span12'));
				echo $this->Form->input('image',array('label' => 'New Image',
					'type'=>'file',
				));
			?>
			<?php echo !empty($this->data['User']['photo'])?'<label>Current Image</label><br />'.$this->Html->image('thumb/'.$this->data['User']['photo'].'/width:200/height:200/crop:true/zoom:auto',array('style'=>'width: 200px;')):'' ?>
		</div>
	</div>
	<?php echo $this->Form->end(array('label'=>'Save User','class'=>'btn')); ?>
</div>