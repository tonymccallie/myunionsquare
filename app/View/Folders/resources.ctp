<h3>Resources</h3>
<div class="row-fluid">
	<div class="span12">
		<?php echo $this->element('search') ?>
	</div>
</div>
<div class="row-fluid">
	<?php
		foreach($folders as $k=>$folder):
			if((($k % 3)==0)&&($k!=0)) {
				echo '</div><div class="row-fluid">';
			}
	?>
	<div class="span4 text-center">
		<?php echo $this->Html->link($this->Html->image('folder-image.png').'<br>'.$folder['Folder']['title'].'<br><i>'.$folder['Folder']['file_count'].' Documents</i>',array('action'=>'view',$folder['Folder']['id']),array('escape'=>false)) ?>
	</div>
	<?php endforeach ?>
</div>