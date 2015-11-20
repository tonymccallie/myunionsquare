<div class="admin_header">
	<h3>
		<i class="icon-gallery-open"></i> <?php echo $gallery['Gallery']['title'] ?>
	</h3>
</div>
<div class="gallery">
<?php
	$chunks = array_chunk($files, 4);
	foreach($chunks as $row):
?>
<div class="row-fluid">
	<?php foreach($row as $picture): ?>
	<div class="span3">
		<?php echo $this->Html->link($this->Html->image('thumb/'.$picture['Picture']['filename'].'/width:400/height:300/crop:true/zoom:auto'),Common::currentUrl().'img/thumb/'.$picture['Picture']['filename'],array('escape'=>false,'rel'=>'prettyPhoto[gal'.$gallery['Gallery']['id'].']')) ?>
	</div>
	<?php endforeach ?>
</div>
<div class="row-fluid">
	<p><br /></p>
</div>
<?php endforeach ?>
</div>