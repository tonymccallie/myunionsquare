<div class="admin_header">
	<h3>
		<i class="icon-folder-open"></i> <?php echo $file['File']['title'] ?>
	</h3>
</div>
<div>
	<table class="table table-striped table-bordered">
		<tr>
			<td><b>Title:</b></td>
			<td><?php echo $file['File']['title'] ?></td>
		</tr>
		<tr>
			<td><b>Folder:</b></td>
			<td><?php echo $this->Html->link($file['Folder']['title'],array('controller'=>'folders','action'=>'view',$file['Folder']['id'])) ?></td>
		</tr>
		<tr>
			<td><b>Filename:</b></td>
			<td><?php echo $file['File']['filename'] ?></td>
		</tr>
		<tr>
			<td><b>Description:</b></td>
			<td><?php echo $file['File']['descr'] ?></td>
		</tr>
		<tr>
			<td><b>Created:</b></td>
			<td><?php echo date('d/m/Y h:i:s a' ,strtotime($file['File']['created'])) ?></td>
		</tr>
		<tr>
			<td><b>Size:</b></td>
			<td><?php echo Common::bytes($file['File']['size']) ?></td>
		</tr>
		
		<tr>
			<td><b>Download:</b></td>
			<td><?php echo $this->Html->link('<i class="icon-download"></i> Download now',array('controller'=>'files','action'=>'download',$file['File']['id']),array('class'=>'btn btn-block','escape'=>false)) ?></td>
		</tr>
	</table>
</div>