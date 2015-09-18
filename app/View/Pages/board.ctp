<?php
	$arNames = array(
		"Policies",
		"Policies for Board Review",
		"Procedures",
		"Shop at Teea's CU Shirt Store",
		"Trainer's Corner"
	)
?>
<h3>Board</h3>
<div class="row-fluid">
	<?php
		foreach($arNames as $k=>$folder):
			if((($k % 2)==0)&&($k!=0)) {
				echo '</div><div class="row-fluid">';
			}
	?>
	<div class="span6 text-center">
		<?php echo $this->Html->link($this->Html->image('folder-image.png').'<br>'.$folder.'<br><i>10 Documents</i>','/pages/resource',array('escape'=>false)) ?>
	</div>
	<?php endforeach ?>
</div>