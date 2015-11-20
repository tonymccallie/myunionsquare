<div class="admin_header">
	<h3>
		<i class="icon-gallery-open"></i> Managing: <?php echo $gallery['Gallery']['title'] ?>
		<div class="btn-group pull-right">
			<?php echo $this->Html->link('<i class="icon-upload"></i> Upload', array('controller'=>'pictures','action' => 'upload',$gallery['Gallery']['id']),array('class'=>'btn','escape'=>false)); ?>
			<?php echo $this->Html->link('<i class="icon-edit"></i> Edit', array('action' => 'edit',$gallery['Gallery']['id']),array('class'=>'btn','escape'=>false)); ?>
		</div>
	</h3>
</div>
<?php
	$chunks = array_chunk($files, 4);
	foreach($chunks as $row):
?>
<div class="row-fluid">
	<?php foreach($row as $picture): ?>
	<div class="span3 text-center">
		<?php echo $this->Html->image('thumb/'.$picture['Picture']['filename'].'/width:400/height:300/crop:true/zoom:auto') ?>
		<?php echo $this->Html->link('[delete]',array('action'=>'delete_picture',$picture['Picture']['id']),array(),'Are you sure you want to delete this picture?') ?>
	</div>
	<?php endforeach ?>
</div>
<div class="row-fluid">
	<p><br /></p>
</div>
<?php endforeach ?>
<?php echo $this->element('paging') ?>