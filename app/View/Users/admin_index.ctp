<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Users
		<div class="btn-group pull-right">
			<?php echo $this->Html->link('Add User', '/admin/users/add',array('class'=>'btn','escape'=>false)); ?>
			<?php echo $this->Html->link('Departments', '/admin/departments',array('class'=>'btn')) ?>
		</div>
	</h3>
</div>
<div class="">
	<?php echo $this->element('search') ?>
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th style="width:90px;"></th>
				<th>
					<?php echo $this->Paginator->sort('email','<i class="icon-sort"></i> Email',array('escape'=>false)); ?>
				</th>
				<th>
					<?php echo $this->Paginator->sort('first_name','<i class="icon-sort"></i> First',array('escape'=>false)); ?>
					<?php echo $this->Paginator->sort('last_name','<i class="icon-sort"></i> Last',array('escape'=>false)); ?>
				</th>
				<th>
					<?php echo $this->Paginator->sort('role_id','<i class="icon-sort"></i> Role',array('escape'=>false)); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($users as $user): ?>
			<tr>
				<td>
					<?php echo !empty($user['User']['photo'])?$this->Html->image('thumb/'.$user['User']['photo'].'/width:200/height:200/crop:true/zoom:auto',array('class'=>'img-circle')):'' ?>
				</td>
				<td><?php echo $this->Html->link($user['User']['email'],array('action'=>'edit',$user['User']['id'])) ?></td>
				<td><?php echo $user['User']['first_name'].' '.$user['User']['last_name'] ?></td>
				
				<td><?php echo $user['Role']['name'] ?></td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	<?php echo $this->element('paging') ?>
</div>