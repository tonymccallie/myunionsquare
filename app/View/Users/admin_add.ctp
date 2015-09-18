<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Add User
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
				echo $this->Form->input('email',array('class'=>'span12'));
				echo $this->Form->input('department_id',array('class'=>'span12'));
				echo $this->Form->input('position',array('class'=>'span12'));
				echo $this->Form->input('passwd',array('label'=>'Change Password','class'=>'span12'));
				echo $this->Form->input('passwd_verify',array('type'=>'password','label'=>'Password Verify','class'=>'span12'));
			?>
		</div>
		<div class="span6">
			<?php
				echo $this->Form->input('birthday',array('class'=>'span4','minYear'=>1920,'maxYear'=>date('Y'),'empty' => true));
				echo $this->Form->input('hire_date',array('class'=>'span4','minYear'=>1920,'maxYear'=>date('Y'),'empty' => true));
				echo $this->Form->input('role_id',array('class'=>'span12','value'=>2));
				echo $this->Form->input('image',array('label' => 'New Image',
					'type'=>'file',
				));
			?>
		</div>
	</div>
	<?php echo $this->Form->end(array('label'=>'Save User','class'=>'btn')); ?>
</div>