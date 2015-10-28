<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Folders
		<div class="btn-group pull-right">
			<?php echo $this->Html->link('<i class="icon-plus"></i> Add Folder', array('action' => 'add'),array('class'=>'btn','escape'=>false)); ?>
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
				<th>
					<?php echo $this->Paginator->sort('category_id','<i class="icon-sort"></i> Category',array('escape'=>false)); ?>
				</th>
				<th>
					<?php echo $this->Paginator->sort('created','<i class="icon-sort"></i> Created',array('escape'=>false)); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($folders as $folder): ?>
			<tr>
				<td><?php echo $this->Html->link($folder['Folder']['title'],array('action'=>'edit',$folder['Folder']['id'])) ?></td>
				<td><?php echo $categories[$folder['Folder']['category_id']] ?></td>
				<td><?php echo date('m/d/Y',strtotime($folder['Folder']['created'])) ?></td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	<?php echo $this->element('paging') ?>
</div>