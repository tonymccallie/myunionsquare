<div class="admin_header">
	<h3>
		<i class="icon-gallery-open"></i> Photo Galleries
	</h3>
</div>
<div class="">
<!--
	<div class="row-fluid">
		<div class="span12">
			<?php //echo $this->element('search') ?>
		</div>
	</div>
-->
	<?php
		$chunks = array_chunk($galleries, 3);
		foreach($chunks as $row):
	?>
	<div class="row-fluid">
		<?php
			foreach($row as $gallery): 
				$image = !empty($gallery['Picture'][0]['filename'])?$this->Html->image('thumb/'.$gallery['Picture'][0]['filename'].'/width:400/height:300/crop:true/zoom:auto'):'';
		?>
		<div class="span4 text-center">
			<?php echo $this->Html->link($image.'<br>'.$gallery['Gallery']['title'].'<br><i>'.$gallery['Gallery']['picture_count'].' Pictures</i>',array('action'=>'view',$gallery['Gallery']['id']),array('escape'=>false)); ?>
		</div>
		<?php endforeach ?>
	</div>
	<?php endforeach ?>
	<?php echo $this->element('paging') ?>
</div>