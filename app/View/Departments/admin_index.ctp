<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Departments
		<div class="btn-group pull-right">
			<?php echo $this->Html->link('Add Department', array('action' => 'add'),array('class'=>'btn','escape'=>false)); ?>
		</div>
	</h3>
</div>
<div class="">
	<?php echo $this->element('search') ?>
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>
					<?php echo $this->Paginator->sort('title','<i class="icon-sort"></i> Title',array('escape'=>false)); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($departments as $department): ?>
			<tr>
				<td><?php echo $this->Html->link($department['Department']['title'],array('action'=>'edit',$department['Department']['id'])) ?></td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	<?php echo $this->element('paging') ?>
</div>