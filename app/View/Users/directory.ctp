<h3>Directory</h3>
<div class="directory">
	<?php echo $this->element('search') ?>
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th style="width:90px;"></th>
				<th>
					<?php echo $this->Paginator->sort('first_name','<i class="icon-sort"></i> First',array('escape'=>false)); ?>
					<?php echo $this->Paginator->sort('last_name','<i class="icon-sort"></i> Last',array('escape'=>false)); ?>
				</th>
				<th>
					<?php echo $this->Paginator->sort('email','<i class="icon-sort"></i> Email',array('escape'=>false)); ?>
				</th>
				<th>Phone</th>
				<th>Department</th>
				<th>Position</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($users as $user): ?>
			<tr>
				<td>
					<?php echo !empty($user['User']['photo'])?$this->Html->image('thumb/'.$user['User']['photo'].'/width:200/height:200/crop:true/zoom:auto',array('class'=>'img-circle')):'' ?>
				</td>
				<td><?php echo $user['User']['first_name'].' '.$user['User']['last_name'] ?></td>
				<td><?php echo $user['User']['email'] ?></td>
				<td><?php echo $user['User']['phone'] ?></td>
				<td><?php echo $user['Department']['title'] ?></td>
				<td><?php echo $user['User']['position'] ?></td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	<?php echo $this->element('paging') ?>
</div>