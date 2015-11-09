<h3>Search Results</h3>
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
					<th>Title</th>
					<th>Description</th>
					<th>Action</th>
					<th>Size</th>
					<th>Modified</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$folder = null;
					foreach($files as $file): 
						if($folder != $file['File']['folder_id']):
							$folder = $file['File']['folder_id'];
				?>
				<tr>
					<td colspan="5"><?php echo $this->Html->link($file['Folder']['title'],array('action'=>'view',$file['Folder']['id'])) ?></td>
				</tr>
				<?php endif ?>
				<tr>
					<td><b><?php echo $file['File']['title'] ?></b></td>
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