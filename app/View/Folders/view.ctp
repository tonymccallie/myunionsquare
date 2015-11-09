<h3><?php echo $folder['Folder']['title'] ?></h3>
<div class="row-fluid">
	<div class="span12">
		<?php echo $this->element('search') ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th><?php echo $this->Paginator->sort('title','<i class="icon-sort"></i> Title', array('escape'=>false)) ?></th>
					<th><?php echo $this->Paginator->sort('descr','<i class="icon-sort"></i> Description', array('escape'=>false)) ?></th>
					<th>Action</th>
					<th><?php echo $this->Paginator->sort('size','<i class="icon-sort"></i> Size', array('escape'=>false)) ?></th>
					<th><?php echo $this->Paginator->sort('modified','<i class="icon-sort"></i> Modified', array('escape'=>false)) ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($files as $file): ?>
				<tr>
					<td><?php echo $file['File']['title'] ?></td>
					<td><?php echo Common::truncate($file['File']['descr']) ?></td>
					<td>
						<div class="btn-group">
							<?php 
								echo $this->Html->link('<i class="icon-download"></i> Download',array('controller'=>'files','action'=>'download',$file['File']['id']),array('class'=>'btn','escape'=>false));
								echo $this->Html->link('<i class="icon-info"></i> Info',array('controller'=>'files','action'=>'view',$file['File']['id']),array('class'=>'btn','escape'=>false));
							?>
						</div>
					</td>
					<td><?php echo Common::bytes($file['File']['size']) ?></td>
					<td><?php echo date('h:ma M j, Y', strtotime($file['File']['modified'])) ?></td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>