<div class="admin_header">
	<h3>
		<i class="icon-folder-open"></i> Managing: <?php echo $folder['Folder']['title'] ?>
		<div class="btn-group pull-right">
			<?php echo $this->Html->link('<i class="icon-upload"></i> Upload', array('controller'=>'files','action' => 'upload',$folder['Folder']['id']),array('class'=>'btn','escape'=>false)); ?>
			<?php echo $this->Html->link('<i class="icon-edit"></i> Edit', array('action' => 'edit',$folder['Folder']['id']),array('class'=>'btn','escape'=>false)); ?>
		</div>
	</h3>
</div>
<div class="row-fluid">
	<div class="span12">
		<?php echo $this->element('search') ?>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th><?php echo $this->Paginator->sort('title','<i class="icon-sort"></i> Title', array('escape'=>false)) ?></th>
					<th><?php echo $this->Paginator->sort('descr','<i class="icon-sort"></i> Description', array('escape'=>false)) ?></th>
					<th><?php echo $this->Paginator->sort('size','<i class="icon-sort"></i> Size', array('escape'=>false)) ?></th>
					<th><?php echo $this->Paginator->sort('modified','<i class="icon-sort"></i> Modified', array('escape'=>false)) ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($files as $file): ?>
				<tr>
					<td><?php echo $this->Html->link($file['File']['title'],array('controller'=>'files','action'=>'edit',$file['File']['id'])) ?></td>
					<td><?php echo Common::truncate($file['File']['descr']) ?></td>
					<td><?php echo Common::bytes($file['File']['size']) ?></td>
					<td><?php echo date('h:ma M j, Y', strtotime($file['File']['created'])) ?></td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<?php echo $this->element('paging') ?>